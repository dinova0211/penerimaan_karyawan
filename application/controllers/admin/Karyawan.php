<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_karyawan');
		$this->load->model('M_umum');
	}

	public function add(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['kode'] 		= $this->M_karyawan->code_otomatis();
 		$data['v_content'] = 'member/karyawan/add';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['dataDetail']= $this->M_karyawan->getRestaurantbyID($id);
 		$data['v_content'] = 'member/karyawan/edit';
		$this->load->view('member/layout', $data);
	}

	public function daftar(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_karyawan->getDataRestaurant();
 		$data['v_content'] 	= 'member/karyawan/list';
		$this->load->view('member/layout', $data);	
	}


	public function doAdd(){
		$post = $this->input->post();
// 		if($_FILES['foto']['name']!=""){
// 			$uploaddir = 'uploads/';
// 			$uploadfile = $uploaddir . basename($_FILES['foto']['name']);
// 			move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
// 		}
		$insertData = array(
			"namaPengguna"         => $post['nama'],
			"username"        => $post['username'],
			/*"password"     => md5($post['password']),*/
			"noHp"         => $post['noHp'],
			"alamatPengguna"       => $post['alamat'],
			//"jeniskelamin" => $post['jk'],
// 			"is_active"    => $post['isActive'],
// 			"foto"		   => $_FILES['foto']['name'],
		);
		$insert = $this->db->insert("pengguna", $insertData);
		//echo $this->db->last_query();die;
		if ($insert) {
			$this->M_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
			redirect("admin/karyawan/daftar");	
		}else{
			$this->M_umum->generatePesan("Gagal Menambahkan Data","gagal");
			redirect("admin/karyawan/daftar");	
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
        /*$password = md5($post['password']);
        $old_password = $post['old_password'];
        
        if ($post['password']=="")
        {
            $set_password =  $old_password;
            
        }
        else
        {
            $set_password = md5($post['password']);
        }*/
	
		$updateData = array(
			"namaPengguna"         => $post['nama'],
			"username"        => $post['username'],
			/*"password"     => $set_password,*/
			"noHp"         => $post['noHP'],
			"alamatPengguna"       => $post['alamat'],
		);
		
		
		$update = $this->db->update("pengguna",$updateData,array("idPengguna"=>$id));
    	//$UserID = $this->session->loginData['UserID'];
		if ($update) {
			$this->M_umum->generatePesan("Update Berhasil ","berhasil");
		
				redirect("admin/karyawan/daftar");	
					
		}else{
			$this->M_umum->generatePesan("Update Gagal","gagal");
			if($UserID == $id){
				redirect("admin/dashboard");
			}else{
				redirect("admin/karyawan/daftar");	
			}
		}	
	}
	
	public function doDelete($id){
        $hapus = $this->db->delete('pengguna',array('idPengguna' => $id));
		if($hapus){
			$this->M_umum->generatePesan("Berhasil Menghapus Data","berhasil");
			redirect("admin/karyawan/daftar");	
		}else{
			$this->M_umum->generatePesan("Gagal Menghapus Data","gagal");
			redirect("admin/karyawan/daftar");	
		}
	}
	
	public function pnDelete()
	{
	    $id = $this->uri->segment(4);
	    $id_karyawan = $this->uri->segment(5);

	    $hapus = $this->db->delete('penilaian',array('idpenilaian' => $id));
		if($hapus){
			$this->M_umum->generatePesan("Berhasil Menghapus Data","berhasil");
			redirect("admin/karyawan/penilaian/".$id_karyawan);	
		}else{
			$this->M_umum->generatePesan("Gagal Menghapus Data","gagal");
			redirect("admin/karyawan/penilaian/".$id_karyawan);	
		}
	}

	public function active($id){
		$updateData = array("is_active"	=> 1);
		$update = $this->db->update("restorant",$updateData, array("restorant_id"=>$id));
		if ($update) {
			$this->M_umum->generatePesan("Aktivasi Dosen Berhasil ","berhasil");
			redirect("admin/karyawan/daftar");	
		}else{
			$this->M_umum->generatePesan("Aktivasi Dosen Gagal","gagal");
			redirect("admin/karyawan/daftar");	
		}
	}

	public function inactive($id){
		$updateData = array("is_active"	=> 0);
		$update = $this->db->update("restorant",$updateData, array("restorant_id"=>$id));
		if ($update) {
			$this->M_umum->generatePesan("Dosen berhasil di non-aktive kan","berhasil");
			redirect("admin/karyawan/daftar");	
		}else{
			$this->M_umum->generatePesan("Dosen gagal di non-aktive kan","gagal");
			redirect("admin/karyawan/daftar");	
		}
	}
	
	public function penilaian($id)
	{
	    $data['userLogin'] = $this->session->userdata('loginData');
		$data['dataDetail']= $this->M_karyawan->getRestaurantbyID($id);
		$data['data_penilaian'] = $this->M_karyawan->getDatapenilaian($id);
 		$data['v_content'] = 'member/karyawan/penilaian';
		$this->load->view('member/layout', $data);
	}
	
	public function select_sub_kriteria()
	{
	    $cb_kriteria1 = $this->input->post('cb_kriteria1');
	    $data = $this->M_karyawan->select_sub_kriteria($cb_kriteria1);
	    echo $data;
	}
	
	public function edit_penilaian()
	{
	    $id_penilaian = $this->uri->segment(4);
	    $id = $this->uri->segment(5);
	    
	    $data['userLogin'] = $this->session->userdata('loginData');
		$data['dataDetail']= $this->M_karyawan->getRestaurantbyID($id);
		$data['data_penilaian'] = $this->M_karyawan->getDatapenilaian($id);
		
		$data['detailkriteria'] = $this->M_karyawan->get_edit_penilaian($id_penilaian);
		
 		$data['v_content'] = 'member/karyawan/edit_penilaian';
		$this->load->view('member/layout', $data);
	}
	
	public function pnl_edit()
	{
	    $post = $this->input->post();

	    $id_penilaian = $post['id_penilaian'];
	    $id_karyawan = $post['id_karyawan'];
	    
	    $cek_penilaian = $this->M_karyawan->check_data_new($post['id_penilaian'],$post['id_karyawan'],$post['kriteria1'],$post['kriteria2']);
        
        
	    $idpetugas = '1';
	    
		
		$insertData = array(
		    "idpetugas" => $idpetugas,
			"idpengguna"          => $post['id_karyawan'],
			"idkriteria"         => $post['kriteria1'],
			"idsubkriteria"        => $post['kriteria2'],
			"nilai"         => $post['nilai'],
		);
		


		
		//echo $this->db->last_query();die;
		if ($cek_penilaian=="1") 
		{
		    $this->M_umum->generatePesan("Kriteria Penilaian sudah dipilih","gagal");
    		redirect("admin/karyawan/penilaian/".$id_karyawan.'/'.$id_penilaian);	
		}
		else
		{
		    $insert = $this->db->update("penilaian", $insertData,array("idpenilaian"=>$id_penilaian));
    		if ($insert) {
    			$this->M_umum->generatePesan("Berhasil Memperbarui Data","berhasil");
    			redirect("admin/karyawan/penilaian/".$id_karyawan.'/'.$id_penilaian);	
    		}else{
    			$this->M_umum->generatePesan("Gagal Memperbarui Data","gagal");
    			redirect("admin/karyawan/penilaian/".$id_karyawan.'/'.$id_penilaian);	
    		}
		}
	}
	
	public function pnlupdate()
	{
	    $this->load->helper('string');
	    $idpenilaian = random_string('alnum',10);
	    $post = $this->input->post();
	    
	    $cek_penilaian = $this->M_karyawan->check_data($post['id_karyawan'],$post['kriteria1'],$post['kriteria2']);
        
        
	    $idpetugas = '1';
	    $id_karyawan = $post['id_karyawan'];
		
		$insertData = array(
		    "idpenilaian" => $idpenilaian,
		    "idpetugas" => $idpetugas,
			"idpengguna"          => $post['id_karyawan'],
			"idkriteria"         => $post['kriteria1'],
			"idsubkriteria"        => $post['kriteria2'],
			"nilai"         => $post['nilai'],
		);
		


		
		//echo $this->db->last_query();die;
		if ($cek_penilaian=="1") 
		{
		    $this->M_umum->generatePesan("Kriteria Penilaian sudah dipilih","gagal");
    		redirect("admin/karyawan/penilaian/".$id_karyawan);	
		}
		else
		{
		    $insert = $this->db->insert("penilaian", $insertData);
    		if ($insert) {
    			$this->M_umum->generatePesan("Berhasil Menambahkan Data","berhasil");
    			redirect("admin/karyawan/penilaian/".$id_karyawan);	
    		}else{
    			$this->M_umum->generatePesan("Gagal Menambahkan Data","gagal");
    			redirect("admin/karyawan/penilaian/".$id_karyawan);	
    		}
		}
		
		
	}
}