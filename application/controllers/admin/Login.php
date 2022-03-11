<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('M_artikel');
        
    }
	
	public function index(){
        $this->load->view('member/Login');
	}
		
	public function doLogin() {
        $dataPost = $this->input->post();
        if ($this->m_login->checkLogin($dataPost['email'], $dataPost['pass'])) {
			redirect('admin/dashboard');
		}elseif($this->m_login->checkLogin_dosen($dataPost['email'], $dataPost['pass'])){
			
			redirect('admin/dashboard');
        }else{
			$this->session->set_flashdata('GagalLogin', 'Ya');
            redirect('login');
        }
    }
	
    function logout() {
        $this->session->unset_userdata('loginData');
        redirect('admin/login');
    }
	
	function register_dosen(){
		$post = $this->input->post();
		if($post['pass'] == $post['r_pass']){
			$insertData = array(
				"nip"			=>	$post['nip'],
				"nama"			=>	$post['nama'],
				"email"			=>	$post['email'],
				"password"		=>	md5($post['pass']),
				"nohp"			=>	$post['nohp'],
				"jeniskelamin"	=>	$post['jeniskelamin'],
				"alamat"		=>	$post['alamat']
			);
			$check1 = $this->m_login->check_email_dosen($post['email']);
			$check2 = $this->m_login->check_email_petugas($post['email']);
			if($check1 < 1 AND $check2 < 1){
				if($this->db->insert("dosen",$insertData)){
					$this->email($post['email'],$this->db->insert_id());
					
					$this->session->set_flashdata('registrasiSukses', 'Ya');
					redirect('login');
				}else{
					
					$this->session->set_flashdata('registrasiGagal', 'Ya');
					redirect('login');
				}
			}else{
				
				$this->session->set_flashdata('registrasiGagal', 'Ya');
				redirect('login');
			}
		
		}else{
			$this->session->set_flashdata('password', 'Ya');
			redirect('login');
		}
			
	}

	public function aktivasi(){
		$data = array(
			"is_active"	=>	1
			);
		$update = $this->db->update("dosen",$data,array("id"=>$this->uri->segment(4)));
		if ($update) {
			echo "<script>alert('Aktivasi berhasil, silahkan login untuk melanjutkan aktivitas')</script>";
			echo "<script>window.location = '".base_url()."login';</script>";
		}
	}
	
	function email($par1,$par2){
		$data = array(  'subject' => 'Aktivasi Akun Anda',
						'receiver' => $par1,
						'msg' => 'Klik link dibawah ini untuk aktivasi akun anda : <br>http://operation.kpptechnology.co.id/fathi/aci/admin/login/aktivasi/'.$par2);
			$mail =  $this->htmlmail($data);
	}

	function email2(){
		$data = array(  'subject' => 'Aktivasi Akun Anda',
						'receiver' => 'fathi.rahmat@gmail.com',
						'msg' => 'Klik link dibawah ini untuk aktivasi akun anda : <br>http://operation.kpptechnology.co.id/fathi/aci/admin/login/aktivasi/');
			$mail =  $this->htmlmail($data);
	}

	public function htmlmail($data){
        $config = Array(        
			'protocol'     => 'smtp',
			'smtp_host'    => 'ssl://smtp.googlemail.com',
			'smtp_port'    =>  465,
			'smtp_user'    => 'mail.blast0@gmail.com',
			'smtp_pass'    => 'mail098*()',
			'smtp_timeout' => '10',
			'mailtype'     => 'html', 
			'charset'      => 'iso-8859-1',

        );
      

        $this->load->library('email', $config);
		$this->email->set_newline("\r\n");
    
        $this->email->from('admin-spk-mutasi@gmail.com', 'Sistem Pendukung Keputusan Mutasi Dosen');
        $this->email->to($data['receiver']);  // replace it with receiver mail id
		$this->email->subject($data['subject']); // replace it with relevant subject 
    
		$this->email->message($data['msg']);   
		if ($this->email->send()) {
			$this->email->clear ( TRUE );
			return true;
		} else {
			 echo $this->email->print_debugger();
			return false;
		}
    }
	
	
	
	public function forgetpassword(){
		$post 	= $this->input->post();
		$random = $this->generateRandomString();

		$check1 = $this->m_login->check_email_dosen($post['email']);
		$check2 = $this->m_login->check_email_petugas($post['email']);

		if ($check1 > 0 or $check2 > 0) {
			
			if ($check1 > 0) {
				$update = $this->db->update("dosen", array("password" => md5($random)), array("email"=>$post['email']));
			}elseif($check2 > 0){
				$update = $this->db->update("petugas", array("password" => md5($random)), array("email"=>$post['email']));
			}
			$this->emailRecovery($post['email'],$random);
			$this->session->set_flashdata('recoveryOk', 'Ya');
			redirect('admin/login');
		}else{
			echo "<script>alert('Email Tidak terdaftar, silahkan coba lagi')</script>";
			echo "<script>window.location = '".base_url()."login';</script>";
		}
	}

	public function emailRecovery($par,$par2){
		$data = array(  
			'subject' => 'Recovery Email',
			'receiver' => $par,
			'msg' => 'Password anda berhasil di reset, silahkan masukan password baru anda: '.$par2
			);
		$mail =  $this->htmlmail($data);
	}

	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	
}
