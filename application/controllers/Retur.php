<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }	    
	    $this->load->model('mproduct');
	    $this->load->model('minvoice');
	}

	public function index()
	{
		$data['row'] = $this->minvoice->show_retur()->result();
		$data['sup'] = $this->db->get_where('g_supplier', array('supplierIndex' => '1'))->result();		
		$data['prod'] = $this->mproduct->get()->result();						
		$data['content'] = 'retur';
		$this->load->view('index', $data);		
	}	

	public function simpan(){		
		$data = array(				
				'idProduct' => $this->input->post('prod'),
				'idSupplier' => $this->input->post('supplier'),
				'date' => $this->input->post('date'),
				'qty' => $this->input->post('qty'),
				'notice' => $this->input->post('ket')				
			);
		$qty = $this->input->post('qty');
		$prod = $this->input->post('prod');
		$this->db->insert('g_retur', $data);
		$this->db->query("UPDATE g_products SET productStock = productStock - '$qty' WHERE idProduct='$prod'");
		$this->db->insert('g_log', array(
			'datetime' => date('Y-m-d H:i:s'),
			'user' => $this->session->userdata('user'),
			'log' => $this->session->userdata('user').' menambahkan Data Retur baru'
		));				 
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-info">
                <strong>Simpan Berhasil !</strong>                
            </div>');		
		echo json_encode(array("status" => TRUE));
	}

}

/* End of file Retur.php */
/* Location: ./application/controllers/Retur.php */