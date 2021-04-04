<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }
	    $this->load->model('mtype');
	}

	public function index()
	{
		// $data['row'] = $this->db->get_where('g_type', array('typeIndex' => '1'))->result();
		$data['content'] = 'type';
		$this->load->view('index', $data);		
	}

	function get_data_type()
	{
		$list = $this->mtype->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->kodeType;
			$row[] = $field->typeName;	
			$row[] = '<button type="button" class="btn btn-primary btn-xs" onclick="edit('.$field->idType.')"><i class="fa fa-edit"></i></button>
						<a href="type/hapus/'.$field->idType.'" class="btn btn-danger btn-xs" onclick="return confirm(Yakin Hapus Data)"><span class="glyphicon glyphicon-trash"></span></a>';	


			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mtype->count_all(),
			"recordsFiltered" => $this->mtype->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function get($id)
	{
		$data = $this->db->get_where('g_type', array('idType' => $id))->row();
		echo json_encode($data);
	}

	public function simpan(){
		$cek = $this->db->get_where('g_type', array('kodeType' => $this->input->post('kodejenis')));
		if ($cek->num_rows() > 0) {
			$this->session->set_flashdata('msg', 
            '<div class="alert alert-danger">
                <strong>KodeJenis sudah ada !</strong>                
            </div>');	
		}else{
			$data = array(				
					'kodeType' => strtoupper($this->input->post('kodejenis')),
					'typeName' => $this->input->post('namajenis')				
				);
			$this->db->insert('g_type', $data);
			$this->db->insert('g_log', array(
				'datetime' => date('Y-m-d H:i:s'),
				'user' => $this->session->userdata('user'),
				'log' => $this->session->userdata('user').' menambahkan Data Jenis baru'
			));				 
			$this->session->set_flashdata('msg', 
	            '<div class="alert alert-info">
	                <strong>Simpan Berhasil !</strong>                
	            </div>');
		}
		echo json_encode(array("status" => TRUE));
	}

	public function edit($id){
		$data = array(								
				'typeName' => $this->input->post('namajenis')				
			);
		$this->db->where('idType', $id);
		$this->db->update('g_type', $data);	
		$this->db->insert('g_log', array(
				'datetime' => date('Y-m-d H:i:s'),
				'user' => $this->session->userdata('user'),
				'log' => $this->session->userdata('user').' mengubah Data Jenis'
			));		
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-success">
                <strong>Edit Berhasil !</strong>                
            </div>');
		echo json_encode(array("status" => TRUE));
	}

	public function hapus($id)
	{
		$this->db->where('idType', $id);
		$this->db->update('g_type', array('typeIndex' => '0'));
		$this->db->insert('g_log', array(
				'datetime' => date('Y-m-d H:i:s'),
				'user' => $this->session->userdata('user'),
				'log' => $this->session->userdata('user').' menghapus Data Jenis'
			));	
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-success">
                <strong>Hapus Berhasil !</strong>                
            </div>');
		redirect('type','refresh');
	}

}

/* End of file Type.php */
/* Location: ./application/controllers/Type.php */