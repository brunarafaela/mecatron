<?php

Class Index {

	public function home(){
		$this->login();
	}

	public function loginsubmit(){
		$user 	  = params(array('req' => array('cpf|funcionario_cpf', 'pass|funcionario_hash')));
		$redirect = postData('redirect', false);

		// Recebeu os parametros
		if ($user) {

			// Efetua hash da senha do usuário
			$user['funcionario_hash'] = call('Helper/Hash')->encode($user['funcionario_hash']);
			
			// Limpa pontos e traços do cpf
			$user['funcionario_cpf'] = str_replace([',', '-', '.'], '', $user['funcionario_cpf']);
			
			#echo $user['funcionario_hash'];die;

			// Consulta usuário e senha na base de dados
			$user = call('Model/ModelFuncionario')->get_by($user);

			if ($user) {
				// Encontrou: Cria session para autenticação do usuário
				Session()->set('aid', $user->funcionario_id);
				Session()->set('nome', $user->funcionario_nome);
				Session()->set('tipo', $user->funcionario_type);
				// Retorno	
				redirect('/Dashboard/index/');
				
			} else {
				// Redirect
				$this->login(['error' => 'CPF ou senha incorretos.']);
			}

		} else {
			$this->login(['error' => 'Preencha os campos CPF e senha.']);
		}
	}

	public function login($error = false) {
		$return['result'] = $error;
		includePage('login', 'Index', $return);	
		
	}	

	public function logout() {
		Session()->removeAll();
		$this->login();
	}

	public function notFound() {
		
	}
}