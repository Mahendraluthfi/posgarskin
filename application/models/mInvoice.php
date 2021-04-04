<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MInvoice extends CI_Model {

	var $table = 'g_invoice'; //nama tabel dari database
	var $column_order = array(null, 'idInvoice','customer','dateInvoice','totalPrice','notice'); //field yang ada di table
	var $column_search = array('idInvoice','customer','dateInvoice','totalPrice','notice'); //field yang diizin untuk pencarian 
	var $order = array('idInvoice' => 'asc'); // default order 

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$this->db->where('status', 1);	

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	public function get_inv($id)
		{
			$this->db->select('g_invoice_det.*, g_products.productName, g_type.typeName');
			$this->db->from('g_invoice_det');
			$this->db->join('g_products', 'g_products.idProduct = g_invoice_det.idProduct');
			$this->db->join('g_type', 'g_products.idType = g_type.idType');
			$this->db->where('g_invoice_det.idInvoice', $id);
			$db = $this->db->get();
			return $db;
		}	

	public function delete($id)
	{
		foreach ($this->db->get_where('g_invoice_det', array('idInvoiceDet' => $id))->result() as $key) {
			$this->db->query("UPDATE g_products SET productStock = productStock + '$key->qtyProduct' WHERE idProduct = '$key->idProduct'");			
		}
		$this->db->where('idInvoiceDet', $id);
		$this->db->delete('g_invoice_det');
	}

	public function sumofinv($id)
	{
		$this->db->select('CASE WHEN SUM(totalPrice) > 0 then SUM(totalPrice) ELSE 0 END AS ttl');
		$this->db->from('g_invoice_det');
		$this->db->where('idInvoice', $id);
		$db = $this->db->get();
		return $db;
	}
	
	public function invoice_list($id)
	{
		$this->db->select('g_invoice_det.*, g_products.productName, g_products.jenisProduct');
		$this->db->from('g_invoice_det');
		$this->db->join('g_products', 'g_invoice_det.idProduct = g_products.idProduct');
		$this->db->where('g_invoice_det.idInvoice', $id);
		$db = $this->db->get();
		return $db;
	}

	public function show_retur()
	{
		$this->db->select('g_retur.*, g_supplier.supplierName, g_products.productName, g_products.jenisProduct');
		$this->db->from('g_retur');
		$this->db->join('g_supplier', 'g_retur.idSupplier = g_supplier.idSupplier');
		$this->db->join('g_products', 'g_retur.idProduct = g_products.idProduct');
		// $this->db->join('g_type', 'g_products.idType = g_type.idType');
		return $this->db->get();

	}

}

/* End of file mInvoice.php */
/* Location: ./application/models/mInvoice.php */