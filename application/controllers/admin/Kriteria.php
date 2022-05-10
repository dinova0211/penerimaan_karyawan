<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_kriteria');
		$this->load->model('M_umum');
	}

	public function daftar(){
		$data['userLogin']	= $this->session->userdata('loginData');
		$data['kriteria']	= $this->M_kriteria->list_kriteria();
 		$data['v_content']	= 'member/kriteria/list';
		$this->load->view('member/layout', $data);
	}

	public function daftarsub(){
		$data['userLogin']	= $this->session->userdata('loginData');
		$data['kriteria']	= $this->M_kriteria->list_sub();
 		$data['v_content']	= 'member/kriteria/listSub';
		$this->load->view('member/layout', $data);
	}

	public function edit($id){
		$data['userLogin']	= $this->session->userdata('loginData');
		$data['dataDetail']	= $this->M_kriteria->list_kriteria_byID($id);
 		$data['v_content']	= 'member/kriteria/edit';
		$this->load->view('member/layout', $data);
	}

	public function editsub($id){
		$data['userLogin']	= $this->session->userdata('loginData');
		$data['kriteria']	= $this->M_kriteria->list_kriteria();
		$data['dataDetail']	= $this->M_kriteria->list_sub_byID($id);
 		$data['v_content']	= 'member/kriteria/editSub';
		$this->load->view('member/layout', $data);
	}

	public function add(){
		$data['userLogin']	= $this->session->userdata('loginData');
 		$data['v_content']	= 'member/kriteria/add';
		$this->load->view('member/layout', $data);
	}

	public function addSUb(){
		$data['userLogin']	= $this->session->userdata('loginData');
		$data['kriteria']	= $this->M_kriteria->list_kriteria();
 		$data['v_content']	= 'member/kriteria/addsub';
		$this->load->view('member/layout', $data);
	}

	public function doAdd(){
		$post = $this->input->post();
		$updateData = array(
			"idKriteria"	=> str_replace(' ', '', strtoupper($post['id_kriteria'])),
			"namaKriteria" 	=> $post['nama_kriteria'],
			"bobot"			=> $post['bobot'],
			"tingkat"		=> $post['tingkat'],
			"row"			=> $updateData
			//"is_upload"		=> $post['is_upload'],
			//"is_jenjang"	=> $post['is_jenjang']
			);
		$insert = $this->db->insert("kriteria",$updateData);
		if($insert){
			$this->M_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
			redirect("admin/kriteria/daftar");
		}else{
			$this->M_umum->generatePesan("Gagal Menambahkan Data","gagal");
			redirect("admin/kriteria/daftar");
		}
	}
	
	public function doAddSub(){
		$post = $this->input->post();
// 		print_r($post);
// 		die();
		$insertData = array(
			"namaSubKriteria"	=> $post['namaSub'],
			"idKriteria"		=> str_replace(' ', '', strtoupper($post['kriteria'])),
			"bobot"				=> $post['bobot'],
			"required"			=> "required",
			"id"				=> "C1"
			);
		$insert = $this->db->insert("subkriteria", $insertData);
		if ($insert) {
		$this->M_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
			redirect("admin/kriteria/daftarsub");
		}else{
			$this->M_umum->generatePesan("Gagal Menambahkan Data","gagal");
			redirect("admin/kriteria/daftarsub");
		}
	}

	public function doUpdate($id){
		$post = $this->input->post();
		$updateData = array(
			"namaKriteria" 	=> $post['nama_kriteria'],
			"bobot"			=> $post['bobot'],
			"type"			=> $post['type'],
			//"is_upload"		=> $post['is_upload'],
			//"is_jenjang"	=> $post['is_jenjang']
			);
		$udate = $this->db->update("kriteria",$updateData,array("idKriteria" => $id));
		if($udate){
			$this->M_umum->generatePesan("Berhasil Mengupdate Data","berhasil");
			redirect("admin/kriteria/daftar");
		}else{
			$this->M_umum->generatePesan("Gagal Mengupdate Data","gagal");
			redirect("admin/kriteria/daftar");
		}
	}

	public function doUpdateSub($id){
		$post = $this->input->post();
		
		$updateData = array(
			"namaSubKriteria"	=> $post['namaSub'],
			"idKriteria"		=> $post['kriteria'],
			"bobot"				=> $post['bobot']
			);
		$update = $this->db->update("subkriteria",$updateData,array("idSubKriteria"=>$id));
		if($update){
			$this->M_umum->generatePesan("Berhasil Mengupdate Data","berhasil");
			redirect("admin/kriteria/daftarsub");
		}else{
			$this->M_umum->generatePesan("Gagal Mengupdate Data","gagal");
			redirect("admin/kriteria/daftarsub");
		}
	}

	public function doDelete($id){
        $hapus = $this->db->delete('kriteria',array('idKriteria' => $id));
		//echo $this->db->last_query();die;
		if($hapus){
			$this->M_umum->generatePesan("Berhasil Menghapus Data","berhasil");
			redirect("admin/kriteria/daftar");
		}else{
			$this->M_umum->generatePesan("Gagal Menghapus Data","gagal");
			redirect("admin/kriteria/daftar");
		}
	}

	public function doDeletesub($id){
        $hapus = $this->db->delete('subkriteria',array('idSubKriteria' => $id));
		if($hapus){
			$this->M_umum->generatePesan("Berhasil Menghapus Data","berhasil");
			redirect("admin/kriteria/daftarsub");
		}else{
			$this->M_umum->generatePesan("Gagal Menghapus Data","gagal");
			redirect("admin/kriteria/daftarsub");
		}
	}


}