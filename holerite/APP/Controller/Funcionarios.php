<?php 

class Funcionarios {

	public function __construct() {
		if (! is_numeric(Session()->get('aid'))) {
			redirect('/Index/home/');
		}
	}

	private $actions = [
		'created' 		=> ['success', 'Funcionário adicionado com sucesso'],
		'edited' 		=> ['success', 'Dados alterados com sucesso'],
		'pass_changed' 	=> ['success', 'Senha alterada com sucesso'],
		'error' 		=> ['error', 'Erro ao alterar dados de funcionário'],
	];

	public function index() {

		$page 	= getData('page', 1);
		$filter = getData('filter', false);
		$search = getData('search', false);

		if ($search) {
			
			$data['list']	= call('Model/ModelFuncionario')->search_user($search);
			$data['count'] 	= 0;
			$data['pager']	= '';
			$data['query'] 	= $search;

		} else if (is_numeric($page)) {
			
            if($filter) {
                
                $data['filter'] = $filter;
                $data['list']	= call('Model/ModelFuncionario')->get_list(['funcionario_status' => $filter , 'page' => $page]);
			    $data['count'] 	= call('Model/ModelFuncionario')->get_count(['funcionario_status' => $filter]);
			    $data['pager']	= call('Helper/Paginator')->go($page, $data['count'], '/Funcionarios/index/filter/'.$filter.'/page/');
                
            } else {
            
                $data['list']	= call('Model/ModelFuncionario')->get_list(['page' => $page]);
			    $data['count'] 	= call('Model/ModelFuncionario')->get_count([]);
			    $data['pager']	= call('Helper/Paginator')->go($page, $data['count'], '/Funcionarios/index/page/');    
                
            }
            
		}

		includePage('home', 'Funcionarios', $data);
	}

	public function listar($result = false) {

		$id = getData('listar', false);
		if ((! $id) && (is_numeric(@$result['id']))) {
			$id = $result['id'];
		}

		if (is_numeric($id)) {
			
			$data['user'] = call('Model/ModelFuncionario')->get_by(['funcionario_id' => $id]);
			$data['result'] = $result;

			includePage('listar', false, $data);

		} else {
			$this->index();
		}
	}


	public function edit() {

		$id 	= getData('edit');
		$action = getData('action');

		if ($id) {
			$data['form'] = call('Model/ModelFuncionario')->get_by(['funcionario_id' => $id]);
			#$data['holerites'] = call('Model/ModelDocumento')->get_user_list(['funcionario_id' => $id]);
			$data['holerites']	= call('Model/ModelDocumento')->get_meus(['funcionario_id' => $id]);			
			$data['id'] = $id;
		}

		if ($action) {
			$data['result'][$this->actions[$action][0]] = $this->actions[$action][1];
		}

		includePage('editar', false, $data);
	}

	public function _edit_password() {
		
		$data = params(['req' => [
			'funcionario_id',
			'funcionario_hash',
		]]);
	
		if (! $data) {
			return redirect('/Funcionarios/edit/' . '/action/error');
		}

		// Efetua hash da senha do usuário
		$data['funcionario_hash'] = call('Helper/Hash')->encode($data['funcionario_hash']);
		
		call('Model/ModelFuncionario')->edit_user([
		    'funcionario_hash' => $data['funcionario_hash']    
		], [
		    'funcionario_id' => $data['funcionario_id']
	    ]);
	    
		return redirect('/Funcionarios/edit/' . $data['funcionario_id'] . '/action/pass_changed');

	}

	public function _edit_my_password() {
		
		$data = params(['req' => [
			'funcionario_hash',
		]]);

		if (! $data) {
			return redirect('/Dashboard/pref' . '/action/error');
		}

		// Efetua hash da senha do usuário
		$data['funcionario_hash'] 	  = call('Helper/Hash')->encode($data['funcionario_hash']);
		
		call('Model/ModelFuncionario')->edit_user([
		    'funcionario_hash' => $data['funcionario_hash']    
		], [
		    'funcionario_id' => Session()->get('aid')
	    ]);
		
		return redirect('/Dashboard/pref' . '/action/pass_changed');

	}

	public function _save_my_profile() {
		
		$data = params(['req' => [
			'funcionario_id',
		], 'opt' => [
			'funcionario_rua',
			'funcionario_bairro',
			'funcionario_cep',
			'funcionario_estado',
			'funcionario_cidade',
			'funcionario_telefone'
		]]);
		
		if (! $data) {
			return redirect('/Dashboard/pref/' . 'action/_error');
		}
			
		call('Model/ModelFuncionario')->edit_user($data, ['funcionario_id' => $data['funcionario_id']]);
		return redirect('/Dashboard/pref/' . $data['funcionario_id'] . '/action/edited');

	}

	public function _save() {
		
		$data = params(['req' => [
			'funcionario_id',
			'funcionario_nome',
			'funcionario_funcao',
			'funcionario_divisao',
			'funcionario_cpf',
			'funcionario_tipo|funcionario_type',
			'funcionario_status',
		], 'opt' => [
			'funcionario_hash',
			'funcionario_rua',
			'funcionario_bairro',
			'funcionario_cep',
			'funcionario_estado',
			'funcionario_cidade',
			'funcionario_telefone'
		]]);

		$action = postData('form_action', 'create');
		
		if (! $data) {
			return redirect('/Funcionarios/edit/' . 'action/error');
		}
		
		$data['funcionario_cpf'] = str_replace([',', '-', '.'], '', $data['funcionario_cpf']);
		
		if (isset($data['funcionario_hash'])) {
			if (strlen($data['funcionario_hash']) > 4) {
				$data['funcionario_hash'] 	  = call('Helper/Hash')->encode($data['funcionario_hash']);
			}
		}

		if ($action == 'create') {
			$last_id = call('Model/ModelFuncionario')->create($data);
			return redirect('/Funcionarios/edit/' . $last_id->funcionario_id . '/action/created');
		}

		if ($action == 'edit') {
			call('Model/ModelFuncionario')->edit_user($data, ['funcionario_id' => $data['funcionario_id']]);
			return redirect('/Funcionarios/edit/' . $data['funcionario_id'] . '/action/edited');
		}
		

		

	}


}