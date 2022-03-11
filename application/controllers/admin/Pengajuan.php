<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_pengajuan');
		$this->load->model('M_dosen');
		$this->load->model('M_restaurant');
		$this->load->model('m_umum');
	}
	
	public function add(){  
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['restoran']  = $this->M_restaurant->getDataRestaurant();
		$data['kriteria']  = $this->M_pengajuan->list_kriteria("N");
		$data['kriteria2'] = $this->M_pengajuan->list_kriteria("Y");
 		$data['v_content'] = 'member/pengajuan/Pengajuan';
		$this->load->view('member/layout', $data);
	}
	
	/* public function index(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_pengajuan->listPenilaian();
		var_dump($data['listData']);die;
 		$data['v_content'] 	= 'member/pengajuan/list';
		$this->load->view('member/layout', $data);	
	} */

	public function edit($id){  
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['fakultas']  = $this->M_pengajuan->list_fakultas();
		$data['progstudi'] = $this->M_pengajuan->list_progstudi();
		$data['dataDetail']= $this->M_pengajuan->detailKandidat($id);
		$data['kriteria']  = $this->M_pengajuan->list_kriteria("N");
		$data['kriteria2'] = $this->M_pengajuan->list_kriteria("Y");
 		$data['v_content'] = 'member/pengajuan/edit';
		$this->load->view('member/layout', $data);
	}

	public function daftar(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_pengajuan->list_pengajuan($this->session->loginData['UserID']);
 		$data['v_content'] 	= 'member/pengajuan/list';
		$this->load->view('member/layout', $data);	
	}
	  
	public function ajukan(){
		$post = $this->input->post();
		
		//print_r($post);die;
		$id_dosen = $this->session->loginData['UserID'];
		//$this->db->truncate('detilkandidat');
		$Check = $this->M_pengajuan->check_approval($id_dosen);
		//if ($Check < 1) {
			
			foreach (array_filter($post['nama_restorant']) as $key => $value) {
			
				$insertData = array(
					"idRestoran"	=> 	$value,
					"tglPegajuan"	=>	date("Y-m-d H:i:s")
				);
				
				$insert 	= $this->db->insert("kandidat",$insertData);
				$insertID 	= $this->db->insert_id();
				
				$sql = $this->db->query("select * from restorant where restorant_id = '".$value."' ")->result();
				foreach ($sql as $vSql){
					$insertSubData = array(
						"idKandidat"	=> $insertID,
						"idSubKriteria"	=> $vSql->C2,
						
						);
					$this->db->insert("detilkandidat",$insertSubData);
				}
				
				foreach ($sql as $vSql){
					$insertSubData = array(
						"idKandidat"	=> $insertID,
						"idSubKriteria"	=> $vSql->C3,
						
						);
					$this->db->insert("detilkandidat",$insertSubData);
				}
				
				foreach ($sql as $vSql){
					$insertSubData = array(
						"idKandidat"	=> $insertID,
						"idSubKriteria"	=> $vSql->C4,
						
						);
					$this->db->insert("detilkandidat",$insertSubData);
				}
				
				foreach ($sql as $vSql){
					$insertSubData = array(
						"idKandidat"	=> $insertID,
						"idSubKriteria"	=> $vSql->C6,
						
						);
					$this->db->insert("detilkandidat",$insertSubData);
				}
				foreach ($sql as $vSql){
					$insertSubData = array(
						"idKandidat"	=> $insertID,
						"idSubKriteria"	=> $vSql->C7,
						
						);
					$this->db->insert("detilkandidat",$insertSubData);
				}
				$insertHasilArray = array(
						"idKandidat"	=> $insertID,
						"nilaiWPM"		=> 0,
					);
				$insert_hasil = $this->db->insert("hasilanalisa",$insertHasilArray);
				
			}				
			
			if ($insert_hasil) {

				$petugas = $this->M_pengajuan->listPetugas();
				foreach ($petugas as $key => $value) {
					$email   = $value['email'];
					$message = $this->session->loginData['NamaUser']." telah mengajukan mutasi";
					$this->email($email,$message);
				}
				
				$this->m_umum->generatePesan("Berhasil","berhasil");
				redirect("admin/analisa/detil_analisa");
			}else{ 
				$this->m_umum->generatePesan("Gagal","gagal");
				redirect("admin/pengajuan/add");
			}
			/*
		}else{
			$this->m_umum->generatePesan("Anda Masih punya pengajuan yang masih di proses. Silahkan tunggu sampai pengajuan selesai di proses","gagal");
			redirect("admin/pengajuan/add");
		}
		*/
		
	}
	
	public function do_upload($par){	
		$post = $this->input->post();
		$this->load->library('upload');

		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for($i=0; $i<$cpt; $i++){  

			$_FILES['userfile']['name']		= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']		= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']	= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']	= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']		= $files['userfile']['size'][$i];    
			
			$ext          					= pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
			$newname      					= $i.$post['namaSubFile'][$i];
			$this->upload->initialize($this->set_upload_options($newname));
			$this->upload->do_upload();

			$insertSubData2 = array(
					"idKandidat"	=> $par,
					"idSubKriteria"	=> $post['idSubFile'][$i],
					"file"			=> $newname.".".$ext
					);
			if (!empty($_FILES['userfile']['name'])) {
				$this->db->insert("detilkandidat",$insertSubData2);
			}
		}
	}

	private function set_upload_options($newname){   
    	$Folder_name = $this->session->loginData['NIP'];
    	if(!is_dir("./assets/img/".$Folder_name)){
			mkdir("./assets/img/".$Folder_name,0777);
		}
		$config = array();
		$config['upload_path'] = './assets/img/'.$Folder_name;
		$config['allowed_types'] = '*';
		$config['file_name'] 	= $newname;
		$config['overwrite']     = TRUE;

		return $config;
	}

	public function doUpdate($id){
		$post = $this->input->post();
		$id_dosen = $this->session->loginData['UserID'];
		$Check = $this->M_pengajuan->check_approval($id_dosen);
		
			$insertData = array(
			"idDosen"		=> 	$this->session->loginData['UserID'],
			"fa_asal"		=>	$post['fa_asal'],
			"fa_tujuan"		=>	$post['fa_tujuan'],
			"psd_asal"		=>	$post['psd_asal'],
			"psd_tujuan"	=>	$post['psd_tujuan'],
			"tglPegajuan"	=>	date("Y-m-d H:i:s")
			);
			
			$insert 	= $this->db->update("kandidat",$insertData,array("idKandidat"=>$id));
			if ($insert) {
				$insertID 	= $id;
				
				foreach (array_filter($post['subKrit']) as $key => $value) {

					$insertSubData = array(
						"idSubKriteria"	=> $post['subKrit'][$key],
						"file"			=> $post['jenjang_progStudi'][$key]
						);
					$data = $this->db->update("detilkandidat",$insertSubData,array("idDetilKandidat"=>$post['idDetil'][$key]));

					
				}
				
					$this->db->delete("detilkandidat",array("idKandidat" => $id,"idSubKriteria"	=> 3));
				if($post['flag'] == '1'){
						$insertSubData = array(
						"idSubKriteria"	=> 3,
						"file"			=> '2Surat_persetujuan_mutasi_dari_pimpinan_Fakultas_.PNG',
						"idKandidat" => $id
						);
						$this->db->insert("detilkandidat",$insertSubData);
					}

				$hitung_WPM = $this->M_pengajuan->hitungWPM($id_dosen,$insertID);
				
				$this->do_upload2($insertID);			
				$hitung_SAW = $this->M_pengajuan->hitungSAW($id_dosen,$insertID);
				$insertHasilArray = array(
						"nilaiWPM"		=> $hitung_WPM['hasil'],
						"nilaiSAW"		=> $hitung_SAW['Hasil_MP'],	
					);
				$insert_hasil = $this->db->update("hasilanalisa",$insertHasilArray,array("idKandidat"=>$id));
				$this->m_umum->generatePesan("Berhasil","berhasil");
				redirect("admin/pengajuan/daftar");
			}else{ 
				$this->m_umum->generatePesan("Gagal","gagal");
				redirect("admin/pengajuan/daftar");
			}
	}

	public function doDelete($id){
		$delete = $this->db->delete("kandidat",array("idKandidat"=>$id));
		if ($delete) {
			$deletedetil = $this->db->delete("detilkandidat",array("idKandidat"=>$id));
			$deleteHasilAnalis = $this->db->delete("hasilanalisa",array("idKandidat"=>$id));
			$this->m_umum->generatePesan("Berhasil Delete","berhasil");
			redirect("admin/pengajuan/daftar");
		}else{ 
			$this->m_umum->generatePesan("Gagal Delete","gagal");
			redirect("admin/pengajuan/add");
		}
	}

	public function do_upload2($par){	
		$post = $this->input->post();
		$this->load->library('upload');

		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for($i=0; $i<$cpt; $i++){  

			$_FILES['userfile']['name']     = $files['userfile']['name'][$i];
			$_FILES['userfile']['type']     = $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']	= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']	= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']	    = $files['userfile']['size'][$i];    
			
			$ext          = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
			$newname      = $i.$post['namaSubFile'][$i];
			$this->upload->initialize($this->set_upload_options2($newname));
			$this->upload->do_upload();

			$insertSubData2 = array(
					"idKandidat"	=> $par,
					"idSubKriteria"	=> $post['idSubFile'][$i],
					"file"			=> $newname.".".$ext
					);
			if (!empty($_FILES['userfile']['name'])) {
					$this->db->update("detilkandidat",$insertSubData2,array("idDetilKandidat"=>$post['idDetilFile'][$i]));
				
			}
		}
	}

	private function set_upload_options2($newname){   
    	$Folder_name = $this->session->loginData['NIP'];
    	if(!is_dir("./assets/img/".$Folder_name)){
			mkdir("./assets/img/".$Folder_name,0777);
		}
		$config = array();
		$config['upload_path'] = './assets/img/'.$Folder_name;
		$config['allowed_types'] = '*';
		$config['file_name'] = $newname;
		$config['overwrite']     = TRUE;

		return $config;
	}


	function email($email,$pesan){
		$data = array(  'subject' => 'Pengajuan Mutasi',
						'receiver' => $email,
						'msg' => $pesan);
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
			 // echo $this->email->print_debugger();
			return false;
		}
    }


}