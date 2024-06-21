<?php

class Sponsorships{

	private $sponsors;
	public function __construct($query_args = null)
	{
		//$this->sponsors = $this->set_sponsors($query_args);
		// $this -> all_sponsors = $all_sponsors;
	}

	private function set_sponsors($query_args = []) {
		$default_query = array(
			'numberposts' 	=> -1,
			'post_type' 	=> 'sponsor',
			'status' 		=> 'publish'
		);
		if(!is_array($query_args)){
			// clean the $arr if it's not an array
			$query_args = [];
		}
		
		$query_args = array_merge($query_args, $default_query) ;
		$posts = get_posts($query_args);
		return  $this->sponsors = $posts;
		
	}

	public function get_sponsors_by_level($level = ["gold", "silver", "bronze"]){
		$query_args = array(
			'tax_query' => array(
				array (
					'taxonomy' => 'sponsorship-level',
					'field' => 'name',
					'terms' => $level,
				)
			),
		);
		$this->set_sponsors($query_args);	
		return $this->sponsors;
	}
}