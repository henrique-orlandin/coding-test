<?php if ( ! defined('BASEPATH')){exit('No direct script access allowed'); }

class comum_m extends MY_model {

	/**
	 * Tabela do modulo
	*/
	var $table   = '';
	public $news_shown = array();

	/**
	 * Metodo construtor
	 *
	*/
	public function __construct()
	{
		parent::__construct();
	}

}
