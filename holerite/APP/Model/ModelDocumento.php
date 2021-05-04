<?php

include_once('conf/db.php');

class ModelDocumento extends db{

	private $visible = [];

	function __construct(){
		parent::__construct();
	}

	public function create($data) {
		return db::insert('documento', $data);
	}

	public function remover($documento_id) {
		return db::delete('documento', ['documento_id' => $documento_id]);
	}

	public function get_list($data) {
		return db::query('select *, d.funcionario_id as funcionario_id from documento as d left join funcionario as f on d.funcionario_id = f.funcionario_id WHERE documento_ano = :ano and documento_mes = :mes', [':mes' => $data['documento_mes'], ':ano' => $data['documento_ano']]);
	}

	public function get_user_list($data) {
		return db::query('select *, d.funcionario_id as funcionario_id from documento as d left join funcionario as f on d.funcionario_id = f.funcionario_id WHERE d.funcionario_id = :id', [':id' => $data['funcionario_id']]);
	}

	public function get_meus($data) {
		return db::select('documento', '*', $data, 12, 'documento_ano DESC, documento_mes DESC, documento_id ASC');
	}

	public function get_grouped_list() {
		return db::query('SELECT count(*) as total, documento_ano, documento_mes FROM documento as d 
		left join funcionario as f on d.funcionario_id = f.funcionario_id
		group by documento_ano, documento_mes
		order by documento_ano desc, documento_mes desc;');
	}



}
