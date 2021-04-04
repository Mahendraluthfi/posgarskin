<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('././vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }
	    $this->load->model('mproduct');
	}

	public function index()
	{
		$data['row'] = $this->db->get('g_products')->result();		
		$data['content'] = 'product';
		$this->load->view('index', $data);		
	}

	public function get($id)
	{
		$data = $this->mproduct->get_id($id)->row();
		echo json_encode($data);
	}

	public function get_price()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('g_products', array('idProduct' => $id))->row();
		echo json_encode($data);
	}

	public function simpan(){				
		$data = array(				
				'productName' => $this->input->post('namaproduk'),
				'jenisProduct' => $this->input->post('jenisproduk'),
				'harga1' => str_replace(',', '', $this->input->post('harga1')),
				'harga2' => str_replace(',', '', $this->input->post('harga2')),
				'harga3' => str_replace(',', '', $this->input->post('harga3'))				
			);
		$this->db->insert('g_products', $data);
		// $this->db->insert('g_log', array(
		// 	'datetime' => date('Y-m-d H:i:s'),
		// 	'user' => $this->session->userdata('user'),
		// 	'log' => $this->session->userdata('user').' menambahkan Data Produk baru'
		// ));				 
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-info">
                <strong>Simpan Berhasil !</strong>                
            </div>');	
		echo json_encode(array("status" => TRUE));
	}

	public function edit($id){
		$data = array(								
				'productName' => $this->input->post('namaproduk'),
				'jenisProduct' => $this->input->post('jenisproduk'),
				'harga1' => str_replace(',', '', $this->input->post('harga1')),
				'harga2' => str_replace(',', '', $this->input->post('harga2')),
				'harga3' => str_replace(',', '', $this->input->post('harga3'))				
			);
		$this->db->where('idProduct', $id);
		$this->db->update('g_products', $data);	
		// $this->db->insert('g_log', array(
		// 		'datetime' => date('Y-m-d H:i:s'),
		// 		'user' => $this->session->userdata('user'),
		// 		'log' => $this->session->userdata('user').' mengubah Data Produk'
		// 	));		
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-success">
                <strong>Edit Berhasil !</strong>                
            </div>');
		echo json_encode(array("status" => TRUE));
	}

	public function hapus($id)
	{
		$this->db->where('idProduct', $id);
		$this->db->delete('g_products');
		$this->db->insert('g_log', array(
				'datetime' => date('Y-m-d H:i:s'),
				'user' => $this->session->userdata('user'),
				'log' => $this->session->userdata('user').' menghapus Data Produk'
			));	
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-success">
                <strong>Hapus Berhasil !</strong>                
            </div>');
		redirect('product','refresh');
	}

	public function checkFileValidation($string) {
      $file_mimes = array('text/x-comma-separated-values', 
      	'text/comma-separated-values', 
      	'application/octet-stream', 
      	'application/vnd.ms-excel', 
      	'application/x-csv', 
      	'text/x-csv', 
      	'text/csv', 
      	'application/csv', 
      	'application/excel', 
      	'application/vnd.msexcel', 
      	'text/plain', 
      	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      );
      if(isset($_FILES['fileURL']['name'])) {
			$arr_file = explode('.', $_FILES['fileURL']['name']);
			$extension = end($arr_file);
            if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)){
                return true;
            }else{
                $this->form_validation->set_message('checkFileValidation', 'Please choosse correct file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }

	public function upload() {
    	$data = array();
		$data['row'] = $this->db->get('g_products')->result();		

		$data['content'] = 'product';        
    	 // Load form validation library
         $this->load->library('form_validation');
         $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
         if($this->form_validation->run() == false) {
            
			$this->load->view('index', $data);
            
         } else {
            // If file uploaded
            if(!empty($_FILES['fileURL']['name'])) { 
            	// get file extension
            	$extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);

            	if($extension == 'csv'){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} elseif($extension == 'xlsx') {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				}
				// file path
				$spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			
				// array Count
				$arrayCount = count($allDataInSheet);
	            $flag = 0;
	            $createArray = array('NAMA_PRODUK', 'JENIS', 'HARGA1', 'HARGA2', 'HARGA3', 'STOK');
	            $makeArray = array('NAMA_PRODUK' => 'NAMA_PRODUK', 'JENIS' => 'JENIS', 'HARGA1' => 'HARGA1', 'HARGA2' => 'HARGA2', 'HARGA3' => 'HARGA3', 'STOK' => 'STOK');
	            $SheetDataKey = array();
	            foreach ($allDataInSheet as $dataInSheet) {
	                foreach ($dataInSheet as $key => $value) {
	                    if (in_array(trim($value), $createArray)) {
	                        $value = preg_replace('/\s+/', '', $value);
	                        $SheetDataKey[trim($value)] = $key;
	                    } 
	                }
	            }
	            $dataDiff = array_diff_key($makeArray, $SheetDataKey);
	            if (empty($dataDiff)) {
                	$flag = 1;
            	}
            	// match excel sheet column
	            if ($flag == 1) {
	                for ($i = 2; $i <= $arrayCount; $i++) {
	                    $addresses = array();
	                    $namaproduk = $SheetDataKey['NAMA_PRODUK'];
	                    $jenis = $SheetDataKey['JENIS'];
	                    $harga1 = $SheetDataKey['HARGA1'];
	                    $harga2 = $SheetDataKey['HARGA2'];
	                    $harga3 = $SheetDataKey['HARGA3'];
	                    $stok = $SheetDataKey['STOK'];

	                    $namaproduk = filter_var(trim($allDataInSheet[$i][$namaproduk]), FILTER_SANITIZE_STRING);
	                    $jenis = filter_var(trim($allDataInSheet[$i][$jenis]), FILTER_SANITIZE_STRING);
	                    $harga1 = filter_var(trim($allDataInSheet[$i][$harga1]), FILTER_SANITIZE_EMAIL);
	                    $harga2 = filter_var(trim($allDataInSheet[$i][$harga2]), FILTER_SANITIZE_EMAIL);
	                    $harga3 = filter_var(trim($allDataInSheet[$i][$harga3]), FILTER_SANITIZE_EMAIL);
	                    $stok = filter_var(trim($allDataInSheet[$i][$stok]), FILTER_SANITIZE_STRING);
	                    $fetchData[] = array('productName' => $namaproduk, 'jenisProduct' => $jenis, 'harga1' => $harga1, 'harga2' => $harga2, 'harga3' => $harga3, 'productStock' => $stok);	                    
	                }   
	                $data['dataInfo'] = $fetchData;
	                $this->mproduct->setBatchImport($fetchData);
	                $this->mproduct->importData();
	                // $data['content'] = 'product';
					// $data['row'] = $this->db->get('g_products')->result();		

	                // print_r($fetchData);
	            } else {
	                // echo "Please import correct file, did not match excel sheet column";
	                // $data['content'] = 'product';
					// $data['row'] = $this->db->get('g_products')->result();		

	            }

				redirect('product','refresh');
        	}              
    	}
	}

	public function editharga()
	{
		$this->db->select('*');
		$this->db->from('g_editsementara');
		$this->db->join('g_products', 'g_products.idProduct = g_editsementara.idProduct');
		$get = $this->db->get();
		$data['content'] = 'editharga';
		$data['get'] = $get->result();
		$data['showlist'] = $this->db->query("SELECT * FROM g_products WHERE idProduct NOT IN (SELECT idProduct FROM g_editsementara)")->result();
		$this->load->view('index', $data);
	}

	public function editin($id)
	{
		$this->db->insert('g_editsementara', array(
			'idProduct' => $id
		));

		redirect('product/editharga','refresh');
	}

	public function hapus_sementara($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('g_editsementara');
		redirect('product/editharga','refresh');
	}

	public function simpanharga()
	{
		$get = $this->db->get('g_editsementara')->result();

		foreach ($get as $data) {
			$this->db->where('idProduct', $data->idProduct);
			$this->db->update('g_products', array(
				'harga1' => $this->input->post('harga1'),
				'harga2' => $this->input->post('harga2'),
				'harga3' => $this->input->post('harga3'),
			));
		}

		// $this->db->delete('g_editsementara');
		$this->db->truncate('g_editsementara');
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-info">
                <strong>Simpan Berhasil !</strong>                
            </div>');	
		redirect('product','refresh');
	}

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */