<?php

class Events{
	private $events;
	public function __construct($query_args = null)
	{
		$this->events =  $this->set_events($query_args);
	}

	private function set_events($query_args = []) {
		$default_query = array(
			'numberposts' 	=> -1,
			'post_type' 	=> 'event',
			'status' 		=> 'publish'
		);
		if(!is_array($query_args)){
			// clean the $arr if it's not an array
			$query_args = [];
		}
		
		$query_args = array_merge($default_query, $query_args) ;
		$posts = get_posts($query_args);
		return  $this->events = $posts;
		
	}

}