<?php if ( ! defined('BASEPATH')){exit('No direct script access allowed'); }
class Errors extends MY_controller {

	public function __construct (){
		parent::__construct();
	}

	public function not_found (){

        $this->output->set_status_header('404');

		$this->template->set('pageTitle', 'Page not found')
					   ->build('404');

	}

}




