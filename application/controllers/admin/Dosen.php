<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_dosen');
		$this->load->model('M_umum');
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['kode'] 		= $this->M_dosen->code_otomatis($id);
 		$data['v_content'] = 'member/dosen/add';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['dataDetail']= $this->M_dosen->getDosenbyID($id);
 		$data['v_content'] = 'member/dosen/edit';
		$this->load->view('member/layout', $data);
	}

	public function daftar(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_dosen->getDataDosen();
 		$data['v_content'] 	= 'member/dosen/list';
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
		$insert = $this->db->insert("dosen", $insertData);
		//echo $this->db->last_query();die;
		if ($insert) {
			$this->M_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
			redirect("admin/dosen/daftar");	
		}else{
			$this->M_umum->generatePesan("Gagal Menambahkan Data","gagal");
			redirect("admin/dosen/daftar");	
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		$data['dataDetail']= $this->M_dosen->getDosenbyID($id);		
		if($_FILES['foto']['name']!=""){
			$uploaddir = 'uploads/';
			$uploadfile = $uploaddir . basename($_FILES['foto']['name']);
			move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
		}
		
		if(is_null($_FILES['foto']['name']) || empty($_FILES['foto']['name']))
				$_FILES['foto']['name'] = $data['dataDetail']['foto'];

		//if(empty($post['password'])){
			$updateData = array(
				//"nip"          => $post['NIP'],
				"nama"         => $post['nama'],
				"email"        => $post['email'],
				"nohp"         => $post['noHp'],
				"alamat"       => $post['alamat'],
				//"jeniskelamin" => $post['jk'],
				"is_active"    => $post['isActive'],
				"foto"    		=>  $_FILES['foto']['name'],
			);
		/* }else{
			$updateData = array(
				//"nip"          => $post['NIP'],
				"nama"         => $post['nama'],
				"email"        => $post['email'],
				//"password"     => md5($post['password']),
				"nohp"         => $post['noHp'],
				"alamat"       => $post['alamat'],
				//"jeniskelamin" => $post['jk'],
				"is_active"    => $post['isActive'],
				"foto"    		=>  $_FILES['foto']['name'],
			);	
		} */
		
		
		$update = $this->db->update("dosen",$updateData,array("id"=>$id));
    	$UserID = $this->session->loginData['UserID'];
		if ($update) {
			$this->M_umum->generatePesan("Update Berhasil ","berhasil");
			if($UserID == $id){
				redirect("admin/dashboard");
			}else{
				redirect("admin/dosen/daftar");	
			}			
		}else{
			$this->M_umum->generatePesan("Update Gagal","gagal");
			if($UserID == $id){
				redirect("admin/dashboard");
			}else{
				redirect("admin/dosen/daftar");	
			}
		}	
	}
	
	public function doDelete($id){
        $hapus = $this->db->delete('dosen',array('id' => $id));
		if($hapus){
			$this->M_umum->generatePesan("Berhasil Menghapus Data","berhasil");
			redirect("admin/dosen/daftar");	
		}else{
			$this->M_umum->generatePesan("Gagal Menghapus Data","gagal");
			redirect("admin/dosen/daftar");	
		}
	}

	public function active($id){
		$updateData = array("is_active"	=> 1);
		$update = $this->db->update("dosen",$updateData, array("id"=>$id));
		if ($update) {
			$this->M_umum->generatePesan("Aktivasi Dosen Berhasil ","berhasil");
			redirect("admin/dosen/daftar");	
		}else{
			$this->M_umum->generatePesan("Aktivasi Dosen Gagal","gagal");
			redirect("admin/dosen/daftar");	
		}
	}

	public function inactive($id){
		$updateData = array("is_active"	=> 0);
		$update = $this->db->update("dosen",$updateData, array("id"=>$id));
		if ($update) {
			$this->M_umum->generatePesan("Dosen berhasil di non-aktive kan","berhasil");
			redirect("admin/dosen/daftar");	
		}else{
			$this->M_umum->generatePesan("Dosen gagal di non-aktive kan","gagal");
			redirect("admin/dosen/daftar");	
		}
	}
}