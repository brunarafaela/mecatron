<?php 

Class OpenGraph {

	// Chaves default de SEO
	public $default_name 	= array(
		/* Default page title 			*/
		'page_title'			=> "Mecatron - Pontes Rolantes",

		/* Search engine optimization */
		'description'			=> 'Sistema interno gerenciador de holetires',
	);
		
	// Chaves default do OGP
	public $default_prop = array(

		/* 	Facebook Open Graph Protocol */
		// 'fb:app_id' 		=> '',
		'og:type' 			=> 'website',
		'og:title' 			=> 'Mecatron - Pontes Rolantes',
		'og:description' 	=> 'Sistema interno gerenciador de holetires',
		// TODO: create opengraph images
		// 'og:image' 			=> 'http://www.helpby.me/imgs/og_image.png',
		'og:url'			=> '',
		
		/* 	Twitter cards */
		'twitter:card'			=> "summary",
		'twitter:site'			=> "@",
		'twitter:creator'		=> "@",
		'og:title' 				=> 'Mecatron - Pontes Rolantes',
		'og:description' 		=> 'Sistema interno gerenciador de holetires',
		// TODO: create opengraph images
		// 'og:image' 			=> 'http://www.helpby.me/imgs/og_image.png',
		'twitter:url'			=> '',
	);
	
	public function generate($data = array(), $return = "") {

		if (isset($data['page_title'])) {
			$return .= '<title>'.$data['page_title'].'</title>'.PHP_EOL;	
		} else {
			$return .= '<title>'.$this->default_name['page_title'].'</title>'.PHP_EOL;
		}

		if (isset($data['canonical'])) {
			$this->default_prop['og:url'] 		= 'http://www.helpby.me' . $data['canonical'];
			$this->default_prop['twitter:url'] 	= 'http://www.helpby.me' . $data['canonical'];
		}

		if (isset($data['title'])) {
			$this->default_prop['og:title'] 			= str_replace('"', '&quot;', $data['title']);
			$this->default_prop['twitter:title'] 	= $this->default_prop['og:title'];
		}

		if (isset($data['description'])) {
			$this->default_name['description'] 			= str_replace('"', '&quot;', $data['description']);
			$this->default_prop['og:description'] 		= $this->default_name['description'];
			$this->default_prop['twitter:description'] 	= $this->default_name['description'];
		}

		foreach ($this->default_name as $key => $value) {
			$return .= "\t" . '<meta name="'.$key.'" content="'.$value.'" />'.PHP_EOL;
		}

		foreach ($this->default_prop as $key => $value) {
			$return .= "\t" . '<meta property="'.$key.'" content="'.$value.'" />'.PHP_EOL;
		}

		if (isset($data['canonical'])) {
			$return .= PHP_EOL.'<link rel="canonical" href="http://mecatron.com.br'.$data['canonical'].'" />'.PHP_EOL;
		}

		return $return;
	}
}










