<?php

include_once('conf/db.php');

class ModelFuncionario extends db{

	function __construct(){
		parent::__construct();
	}

	public function create($data) {
		db::insert('funcionario', $data);
		$last = db::lastRow('funcionario', 'funcionario_criado');
		return $last;
	}

	public function edit_user($data, $where) {
		return db::update('funcionario', $data, $where);
	}

	public function search_user($query) {
		$query = '%' . $query . '%';
		return db::query('select * from funcionario where funcionario_nome like :name or funcionario_divisao like :name or funcionario_cpf like :name or funcionario_funcao like :name or funcionario_type like :name or funcionario_status like :name;', [':name' => $query]);
	}

	public function get_by($data, $limit = 1) {
		return db::select('funcionario', '*', $data, $limit);
	}

	public function get_by_id($id) {
		return db::select('funcionario', '*', ['funcionario_id' => $id], 1);
	}

	public function userExists($data = false) {
		return (db::select('funcionario', '*', $data));
	}

	public function get_list($data) {
		return db::select('funcionario', '*', $data, 10, 'funcionario_id ASC');
	}

	public function get_count($data) {
		return db::count('funcionario', $data);
	}

	// 
	// 	User types
	// 

	public function get_types() {
		return db::select('funcionario_type', '*');
	}


}