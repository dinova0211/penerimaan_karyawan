<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Proses extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_proses');
		$this->load->model('M_pengajuan');
		$this->load->model('M_analisa');
		$this->load->model('m_umum');
	}

	public function daftar(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_proses->list_pengajuan();
 		$data['v_content'] 	= 'member/proses/proses';
		$this->load->view('member/layout', $data);	
	}
	
	public function mandat($id){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['dataDetail'] = $this->M_analisa->detailHasil($id);
 		$data['v_content'] 	= 'member/proses/mandat';
		$this->load->view('member/layout', $data);	
	}

	public function dApprove(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_proses->list_approval();
 		$data['v_content'] 	= 'member/proses/dApprove';
		$this->load->view('member/layout', $data);	
	}

	public function dReject(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_proses->list_rejection();
 		$data['v_content'] 	= 'member/proses/dReject';
		$this->load->view('member/layout', $data);	
	}

	public function detailData($id,$id2){
		$data['userLogin']      = $this->session->userdata('loginData');
		$data['detailKandidat'] = $this->M_proses->dataKandidat($id2);
		$data['kriteria']       = $this->M_proses->list_kriteria("N");
		$data['kriteria2']      = $this->M_proses->list_kriteria("Y");
		$data['allKriteria']	= $this->M_proses->list_AllKriteria();
		$data['dataAnalisa'] 	= $this->M_analisa->detailHasil($id);
 		$data['v_content'] 		= 'member/proses/detailData';
		$this->load->view('member/layout', $data);	
	}

	public function edit($id){  
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['fakultas']  = $this->M_pengajuan->list_fakultas();
		$data['progstudi'] = $this->M_pengajuan->list_progstudi();
		$data['dataDetail']= $this->M_pengajuan->detailKandidat($id);
		$data['kriteria']  = $this->M_pengajuan->list_kriteria("N");
		$data['kriteria2'] = $this->M_pengajuan->list_kriteria("Y");
 		$data['v_content'] = 'member/proses/edit';
		$this->load->view('member/layout', $data);
	}

	public function addMandat($id){
		$post = $this->input->post();
		$updateData = array("ket" => $post['ket']);
		$update = $this->db->update("hasilanalisa",$updateData, array("idHasilAnalisa" => $id));		
		if ($update) {
			$this->m_umum->generatePesan("Berhasil disimpan","berhasil");
			redirect("admin/proses/daftar");
		}else{
			$this->m_umum->generatePesan("Gagal Disimpan","gagal");
			redirect("admin/proses/daftar");
		}
	}
	
	public function approve($id){
		$post = $this->input->post();
		$idUser = $this->session->loginData['UserID'];
		$updateData = array(
			"isApprove"			=> 1,
			"approveBy"			=> $idUser,
			"tanggalApprove"	=> date("Y-m-d H:i:s"),
			"ket"				=> $post['ket']
			);
		$emailDosen  = $this->M_proses->getDeosenEmail($post['idDosen']);
		$this->email($emailDosen,"Selamat Pengajuan anda telah di Approve, silahkan login untuk lebih detail.");
		$update = $this->db->update("hasilanalisa",$updateData, array("idHasilAnalisa" => $id));
		
		if ($update) {
			if($_FILES['file']['name']!=""){
				$uploaddir = './assets/img/';
				$uploadfile = $uploaddir . basename($_FILES['file']['name']);
				move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
				$update = $this->db->update("hasilanalisa",array("suratMutasi" => $_FILES['file']['name']), array("idHasilAnalisa" => $id));
			}
			$this->m_umum->generatePesan("1 Record Telah Berhasil Di Approve","berhasil");
			redirect("admin/proses/daftar");
		}else{
			$this->m_umum->generatePesan("1 Record Gagal Di Approve","gagal");
			redirect("admin/proses/daftar");
		}
	}
	
	public function upload($id){
		$data['userLogin']      = $this->session->userdata('loginData');
		$data['detailKandidat'] = $this->M_proses->dataKandidat($this->uri->segment(5));
 		$data['v_content'] 		= 'member/proses/upload';
		$this->load->view('member/layout', $data);	
	}
	public function doUpload($id){
		$post = $this->input->post();
		$idUser = $this->session->loginData['UserID'];
		if($_FILES['file']['name']!=""){
			$uploaddir = './assets/img/';
			$uploadfile = $uploaddir . basename($_FILES['file']['name']);
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
			$update = $this->db->update("hasilanalisa",array("suratMutasi" => $_FILES['file']['name']), array("idHasilAnalisa" => $id));
		}
		if ($update) {
			$this->m_umum->generatePesan("1 Record Telah Berhasil Di Approve","berhasil");
			redirect("admin/proses/dapprove");
		}else{
			$this->m_umum->generatePesan("1 Record Gagal Di Approve","gagal");
			redirect("admin/proses/dapprove");
		}
	}

	public function reject($id){
		$post   = $this->input->post();
		$idUser = $this->session->loginData['UserID'];
		$updateData = array(
			"isApprove"			=> 2,
			"approveBy"			=> $idUser,
			"tanggalApprove"	=> date("Y-m-d H:i:s"),
			"ket"				=> $post['ket']
			);
		
		$emailDosen  = $this->M_proses->getDeosenEmail($post['idDosen']);
		$this->email($emailDosen,"Pengajuan anda telah di reject, silahkan login untuk lebih detail.");
		$update = $this->db->update("hasilanalisa",$updateData, array("idHasilAnalisa" => $id));
		if ($update) {
			$this->m_umum->generatePesan("1 Record Telah Berhasil Di Reject","berhasil");
			redirect("admin/proses/daftar");
		}else{
			$this->m_umum->generatePesan("1 Record Gagal Di Reject","gagal");
			redirect("admin/proses/daftar");
		}
	}


	public function doUpdate($id,$id2){
		$post     = $this->input->post();
		$id_dosen = $id2;
			$insertData = array(
			"idDosen"		=> 	$id_dosen,
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
					$upd = $this->db->update("detilkandidat",$insertSubData,array("idDetilKandidat"=>$post['idDetil'][$key]));
					if($upd){					
						$dataDetailKandidat = $this->M_pengajuan->detKandidat($id,$post['subKrit'][$key]);
						if(count($dataDetailKandidat) <= 0){
							$insertSubData["idKandidat"] = $id ;
							$this->db->insert("detilkandidat",$insertSubData);
						}
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
				}

				$hitung_WPM = $this->M_pengajuan->hitungWPM($id_dosen,$insertID);
				$this->do_upload2($insertID,$post['NIP']);
				
				$insertHasilArray = array(
						"nilaiWPM"		=> $hitung_WPM['hasil'],
					);
				$insert_hasil = $this->db->update("hasilanalisa",$insertHasilArray,array("idKandidat"=>$id));
				
				$this->m_umum->generatePesan("Berhasil","berhasil");
				redirect("admin/proses/daftar");
			}else{ 
				$this->m_umum->generatePesan("Gagal","gagal");
				redirect("admin/proses/daftar");
			}
	}

	public function doDelete($id){
		$delete = $this->db->delete("kandidat",array("idKandidat"=>$id));
		if ($delete) {
			$deletedetil = $this->db->delete("detilkandidat",array("idKandidat"=>$id));
			$deleteHasilAnalis = $this->db->delete("hasilanalisa",array("idKandidat"=>$id));
			$this->m_umum->generatePesan("Berhasil Delete","berhasil");
			redirect("admin/proses/daftar");
		}else{ 
			$this->m_umum->generatePesan("Gagal Delete","gagal");
			redirect("admin/proses/add");
		}

	}


	public function do_upload2($par,$par2){	
		$post = $this->input->post();
		$this->load->library('upload');

		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for($i=0; $i<$cpt; $i++){  

			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    
			
			$ext          = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
			$newname      = $i.$post['namaSubFile'][$i];
			$this->upload->initialize($this->set_upload_options2($newname,$par2));
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

	private function set_upload_options2($newname,$nip){   
    	$Folder_name = $nip;
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

	public function unapprej($id){
		$updateData = array("isApprove"=>0);
		$update = $this->db->update("hasilanalisa",$updateData,array("idHasilAnalisa"=>$id));
		if ($update) {
			$this->m_umum->generatePesan("Data berhasil di reset, Silahkan proses kembali data yang telah di reset!","berhasil");
			redirect("admin/proses/daftar");
		}else{ 
			$this->m_umum->generatePesan("Gagal Reset Data","gagal");
			redirect("admin/proses/daftar");
		}
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
			 echo $this->email->print_debugger();
			return false;
		}
    }

}