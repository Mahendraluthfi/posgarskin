<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }	    
	}

	public function index()
	{
		$data['row'] = $this->db->get_where('g_supplier', array('supplierIndex' => '1'))->result();
		$data['content'] = 'supplier';
		$this->load->view('index', $data);		
	}

	public function get($id)
	{
		$data = $this->db->get_where('g_supplier', array('idSupplier' => $id))->row();
		echo json_encode($data);
	}

	public function simpan(){		
		$data = array(				
				'supplierName' => $this->input->post('namasupplier'),
				'contact' => $this->input->post('contact')				
			);
		$this->db->insert('g_supplier', $data);
		$this->db->insert('g_log', array(
			'datetime' => date('Y-m-d H:i:s'),
			'user' => $this->session->userdata('user'),
			'log' => $this->session->userdata('user').' menambahkan Data Supplier baru'
		));				 
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-info">
                <strong>Simpan Berhasil !</strong>                
            </div>');		
		echo json_encode(array("status" => TRUE));
	}

	public function edit($id){
		$data = array(								
				'supplierName' => $this->input->post('namasupplier'),
				'contact' => $this->input->post('contact')						
			);
		$this->db->where('idSupplier', $id);
		$this->db->update('g_supplier', $data);	
		$this->db->insert('g_log', array(
				'datetime' => date('Y-m-d H:i:s'),
				'user' => $this->session->userdata('user'),
				'log' => $this->session->userdata('user').' mengubah Data Supplier'
			));		
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-success">
                <strong>Edit Berhasil !</strong>                
            </div>');
		echo json_encode(array("status" => TRUE));
	}

	public function hapus($id)
	{
		$this->db->where('idSupplier', $id);
		$this->db->update('g_supplier', array('supplierIndex' => '0'));
		$this->db->insert('g_log', array(
				'datetime' => date('Y-m-d H:i:s'),
				'user' => $this->session->userdata('user'),
				'log' => $this->session->userdata('user').' menghapus Data Supplier'
			));	
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-success">
                <strong>Hapus Berhasil !</strong>                
            </div>');
		redirect('supplier','refresh');
	}

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */