<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Petugas extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_Petugas');
		$this->load->model('m_umum');
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
 		$data['v_content'] = 'member/petugas/add';
		$this->load->view('member/layout', $data);
	}

	public function doAdd(){
		$post 		= $this->input->post();
		$check_dosenEmail = $this->M_Petugas->check_email_dosen($post['email']);
		$check_petugasEmail = $this->M_Petugas->check_email_petugas($post['email']);
		if ($check_dosenEmail < 1 AND $check_petugasEmail < 1) {
			$insertData = array(
			"namaPetugas"	=> $post['nama'],
			"username"		=> "",
			"password"		=> md5($post['password']),
			"email"			=> $post['email'],
			"level"			=> $post['lvl']
			);
			
			$query = $this->db->insert('petugas',$insertData);
			if($query){
				$this->m_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
				redirect("admin/petugas/daftar");
			}else{
				$this->m_umum->generatePesan("Gagal Menambahkan Data","gagal");
				redirect("admin/petugas/add");
			}
		}else{
			$this->m_umum->generatePesan("Gagal Menambahkan Data, Email Telah Di gunakan","gagal");
			redirect("admin/petugas/add");
		}
		
	}

	public function daftar(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_Petugas->listPetugas();
 		$data['v_content'] 	= 'member/petugas/list';
		$this->load->view('member/layout', $data);	
	}

	public function edit($id){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['dataDetail']	= $this->M_Petugas->getDataPetugas($id);
 		$data['v_content'] 	= 'member/petugas/edit';
		$this->load->view('member/layout', $data);
	}

	public function doUpdate($id){
		$post 		= $this->input->post();
		$UserID = $this->session->loginData['UserID'];
		
		if ($post['email'] == $post['emailhide']) {
			$check_dosenEmail   = 0;
			$check_petugasEmail = 0;
		}else{
			$check_dosenEmail   = $this->M_Petugas->check_email_dosen($post['email']);
			$check_petugasEmail = $this->M_Petugas->check_email_petugas($post['email']);
		}		
		
		if ($check_dosenEmail < 1 AND $check_petugasEmail < 1) {
			if ($post['password'] == $post['passwordhide']) {
				$password = $post['password'];
			}else{
				$password = md5($post['password']);
			}
			$config = array();
			$config['upload_path'] 		= './assets/avatars/petugas/';
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['file_name'] 		= $id;
			$config['overwrite']     	= TRUE;   	
			$ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
			$this->load->library('upload', $config);	
			$this->upload->do_upload('foto');
			
			$insertData = array(
			"namaPetugas"	=> $post['nama'],
			"username"		=> "",
			"password"		=> $password,
			"email"			=> $post['email'],
			"level"			=> $post['lvl']
			);
			
			if (!empty($_FILES['foto']['name'])) {
				$insertData["foto"] = $config['file_name'].".".$ext;
			}
			
			$query = $this->db->update('petugas',$insertData,array('idPetugas'=>$id));
			if($query){
				$this->m_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
				if($UserID == $id){
					redirect("admin/dashboard");
				}else{
					 redirect("admin/petugas/daftar");	
				}	
			}else{
				$this->m_umum->generatePesan("Gagal Menambahkan Data","gagal");
				if($UserID == $id){
					redirect("admin/dashboard");
				}else{
					 redirect("admin/petugas/daftar");	
				}
			}
		}else{
			$this->m_umum->generatePesan("Gagal Menambahkan Data, Email Telah Di gunakan","gagal");
			if($UserID == $id){
				redirect("admin/dashboard");
			}else{
				redirect("admin/petugas/daftar");	
			}
		}
	}

	public function doDelete($id){
		$delete = $this->db->delete("petugas",array("idPetugas"=>$id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil menghapus data","berhasil");
		}else{
			$this->m_umum->generatePesan("Gagal menghapus data","gagal"); 
		}
		redirect("admin/petugas/daftar");
	}
	
}