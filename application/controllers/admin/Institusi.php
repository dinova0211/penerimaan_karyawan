<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Institusi extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_institusi');
		$this->load->model('m_umum');
	}
	
	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
 		$data['v_content'] = 'member/institusi/Add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData']  = $this->M_institusi->list_institusi();
 		$data['v_content'] = 'member/institusi/List';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data = $this->M_institusi->check_faByID($id);
		
		if(count($data)==0){
			$this->m_umum->generatePesan("Fakultas Tidak Ditemukan","gagal");
			redirect("admin/institusi/daftar");
		}else{
			$data['userLogin']  = $this->session->userdata('loginData');
			$data['dataDetail'] = $data;
			$data['v_content']  = 'member/institusi/edit';
			$this->load->view('member/layout', $data);
		}
	}
	
	public function doAdd(){
		$post 		= $this->input->post();
		$insertData = array(
			"fa_name"	=> $post['nama_fa'], 
			"fa_status"	=> "1"
		);
		
		$query = $this->db->insert('institusi',$insertData);
		if($query){
			$this->m_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
			redirect("admin/institusi/daftar");
		}else{
			$this->m_umum->generatePesan("Gagal Menambahkan Data","gagal");
		}
	}
	
	public function doEdit($id){
		$post 		= $this->input->post();
		$insertData = array(
			"fa_name"	=> $post['nama_fa'], 
			"fa_status"	=> "1"
		);
		$where = array(
			"fa_id"	=> $id
		);
		$query = $this->db->update('institusi',$insertData, $where);
		if($query){
			$this->m_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
			redirect("admin/institusi/daftar");
		}else{
			$this->m_umum->generatePesan("Gagal Menambahkan Data","gagal");
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("institusi",array("fa_ID"=>$id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil menghapus data","berhasil");
		}else{
			$this->m_umum->generatePesan("Gagal menghapus data","gagal"); 
		}
		redirect("admin/institusi/daftar");
	}
}