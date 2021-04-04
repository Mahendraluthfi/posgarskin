<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLaporan extends CI_Model {

	public function sum_of_inv($a,$b)
	{
		$this->db->select('SUM(g_invoice_det.totalPrice) as ttl');
		$this->db->from('g_invoice_det');
		$this->db->join('g_invoice', 'g_invoice_det.idInvoice = g_invoice.idInvoice');
		$this->db->where('g_invoice.dateInvoice >=', $a);
		$this->db->where('g_invoice.dateInvoice <=', $b);
		$db = $this->db->get();
		return $db;
	}

	public function sum_of_item($a,$b)
	{
		$this->db->select('SUM(g_invoice_det.qtyProduct) as ttlitem');
		$this->db->from('g_invoice_det');
		$this->db->join('g_invoice', 'g_invoice_det.idInvoice = g_invoice.idInvoice');
		$this->db->where('g_invoice.dateInvoice >=', $a);
		$this->db->where('g_invoice.dateInvoice <=', $b);
		$db = $this->db->get();
		return $db;
	}

	public function most_of_item($a,$b)
	{
		$this->db->select('g_products.productName, SUM(g_invoice_det.qtyProduct) as ttlitem');
		$this->db->from('g_invoice_det');
		$this->db->join('g_products', 'g_invoice_det.idProduct = g_products.idProduct');
		$this->db->join('g_invoice', 'g_invoice_det.idInvoice = g_invoice.idInvoice');
		$this->db->where('g_invoice.dateInvoice >=', $a);
		$this->db->where('g_invoice.dateInvoice <=', $b);
		$this->db->group_by('g_invoice_det.idProduct');
		$this->db->order_by('ttlitem', 'desc');
		$this->db->limit(4);
		$db = $this->db->get();
		return $db;
	}

	public function result_inv($a,$b)
	{
		$this->db->select('g_invoice_det.*, g_invoice.dateInvoice, g_invoice.customer, g_products.productName, g_type.typeName');
		$this->db->from('g_invoice_det');
		$this->db->join('g_products', 'g_invoice_det.idProduct = g_products.idProduct');
		$this->db->join('g_type', 'g_products.idType = g_type.idType');
		$this->db->join('g_invoice', 'g_invoice_det.idInvoice = g_invoice.idInvoice');
		$this->db->where('g_invoice.dateInvoice >=', $a);
		$this->db->where('g_invoice.dateInvoice <=', $b);			
		$db = $this->db->get();
		return $db;
	}

	public function sum_of_item_po($a,$b)
	{
		$this->db->select('SUM(g_purchase_det.qty) as ttlitem');
		$this->db->from('g_purchase_det');
		$this->db->join('g_purchase', 'g_purchase_det.purchaseOrder = g_purchase.purchaseOrder');
		$this->db->where('g_purchase.date >=', $a);
		$this->db->where('g_purchase.date <=', $b);
		$db = $this->db->get();
		return $db;
	}

	public function most_of_item_po($a,$b)
	{
		$this->db->select('g_products.productName, SUM(g_purchase_det.qty) as ttlitem');
		$this->db->from('g_purchase_det');
		$this->db->join('g_products', 'g_purchase_det.idProduct = g_products.idProduct');
		$this->db->join('g_purchase', 'g_purchase_det.purchaseOrder = g_purchase.purchaseOrder');
		$this->db->where('g_purchase.date >=', $a);
		$this->db->where('g_purchase.date <=', $b);
		$this->db->group_by('g_purchase_det.idProduct');
		$this->db->order_by('ttlitem', 'desc');
		$this->db->limit(4);
		$db = $this->db->get();
		return $db;
	}

	public function result_po($a,$b)
	{
		$this->db->select('g_purchase_det.*, g_purchase.date, g_supplier.supplierName, g_products.productName, g_type.typeName');
		$this->db->from('g_purchase_det');
		$this->db->join('g_purchase', 'g_purchase_det.purchaseOrder = g_purchase.purchaseOrder');
		$this->db->join('g_supplier', 'g_purchase.idSupplier = g_supplier.idSupplier');
		$this->db->join('g_products', 'g_purchase_det.idProduct = g_products.idProduct');
		$this->db->join('g_type', 'g_products.idType = g_type.idType');				
		$this->db->where('g_purchase.date >=', $a);
		$this->db->where('g_purchase.date <=', $b);			
		$db = $this->db->get();
		return $db;
	}

}

/* End of file mLaporan.php */
/* Location: ./application/models/mLaporan.php */