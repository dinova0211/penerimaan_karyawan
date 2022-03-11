<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProgramStudy extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_programStudy');
		$this->load->model('m_umum');
	}
	
	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['fakultas']  = $this->M_programStudy->lsit_fakultas();
 		$data['v_content'] = 'member/programStudy/add';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post 		= $this->input->post();
		$insertData = array(
			"fa_ID"		=> $post['fakultas'],
			"psd_name"	=> $post['nama_psd'],
			"psd_status"=> "1"
		);
		$query = $this->db->insert("program_study",$insertData);
		if($query){
			$this->m_umum->generatePesan("Berhasil Input Data","berhasil");
			redirect("admin/programStudy/daftar");
		}else{ 
			$this->m_umum->generatePesan("Gagal Input Data","gagal");
			redirect("admin/programStudy/add");
		}
	}
	
	public function daftar(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_programStudy->list_progStudy();
 		$data['v_content'] 	= 'member/programStudy/list';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data = $this->M_programStudy->check_prog_byID($id);
		if(count($data)==0){
			$this->m_umum->generatePesan("Data Tidak Ditemukan","gagal");
		}else{
			$data['userLogin'] = $this->session->userdata('loginData');
			$data['fakultas']  = $this->M_programStudy->lsit_fakultas();
			$data['detailData']= $data;
			$data['v_content'] = 'member/programStudy/edit';
			$this->load->view('member/layout', $data);
		}
	}
	
	public function doUpdate($id){
		$post 		= $this->input->post();
		$insertData = array(
			"fa_ID"		=> $post['fakultas'],
			"psd_name"	=> $post['nama_psd'],
			"psd_status"=> "1"
		);
		$where = array("psd_ID"=>$id);
		$query = $this->db->update("program_study",$insertData,$where);
		if($query){
			$this->m_umum->generatePesan("Berhasil Update Data","berhasil");
			redirect("admin/programStudy/daftar");
		}else{ 
			$this->m_umum->generatePesan("Gagal Update Data","gagal");
			redirect("admin/programStudy/add");
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("program_study",array("psd_ID"=>$id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil menghapus data","berhasil");
		}else{
			$this->m_umum->generatePesan("Gagal menghapus data","gagal"); 
		}
		redirect("admin/programStudy/daftar");
	}
}