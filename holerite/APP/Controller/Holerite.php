<?php 

class Holerite {

	private $actions = [
		'success' 	=> ['success', '## holerites adicionados com sucesso'],
		'removed' 	=> ['success', '## holerites removidos com sucesso'],
		'error' 	=> ['error', 'Erro ao adicionar holerites de funcionário'],
		'error' 	=> ['error', 'Erro ao adicionar holerites de funcionário'],
	];

	public function __construct() {
		if (! is_numeric(Session()->get('aid'))) {
			redirect('/Index/home/');
		}
	}

	public function index() {

		if (Session()->get('tipo') != 1) {
			return redirect('/Holerite/meus/');
		}

		$page 	= getData('page', 1);
		$action = getData('action');
		$count  = getData('added', '');

		if (is_numeric($page)) {
			
			$data['list']	= call('Model/ModelDocumento')->get_grouped_list();
			// $data['list']	= call('Model/ModelHolerites')->get_list(['page' => $page]);
			// $data['count'] 	= call('Model/s')->get_count([]);
			// $data['pager']	= call('Helper/Paginator')->go($page, $data['count'], '/Holerites/index/page/');

		}

		if ($action) {
			$data['result'][$this->actions[$action][0]] = str_replace('##', $count, $this->actions[$action][1]);
		}

		includePage('home', 'Holerite', $data);
	}


	public function meus() {

		$user 	= Session()->get('aid');

		if (is_numeric($user)) {

			$data = [];	
			$data['list']	= call('Model/ModelDocumento')->get_meus(['funcionario_id' => $user]);			
			
			return includePage('meus', 'Holerite', $data);

		}

		// if ($action) {
		// 	$data['result'][$this->actions[$action][0]] = str_replace('##', $count, $this->actions[$action][1]);
		// }

		return includePage('home', 'Holerite', $data);

	}


	public function listar() {

		if (Session()->get('tipo') != 1) {
			return redirect('/Holerite/meus/');
		}
		
		$data = params(false, ['req' => [
			'mes|documento_mes',
			'ano|documento_ano',
		]]);

		if ($data) {
			$data['list']	= call('Model/ModelDocumento')->get_list($data);
		}
		
		includePage('listar', 'Holerite', $data);

	}


	public function adicionar($result = false) {
		$data = ['result' => $result];
		includePage('edit', false, $data);
	}

	public function editar($result = false) {

		$id = getData('editar', false);
		if ((! $id) && (is_numeric(@$result['id']))) {
			$id = $result['id'];
		}

		if (is_numeric($id)) {
			$data['result'] = $result;
			$data['form']	= call('Model/ModelHolerites')->get_by(['category_id' => $id]);
			includePage('edit', false, $data);
		} else {
			$this->adicionar();	
		}
	}


	public function _remove() {
		
		$id = getData('id', false);

		if (is_numeric($id)) {
			call('Model/ModelHolerites')->remove(['category_id' => $id]);
			redirect('/Holerites/index/');
		} else {
			$this->adicionar(['error' => 'Erro: Prencha todos os campos obrigatórios abaixo']);
		}

	}


	public function delete() {
		
		$data = params(false, ['req' => [
			'mes|documento_mes',
			'ano|documento_ano',
		]]);

		$items	= call('Model/ModelDocumento')->get_list($data);
		
		if ($items) {

			foreach ($items as $item) {

				$path = getcwd() . $item->documento_name;
			
				@unlink($path);
				
				call('Model/ModelDocumento')->remover($item->documento_id);
				
			}
		}

		redirect('/Holerite/index/action/removed/added/' . count($items));

	}


	public function _save() {
		
		$files = 0;
		$data = params(['req' => [
			'mes',
			'ano',
		]]);

		if (! $data) {
			return false;
		}

		foreach ($_FILES['file']['name'] as $key => $file) {
			
			$func_id = explode('.', $file);
			$func_id = $func_id[0];

			if (is_numeric($func_id)) {
				
				// gera caminho do novo arquivo
				$new_filename = 'holerites/' . $func_id . '_' . $data['ano'] . '_' . $data['mes'] . '_' . uniqid() . '.pdf';
				
				// move arquivo para novo caminho
				move_uploaded_file($_FILES['file']['tmp_name'][$key], $new_filename);

				call('Model/ModelDocumento')->create([
					'documento_name'	=>	'/' . $new_filename,
					'funcionario_id'	=>	$func_id,
					'documento_mes'		=>	$data['mes'],
					'documento_ano'		=>	$data['ano'],
					'documento_status'	=>	1,
				]);

				$files++;
			}
		}

		redirect('/Holerite/index/action/success/added/' . $files);
	}

}