<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends CI_Controller {

	public function __construct()
	{		
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }
	    
	    date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->db->from('g_topup');
		// $this->db->join('g_jenistopup', 'g_jenistopup.id = g_topup.idjenistopup');
		$this->db->order_by('date', 'desc');
		$db = $this->db->get();
		$data['get'] = $db->result();
		// $data['jenis'] = $this->db->get('g_jenistopup')->result();
		$data['content'] = 'topup';
		$this->load->view('index', $data);
	}

	public function get($id)
	{
		$data = $this->db->get_where('g_topup', array('idTopup' => $id))->row();
		echo json_encode($data);
	}

	public function simpan()
	{
		$this->db->insert('g_topup', array(
			'idTopup' => strtoupper(bin2hex(random_bytes(4))),
			'idjenistopup' => strtoupper($this->input->post('idjenistopup')),
			'date' => $this->input->post('date'),
			'idnumber' => $this->input->post('idnumber'),
			'nominal' => $this->input->post('nominal'),
			'bayar' => $this->input->post('bayar'),
			'customer' => $this->input->post('customer'),
		));

		echo json_encode(true);
	}

	public function edit($id)
	{
		$this->db->where('idTopup', $id);
		$this->db->update('g_topup', array(
			// 'idTopup' => strtoupper(bin2hex(random_bytes(4))),
			'idjenistopup' => strtoupper($this->input->post('idjenistopup')),
			'date' => $this->input->post('date'),
			'idnumber' => $this->input->post('idnumber'),
			'nominal' => $this->input->post('nominal'),
			'bayar' => $this->input->post('bayar'),
			'customer' => $this->input->post('customer'),
		));

		echo json_encode(true);
	}

	public function hapus($id)
	{
		$this->db->where('idTopup', $id);
		$this->db->delete('g_topup');
		redirect('topup','refresh');
	}



}

/* End of file Topup.php */
/* Location: ./application/controllers/Topup.php */