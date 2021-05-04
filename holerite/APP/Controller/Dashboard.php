<?php 

class Dashboard {

	private $actions = [
		'error' 		=> ['error', 'Erro ao alterar senha, preencha os campos.'],
		'equal' 		=> ['error', 'A nova senha deve ser diferente da atual.'],
		'wrong' 		=> ['error', 'Senha digitada inválida.'],
		'pass_changed' 	=> ['success', 'Senha alterada com sucesso'],
		'edited'		=> ['success', 'Dados editados com sucesso']
	];

	public function __construct() {
		if (! is_numeric(Session()->get('aid'))) {
			redirect('/Index/home/');
		}
	}

	public function index() {
		$this->welcome();
	}

	public function welcome() {

		$data['noticia'] = call('Model/ModelNoticia')->get_last();

		includePage('bemvindo', 'Dashboard', $data);
	}

	public function pref() {

		$action = getData('action');
		$data 	= [];

		$data['form'] = call('Model/ModelFuncionario')->get_by(['funcionario_id' => Session()->get('aid')]);

		if ($action) {
			$data['result'][$this->actions[$action][0]] = $this->actions[$action][1];
		}

		includePage('preferences', 'Dashboard', $data);
	}

}