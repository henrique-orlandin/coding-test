<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class MY_Form_validation extends CI_Form_validation {

	public function __construct() {
		parent::__construct();
	}

	function error_array() {

		foreach ($this->_error_array as $key => $errorPos)
			$this->_error_array[$key] = $this->_error_messages[$key];
		
		if (count($this->_error_array) === 0)
			return FALSE;
		else
			return $this->_error_array;
	}
}