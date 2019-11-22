<?php if ( ! defined('BASEPATH')){exit('No direct script access allowed'); }

class Employees_m extends MY_model {

	public function __construct (){
		parent::__construct();
		log_message('info', 'load Model employees_m');
	}

	/**
	 * select method used for any kind of select
	 */
	public function get ($params) {

		//base parameters
		$options = array(
			'id' => FALSE,
			'count' => FALSE,
			'limit' => FALSE,
			'offset' => FALSE
		);
		$params = array_merge($options, $params);

		if ($params['count'])
			$this->db->select('COUNT(id) as total');
		else
			$this->db->select('*');

		$this->db->from('employees');

		if ($params['id'])
			$this->db->where('id', $params['id']);

		if ($params['limit']) {
			if ($params['offset'])
				$this->db->limit($params['limit'], $params['offset']);
			else
				$this->db->limit($params['limit']);
		}

		$query = $this->db->get();
		if($params['count']) {
			$result = $query->row();
			return $result->total;
		}

		return $params['id'] ? $query->row() : $query->result();

	}

	/**
	 * method for inserting and updating
	 */
	public function save ($data, $id = FALSE){

		$data = array(
			'name' => $data['name'],
			'email' => $data['email'],
			'position' => $data['position'],
			'phone' => $data['phone'],
			'salary' => preg_replace('/,/i','',$data['salary']),
			'date_hired' => date('Y-m-d', strtotime($data['date_hired']))
		);

		$this->db->trans_start();
		if ($id) {
			$this->db->where('id', $id)
					 ->set('updated', date('Y-m-d H:i:s'))
					 ->update('employees', $data);
		} else {
			$this->db->insert('employees', $data);
		}
		$this->db->trans_complete();

		return $this->db->trans_status();

	}

	/**
	 * deletion
	 */
	public function delete ($id = FALSE){

		$this->db->trans_start();
		$this->db->where('id', $id)->delete('employees');
		$this->db->trans_complete();

		return $this->db->trans_status();

	}

}
