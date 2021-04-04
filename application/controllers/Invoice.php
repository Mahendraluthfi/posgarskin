<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{		
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }
	    $this->load->model('mproduct');
	    $this->load->model('minvoice');
	    date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['content'] = 'invoice';
		$this->load->view('index', $data);		
	}

	function get_data_type()
	{
		$list = $this->minvoice->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->idInvoice;
			$row[] = $field->customer;	
			$row[] = $field->dateInvoice;	
			$row[] = number_format($field->totalPrice);	
			$row[] = $field->notice;	
			$row[] = '<button type="button" class="btn btn-primary btn-xs" onclick="detail(\''.$field->idInvoice.'\')"><i class="fa fa-edit"></i></button>';	

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->minvoice->count_all(),
			"recordsFiltered" => $this->minvoice->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function add()
	{
		$id = date('Ymd').bin2hex(random_bytes(5));		
		$cek = $this->db->get_where('g_invoice', array('status' => 0));
		if ($cek->num_rows() > 0) {
			$get = $cek->row();
			$data['id_inv'] = $get->idInvoice;
			$data['item'] = $this->minvoice->invoice_list($get->idInvoice)->result();
			$data['numrow'] = $this->minvoice->invoice_list($get->idInvoice)->num_rows();
		}else{
			$this->db->insert('g_invoice', array(
				'idInvoice' => $id
			));
			$data['id_inv'] = $id;
			$data['item'] = $this->minvoice->invoice_list($id)->result();
			$data['numrow'] = $this->minvoice->invoice_list($id)->num_rows();

		}	
		$data['content'] = 'invoice_add';		
		$this->load->view('index', $data);		
		// print_r($item);
	}

	function sum_of_inv()
	{
		$data = $this->minvoice->sumofinv($this->session->userdata('inv'))->row();
		echo json_encode($data);
	}

	function get_invoice(){
		$data = $this->minvoice->get_inv($this->session->userdata('inv'))->result();
		echo json_encode($data);
	}

	function add_invoice(){
		$idp = $this->input->post('prod');
		$qty = $this->input->post('qty');
		$insert = array(
			'idInvoice' => $this->session->userdata('inv'),
			'idProduct' => $this->input->post('prod'),
			'priceIn' => $this->input->post('price'),
			'qtyProduct' => $this->input->post('qty'),
			'totalPrice' => ($this->input->post('qty') * $this->input->post('price'))
		);
		$this->db->query("UPDATE g_products SET productStock = productStock - '$qty' WHERE idProduct = '$idp'");
		$data = $this->db->insert('g_invoice_det', $insert);
		echo json_encode($data);
	}

	function delete(){
		$id=$this->input->post('kode');		
		$data = $this->minvoice->delete($id);
		echo json_encode($data);
	}

	public function save(){
		foreach ($this->minvoice->sumofinv($this->session->userdata('inv'))->result() as $key) {
			$sum = $key->ttl;
		}
		$data = array(
			'idInvoice' => $this->session->userdata('inv'),
			'customer' => $this->input->post('cst'),
			'dateInvoice' => $this->input->post('date'),
			'totalPrice' => $sum,
			'notice' => $this->input->post('ket')
		);
		$this->db->insert('g_invoice', $data);
		$this->db->insert('g_log', array(
			'datetime' => date('Y-m-d H:i:s'),
			'user' => $this->session->userdata('user'),
			'log' => $this->session->userdata('user').' melakukan transaksi Penjualan'
		));	
		$this->session->unset_userdata('inv');
		redirect('invoice','refresh');
	}

	public function get_detail($id)
	{
		$data = $this->minvoice->invoice_list($id)->result();
		echo json_encode($data);
	}

	public function add_item()
	{

		$idProduct = $this->input->post('idProduct');
		$qtyProduct = $this->input->post('jmlbeli');
		$priceIn = $this->input->post('selectharga');
		$disc = $this->input->post('diskon');
		if ($disc=="") {
			# code...
			$totalPrice = ($qtyProduct * $priceIn);
		}else{
			$totalPrice = ($qtyProduct * $priceIn) - $disc;
		}
		$cekstok = $this->db->get_where('g_products', array('idProduct' => $idProduct))->row();
		if ($cekstok->productStock < $qtyProduct) {
			$this->session->set_flashdata('msg', 
            '<div class="alert alert-danger">
                <strong>Jumlah beli melebihi stok !</strong>                
            </div>');		
		}else{

			$this->db->insert('g_invoice_det',array(
				'idInvoice' => $this->input->post('id_inv'),
				'idProduct' => $this->input->post('idProduct'),
				'priceIn' => $this->input->post('selectharga'),
				'qtyProduct' => $this->input->post('jmlbeli'),
				'disc' => $this->input->post('diskon'),
				'totalPrice' => $totalPrice,
			));

			$this->db->query("UPDATE g_products SET productStock = productStock - '$qtyProduct' WHERE idProduct = '$idProduct'");

		}

		redirect('invoice/add','refresh');

	}

	public function search_product()
	{
		$keyword = $this->input->post('search_keyword');
		$data = $this->db->query("SELECT * FROM g_products WHERE productName LIKE '%$keyword%' LIMIT 10")->result();
		// $data = $this->db->get('g_products')->result();
		echo json_encode($data);
	}

	public function get_item()
	{
		$idProduct = $this->input->post('idProduct');

		$data = $this->db->get_where('g_products', array('idProduct' => $idProduct))->row();
		echo json_encode($data);
	}

	public function del_item($id)
	{
		$get = $this->db->get('g_invoice_det', array('idInvoiceDet' => $id))->row();

		$this->db->query("UPDATE g_products SET productStock = productStock + '$get->qtyProduct' WHERE idProduct = '$get->idProduct'");

		$this->db->where('idInvoiceDet', $id);
		$this->db->delete('g_invoice_det');
		redirect('invoice/add','refresh');
	}

	public function submit_transaksi($id)
	{
		$this->db->where('idInvoice', $id);
		$this->db->update('g_invoice', array(
			'customer' => $this->input->post('customer'),
			'dateInvoice' => date('Y-m-d'),
			'totalPrice' => $this->input->post('totalPrice'),
			'notice' => $this->input->post('catatan'),
			'status' => 1,
		));
		
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-info">
                <strong>Simpan Berhasil !</strong>                
            </div>');

		redirect('invoice','refresh');
	}
}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */