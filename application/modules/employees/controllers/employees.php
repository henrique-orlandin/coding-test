<?php if ( ! defined('BASEPATH')){exit('No direct script access allowed'); }
class Employees extends MY_controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('employees_m');
		$this->autoLoadAssets();
	}

	/**
	 * Loads list of employees
	 */
	public function index ($page = 1){

        $config['uri_segment'] = 2;
		$uri = 'employees';
		
		$page = (int) $page;
		$limit = 10;

        $total = $this->employees_m->get(array(
			'count' => TRUE
		));
		
		$employees = $this->employees_m->get(array(
			'limit' => $limit,
			'offset' => ($pg - 1) * $limit
		));

		$pages = $this->configPagination($config, $uri, $total, $limit);

		$this->template->add_js('https://cdn.jsdelivr.net/npm/sweetalert2@9')
					   ->set('header', $header)
                       ->set('pageTitle', 'Coding Test - Employees')
					   ->set('pages', $pages)
					   ->set('employees', $employees)
					   ->build('list');

	}

	/**
	 * Set form data 
	 */
	public function form ($id = false){

		// get current employee data if updating
		if($id) {
			$employee = $this->employees_m->get(array('id' => $id));
			$employee->date_hired = date('m/d/Y', strtotime($employee->date_hired));
			$employee->salary = number_format($employee->salary, 2, '.', ',');
			$this->template->set('employee', array($employee));
		}
		
        $this->template->add_js('application/modules/comum/assets/plugins/datepicker/js/bootstrap-material-datetimepicker.js')
					   ->add_css('application/modules/comum/assets/plugins/datepicker/css/bootstrap-material-datetimepicker.css')
					   ->set('pageTitle', 'Coding Test - '. ($id ? 'Adding' : 'Editing'))
					   ->set('id', $id)
					   ->build('form');

	}

	/**
	 * add or edit employee
	 */
	public function save ($id = FALSE){

		//prevent not ajax request
		if(!$this->input->is_ajax_request())
			show_404();

		$this->load->library('form_validation');

		//validation
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('position', 'Position', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('salary', 'Salary', 'trim|required');
		$this->form_validation->set_rules('date_hired', 'Date Hired', 'trim|required');

		if ($this->form_validation->run() == true){

			$status = $this->employees_m->save($this->input->post(), $id);
			if ($status) {
				echo json_encode(array(
					'status' => true,
					'message' => $id ? 'Employee updated!' : 'New employee added!'
				));
			} else {
				echo json_encode(array(
					'status' => false,
					'message' => 'An unexpected error occurred!'
				));
			}

		} else {

			$errors = array_values($this->form_validation->error_array());
			echo json_encode(array(
				'status' => false,
				'message' => $errors[0]
			));

		}

	}

	/**
	 * delete employee
	 */
	public function delete ($id){

		if(!$this->input->is_ajax_request())
			show_404();

		$status = $this->employees_m->delete($id);
		if ($status) {
			echo json_encode(array(
				'status' => true,
				'message' => 'Employee deleted!'
			));
		} else {
			echo json_encode(array(
				'status' => false,
				'message' => 'An unexpected error occurred!'
			));
		}

	}

	/**
	 * show details modal
	 */
	public function show ($id){

		if(!$this->input->is_ajax_request())
			show_404();

		$employee = $this->employees_m->get(array('id' => $id));
		$employee->date_hired = date('m/d/Y', strtotime($employee->date_hired));
		$employee->salary = number_format($employee->salary, 2, '.', ',');
		if ($employee) {
			echo json_encode(array(
				'status' => true,
				'view' => $this->load->view('modal', array('employee' => $employee), true)
			));
		} else {
			echo json_encode(array(
				'status' => false,
				'message' => 'Employee not found'
			));
		}

	}

	/**
	 * pagination config
	 */
	private function configPagination ($config, $uri, $total, $limit){

        $this->load->library('pagination');

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['base_url'] = site_url($uri);
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = true;
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['next_link'] = '>';
        $config['prev_link'] = '<';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['anchor_class'] = 'class="page-link"';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();

	}
	
	/**
	 * allows index method to receive parameters
	 */
	public function _remap($method, $params = array()){

        if (method_exists($this, $method))
            return call_user_func_array(array($this, $method), $params);
        else {
            if (!empty($params) && isset($params[0]))
                $this->index($method, $params[0]);
            else
                $this->index($method);
        }
    }

}