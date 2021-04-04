<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{		
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }	 
	    $this->load->model('mlaporan');
	}

	public function index()
	{
		$data['content'] = 'laporan';		
		$this->load->view('index', $data);
	}

	public function sub_view_inv()
	{
		$tgla = $this->input->post('tgla');
		$tglb = $this->input->post('tglb');
		$data = array(
			'content' => 'laporan',
			'v_inv' => 'v_inv',		
			'tgla' => date('d M Y', strtotime($tgla)),		
			'tglb' => date('d M Y', strtotime($tglb)),
			'tglap' => $tgla,		
			'tglbp' => $tglb,
			'totalpenjualan' =>$this->mlaporan->sum_of_inv($tgla,$tglb)->result(),
			'totalitem' =>$this->mlaporan->sum_of_item($tgla,$tglb)->result(),
			'most' =>$this->mlaporan->most_of_item($tgla,$tglb)->result(),
			'result' =>$this->mlaporan->result_inv($tgla,$tglb)->result()
		);
		$this->load->view('index', $data);
	}	

	public function sub_view_po()
	{
		$tglc = $this->input->post('tglc');
		$tglb = $this->input->post('tgld');
		$data = array(
			'content' => 'laporan',
			'v_po' => 'v_po',		
			'tgla' => date('d M Y', strtotime($tglc)),		
			'tglb' => date('d M Y', strtotime($tglb)),
			'tglap' => $tglc,		
			'tglbp' => $tglb,			
			'totalitem_po' => $this->mlaporan->sum_of_item_po($tglc,$tglb)->result(),
			'most_po' => $this->mlaporan->most_of_item_po($tglc,$tglb)->result(),
			'result' => $this->mlaporan->result_po($tglc,$tglb)->result()
		);
		$this->load->view('index', $data);
	}	

	public function p_po($a,$b)
	{
		$data['result'] = $this->mlaporan->result_po($a,$b)->result();
		$this->load->view('p_po', $data);
	}

	public function p_inv($a,$b)
	{
		$data['result'] = $this->mlaporan->result_inv($a,$b)->result();
		$this->load->view('p_inv', $data);
	}
}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */