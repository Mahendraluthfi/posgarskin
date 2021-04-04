<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPurchase extends CI_Model {

	public function purchase_list($po)
		{
			$this->db->select('g_purchase_det.*, g_products.productName, g_products.jenisProduct');
			$this->db->from('g_purchase_det');
			$this->db->join('g_products', 'g_purchase_det.idProduct = g_products.idProduct');
			// $this->db->join('g_type', 'g_products.idType = g_type.idType');
			$this->db->where('g_purchase_det.purchaseOrder', $po);
			$db = $this->db->get();
			return $db;
		}	

	public function purchase_order()
	{
		$this->db->select('g_purchase.*, g_supplier.supplierName');
		$this->db->from('g_purchase');
		$this->db->join('g_supplier', 'g_purchase.idSupplier = g_supplier.idSupplier');
		$db = $this->db->get();
		return $db;
	}
}

/* End of file mPurchase.php */
/* Location: ./application/models/mPurchase.php */