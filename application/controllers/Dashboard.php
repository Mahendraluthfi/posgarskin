<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }
	    $this->load->model('mdashboard');
	}
	public function index()
	{
		$data['content'] = 'dashboard';
		$data['log'] = $this->db->query("SELECT * FROM g_log order by idLog desc LIMIT 9")->result();
		$data['alert'] = $this->db->query("SELECT * FROM g_products WHERE productStock < 4")->num_rows();
		$data['rprod'] = $this->db->get_where('g_products', array('productIndex' => '1'))->num_rows();
		$data['rtype'] = $this->db->get_where('g_type', array('typeIndex' => '1'))->num_rows();
		$data['rsupplier'] = $this->db->get_where('g_supplier', array('supplierIndex' => '1'))->num_rows();
		$this->load->view('index', $data);
	}

	public function log()
	{
		$data['content'] = 'log';
		$this->load->view('index', $data);
	}

	function get_data_log()
	{
		$list = $this->mdashboard->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->datetime;
			$row[] = $field->user;				
			$row[] = $field->log;				

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdashboard->count_all(),
			"recordsFiltered" => $this->mdashboard->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */