<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProduct extends CI_Model {	

	private $_batchImport;

	public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }
 
    // save data
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('g_products', $data);
    }

	public function get()
	{
		$this->db->select('g_products.*');
		$this->db->from('g_products');
		// $this->db->join('g_type', 'g_products.idType = g_type.idType');
		$this->db->where('g_products.productIndex','1');
		$this->db->order_by('g_products.idProduct', 'desc');
		$db = $this->db->get();
		return $db;
	}

	public function get_id($id)
	{
		$this->db->select('*');
		$this->db->from('g_products');
		$this->db->where('g_products.idProduct',$id);
		$db = $this->db->get();
		return $db;
	}



}

/* End of file mProduct.php */
/* Location: ./application/models/mProduct.php */