<?php 

Class acesso {

	private $db = array(
		'production' 	=> array(
			'host' => 'localhost',
			'user' => 'brunaraf_holerite',
			'password' => 'nX2lA~du+Sxn',
			'database' => 'brunaraf_holerite'
		),
		'testing' 		=> array(
			'host' => 'localhost',
			'user' => 'brunaraf_holerite',
			'password' => 'nX2lA~du+Sxn',
			'database' => 'brunaraf_holerite'
		),
		'development' 	=> array(
			'host' => 'localhost',
			'user' => 'brunaraf_holerite',
			'password' => 'nX2lA~du+Sxn',
			'database' => 'brunaraf_holerite'
		),
	);

	public function getdb($ambient = 'development'){
		return $this->db[$ambient];
	}

}