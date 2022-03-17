<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Restaurant extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_umum');
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$this->load->view('member/layout', $data);
	}

	public function daftar(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$this->load->view('member/layout', $data);	
	}

	
	public function doUpdate($id){
		$post = $this->input->post();
		
		if($_FILES['foto']['name']!=""){
			$uploaddir = 'uploads/';
			$uploadfile = $uploaddir . basename($_FILES['foto']['name']);
			move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
		}
		
		if(is_null($_FILES['foto']['name']) || empty($_FILES['foto']['name']))
				$_FILES['foto']['name'] = $data['dataDetail']['foto'];

		
			$updateData = array(
				
				"email"        	=> $post['email'],
				"no_hp"         	=> $post['noHp'],
				"alamat"       	=> $post['alamat'],
				"is_active"    	=> $post['isActive'],
				//"foto"    		=>  $_FILES['foto']['name'],
				"C2"			=> $post['kriteria1'],
				"C3"			=> $post['kriteria2'],
				"C4"			=> $post['kriteria3'],
				"C6"			=> $post['kriteria4'],
				"C7"			=> $post['kriteria5']
			);
		
    	//$UserID = $this->session->loginData['UserID'];
		else{
			$this->M_umum->generatePesan("Update Gagal","gagal");
			if($UserID == $id){
				redirect("admin/dashboard");
			}else{
				redirect("admin/restaurant/daftar");	
			}
		}	
	}
}