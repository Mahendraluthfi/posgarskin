<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }
	    $this->load->model('mproduct');	    
	    $this->load->model('mpurchase');	    
	}

	public function index()
	{
		$data['content'] = 'purchase';
		$data['row'] = $this->mpurchase->purchase_order()->result();
		$this->load->view('index', $data);				
	}

	public function add()
	{
		$cek = $this->db->get('g_purchase');
		if (empty($cek->num_rows())) {
			$kodepo = 'PO-10001';
		}else{
			foreach ($cek->result() as $key) {
				$a = substr($key->purchaseOrder, 3, 5);
				$kode = $a + 1;
				$kodepo = "PO-".$kode;
			}
		}
		$array = array(
			'po' => $kodepo
		);		
		$this->session->set_userdata( $array );
		$data['row'] = $this->mproduct->get()->result();		
		$data['sup'] = $this->db->get_where('g_supplier', array('supplierIndex' => '1'))->result();			
		$data['polist'] = $this->mpurchase->purchase_list($this->session->userdata('po'))->result();
		$data['content'] = 'purchase_add';
		$this->load->view('index', $data);					
	}

	public function save()
	{
		$data = array(
			'purchaseOrder' => $this->session->userdata('po'), 
			'idProduct' => $this->input->post('product'), 
			'qty' => $this->input->post('qty'), 
			'notice' => $this->input->post('note') 
		);
		$this->db->insert('g_purchase_det', $data);
		// redirect('purchase/add','refresh');
		echo json_encode(true);
	}

	public function delete()
	{
		$this->db->where('idProductsIn', $this->input->post('id'));
		$this->db->delete('g_purchase_det');
		echo json_encode(true);
	}

	public function savepo()
	{
		$po = $this->session->userdata('po');
		$fetch = $this->mpurchase->purchase_list($this->session->userdata('po'))->result();
		foreach ($fetch as $key) {
			$this->db->query("UPDATE g_products set productStock = productStock + '$key->qty' WHERE idProduct='$key->idProduct'");			
		}
		
		foreach ($this->db->query("SELECT SUM(qty) as qty FROM g_purchase_det WHERE purchaseOrder='$po'")->result() as $x) {
			$qty = $x->qty;
		}

		$this->db->insert('g_purchase', array(
			'purchaseOrder' => $po,
			'idSupplier' => $this->input->post('idSupplier'),
			'date' => date('Y-m-d'),
			'totalitem' => $qty
		));
		// $this->db->insert('g_log', array(
		// 	'datetime' => date('Y-m-d H:i:s'),
		// 	'user' => $this->session->userdata('user'),
		// 	'log' => $this->session->userdata('user').' melakukan transaksi Barang masuk'
		// ));	
		$this->session->unset_userdata('po');
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-info">
                <strong>Simpan Berhasil !</strong>                
            </div>');
		redirect('purchase','refresh');
	}

	public function get_detail($id)
	{
		$data = $this->mpurchase->purchase_list($id)->result();
		echo json_encode($data);
	}

	public function get_polist()
	{
		$data = $this->mpurchase->purchase_list($this->session->userdata('po'))->result();
		echo json_encode($data);
	}

	public function get_supplier($id)
	{
		$data = $this->db->get_where('g_supplier', array('idSupplier' => $id))->row();
		echo json_encode($data);
	}
}

/* End of file Purchase.php */
/* Location: ./application/controllers/Purchase.php */