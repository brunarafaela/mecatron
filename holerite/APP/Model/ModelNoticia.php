<?php

include_once('conf/db.php');

class ModelNoticia extends db{

	function __construct(){
		parent::__construct();
	}

	public function create($data) {
		db::insert('noticias', $data);
		$last = db::lastRow('noticias', 'news_id');
		return $last;
	}

	public function edit_news($data, $where) {
		return db::update('noticias', $data, $where);
	}

	public function get_by($data, $limit = 1) {
		return db::select('noticias', '*', $data, $limit);
	}

	public function get_by_id($id) {
		return db::select('noticias', '*', ['news_id' => $id], 1);
	}

	public function get_last() {
		return db::select('noticias', '*', ['news_status' => 1], 10, 'news_id DESC');
	}



}