<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preorder extends CI_Controller {

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
		$data['preorder'] = $this->db->get_where('g_preorder', array('status' => 0))->result();
		$data['order'] = $this->db->get_where('g_preorder', array('status' => 1))->result();
		$data['content'] = 'preorder';
		$this->load->view('index', $data);		
	}

	public function get($id)
	{
		$data = $this->db->get_where('g_preorder', array('idPreorder' => $id))->row();
		echo json_encode($data);
	}

	public function simpan()
	{
			

		$this->db->insert('g_preorder', array(
			'idPreorder' => strtoupper(bin2hex(random_bytes(4))),
			'dateorder' => $this->input->post('dateorder'),
			'daterelease' => $this->input->post('daterelease'),
			'namaBarang' => $this->input->post('namaBarang'),
			'jml' => $this->input->post('jml'),
			'totalBayar' => $this->input->post('totalBayar'),
			'dp' => $this->input->post('dp'),
			'customer' => $this->input->post('customer'),
			'no_hp' => $this->input->post('no_hp'),
			'keterangan' => $this->input->post('keterangan')
		));

		echo json_encode(true);
	}

	public function edit($id)
	{
		$this->db->where('idPreorder', $id);
		$this->db->update('g_preorder', array(
			'dateorder' => $this->input->post('dateorder'),
			'daterelease' => $this->input->post('daterelease'),
			'namaBarang' => $this->input->post('namaBarang'),
			'jml' => $this->input->post('jml'),
			'totalBayar' => $this->input->post('totalBayar'),
			'dp' => $this->input->post('dp'),
			'customer' => $this->input->post('customer'),
			'no_hp' => $this->input->post('no_hp'),
			'keterangan' => $this->input->post('keterangan')
		));

		echo json_encode(true);
		
	}

	public function delete($id)
	{
		$this->db->where('idPreorder', $id);
		$this->db->delete('g_preorder');

		redirect('preorder','refresh');
	}

	public function pelunasan()
	{
		$this->db->where('idPreorder', $this->input->post('idPreorder'));
		$this->db->update('g_preorder', array(
			'pelunasan' => $this->input->post('pelunasan'),
			'keterangan' => $this->input->post('keterangan_tf'),
			'status' => 1
		));

		echo json_encode(true);
	}
}

/* End of file Preorder.php */
/* Location: ./application/controllers/Preorder.php */