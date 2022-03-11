<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Changepassword extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_changepassword');
		$this->load->model('m_umum');
	}

	function index(){
		$data['userLogin'] = $this->session->userdata('loginData');
 		$data['v_content'] = 'member/changepassword';
		$this->load->view('member/layout', $data);
	}

	function change(){
		$post = $this->input->post();
		
		$lvl = $this->session->loginData['lvl'];
		$id  = $this->session->loginData['UserID'];
		if ($lvl==99) {
			$check = $this->M_changepassword->checkpassdosen($id,md5($post['oldpass']));
			if ($check > 0) {
				$update = $this->db->update("dosen",array("password" => md5($post['newpass'])), array("id"=>$id));
				$this->m_umum->generatePesan("Berhasil Ubah Passowrd","berhasil");
				redirect("admin/changepassword/");
			}else{
				$this->m_umum->generatePesan("Gagal Ubah Passowrd","gagal");
				redirect("admin/changepassword/");
			}
		}else{
			$check = $this->M_changepassword->checkpasspetugas($id,md5($post['oldpass']));
			if ($check > 0) {
				$update = $this->db->update("petugas",array("password" => md5($post['newpass'])), array("idPetugas"=>$id));
				$this->m_umum->generatePesan("Berhasil Ubah Passowrd","berhasil");
				redirect("admin/changepassword/");
			}else{
				$this->m_umum->generatePesan("Gagal Ubah Passowrd","gagal");
				redirect("admin/changepassword/");
			}
		}
	}
}