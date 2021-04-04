<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
 	    if($this->auth->is_logged_in() == false){          
        	$this->load->view('login');
        }else{
            redirect('dashboard','refresh');
        }		
	}

	public function submit()
	{
		$username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $input = array(
            'user' => $username,
            'password' => $password
        );
        $cek = $this->db->get_where('g_users',array('user' => $username, 'password' => $password));
        if (!empty($cek->num_rows())) {
           
            $get = $cek->result();
            foreach ($get as $key) {
            /*    $id = $key->id_akses
                $user = $key->username
                $level = $key->level
            */
                $ses_admin = array(
                    'idUsers' => $key->idUsers,
                    'user' => $key->user                 
                );
            }         
            $this->session->set_userdata($ses_admin);            
            redirect('dashboard','refresh');
        }else{     
            $this->session->set_flashdata('msg','
                <div class="alert alert-danger" role="alert">
                  Username atau Password Salah !
                </div>
                ');       
            redirect('login');
        }
	}

	public function logout()
	{
		$ses_admin = array(
            'idUsers',
            'user'
        );
		$this->session->unset_userdata($ses_admin);			
		redirect(base_url());
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */