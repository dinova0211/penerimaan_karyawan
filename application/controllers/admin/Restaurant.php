<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Restaurant extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_restaurant');
		$this->load->model('M_umum');
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['kode'] 		= $this->M_restaurant->code_otomatis($id);
 		$data['v_content'] = 'member/restaurant/add';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['dataDetail']= $this->M_restaurant->getRestaurantbyID($id);
 		$data['v_content'] = 'member/restaurant/edit';
		$this->load->view('member/layout', $data);
	}

	public function daftar(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_restaurant->getDataRestaurant();
 		$data['v_content'] 	= 'member/restaurant/list';
		$this->load->view('member/layout', $data);	
	}


	public function doAdd(){
		$post = $this->input->post();
		if($_FILES['foto']['name']!=""){
			$uploaddir = 'uploads/';
			$uploadfile = $uploaddir . basename($_FILES['foto']['name']);
			move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
		}
		$insertData = array(
			"nip"          => $post['NIP'],
			"nama"         => $post['nama'],
			"email"        => $post['email'],
			//"password"     => md5($post['password']),
			"nohp"         => $post['noHp'],
			"alamat"       => $post['alamat'],
			//"jeniskelamin" => $post['jk'],
			"is_active"    => $post['isActive'],
			"foto"		   => $_FILES['foto']['name'],
		);
		$insert = $this->db->insert("restorant", $insertData);
		//echo $this->db->last_query();die;
		if ($insert) {
			$this->M_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
			redirect("admin/restaurant/daftar");	
		}else{
			$this->M_umum->generatePesan("Gagal Menambahkan Data","gagal");
			redirect("admin/restaurant/daftar");	
		}
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
				
				"restorant_name" => $post['nama'],
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
		
		
		$update = $this->db->update("restorant",$updateData,array("restorant_id"=>$id));
    	//$UserID = $this->session->loginData['UserID'];
		if ($update) {
			$this->M_umum->generatePesan("Update Berhasil ","berhasil");
		
				redirect("admin/restaurant/daftar");	
					
		}else{
			$this->M_umum->generatePesan("Update Gagal","gagal");
			if($UserID == $id){
				redirect("admin/dashboard");
			}else{
				redirect("admin/restaurant/daftar");	
			}
		}	
	}
	
	public function doDelete($id){
        $hapus = $this->db->delete('restorant',array('restorant_id' => $id));
		if($hapus){
			$this->M_umum->generatePesan("Berhasil Menghapus Data","berhasil");
			redirect("admin/restaurant/daftar");	
		}else{
			$this->M_umum->generatePesan("Gagal Menghapus Data","gagal");
			redirect("admin/restaurant/daftar");	
		}
	}

	public function active($id){
		$updateData = array("is_active"	=> 1);
		$update = $this->db->update("restorant",$updateData, array("restorant_id"=>$id));
		if ($update) {
			$this->M_umum->generatePesan("Aktivasi Dosen Berhasil ","berhasil");
			redirect("admin/restaurant/daftar");	
		}else{
			$this->M_umum->generatePesan("Aktivasi Dosen Gagal","gagal");
			redirect("admin/restaurant/daftar");	
		}
	}

	public function inactive($id){
		$updateData = array("is_active"	=> 0);
		$update = $this->db->update("restorant",$updateData, array("restorant_id"=>$id));
		if ($update) {
			$this->M_umum->generatePesan("Dosen berhasil di non-aktive kan","berhasil");
			redirect("admin/restaurant/daftar");	
		}else{
			$this->M_umum->generatePesan("Dosen gagal di non-aktive kan","gagal");
			redirect("admin/restaurant/daftar");	
		}
	}
}