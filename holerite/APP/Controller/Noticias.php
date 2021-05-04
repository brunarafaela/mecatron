<?php 

Class Noticias {

	private $actions = [
		'created' 		=> ['success', 'Aviso adicionado com sucesso'],
		'edited' 		=> ['success', 'Dados alterados com sucesso'],
		'error' 		=> ['error', 'Erro ao alterar dados de notícia'],
	];

	public function __construct() {
		if (! is_numeric(Session()->get('aid'))) {
			redirect('/Index/home/');
		}
	}

	public function index() {

		$data['list'] = call('Model/ModelNoticia')->get_by(['news_status' => 1], 100);

		includePage('index', false, $data);
	}

	public function nova() {
		
		$id = getData('id');

		includePage('editar');

	}

	public function remover() {
		
		$id 	= getData('remover');

		call('Model/ModelNoticia')->edit_news(['news_status' => 0], ['news_id' => $id]);

		return redirect('/Noticias/index/');

	}

	public function edit() {

		$id 	= getData('edit');
		$action = getData('action');

		if ($id) {
			$data['form'] = call('Model/ModelNoticia')->get_by(['news_id' => $id]);
			$data['id'] = $id;
		}

		if ($action) {
			$data['result'][$this->actions[$action][0]] = $this->actions[$action][1];
		}

		includePage('editar', false, $data);
	}

	public function _save() {
		

		$data = params(['req' => [
			'news_title',
			'news_text',
			'news_subtitle',
		], 'opt' => [
			'news_id',
		]], false, [
			'news_status' => 1,
		]);

		$action = postData('form_action', 'create');
		
		if (! $data) {
			return redirect('/Noticias/edit/' . 'action/error');
		}

		$upload = $this->handleUpload();
		if ($upload) {
			$data['news_attachment'] = $upload;
		}
		
		if ($action == 'create') {
			unset($data['news_id']);
			$data['news_from'] = Session()->get('aid');
			$last_id = call('Model/ModelNoticia')->create($data);
			return redirect('/Noticias/edit/' . $last_id->news_id . '/action/created');
		}

		if ($action == 'edit') {
			call('Model/ModelNoticia')->edit_news($data, ['news_id' => $data['news_id']]);
			return redirect('/Noticias/edit/' . $data['news_id'] . '/action/edited');
		}
		
	}

	public function handleUpload() {

		if ($_FILES['file']['name'] == '') {
			return false;
		}

		$new_filename = 'holerites/noticia_' . uniqid() . '.pdf';
			
		// move arquivo para novo caminho
		move_uploaded_file($_FILES['file']['tmp_name'], $new_filename);

		return '/' . $new_filename;

	}

	public function random() {
		
		echo rand(0, 1000);

	}

}