<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Services extends CI_Controller {
	private $signature; 
	function __construct() {
		parent::__construct ();
		
		$uri = $this->uri->segment(1);
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper ( array (
				'url',
				'form',
				'language' 
		) );
		$this->load->model ( array (
									'm_api',
									'm_login',
									'M_kriteria',
									'M_analisa'
									) 
							);
	}
	
	function index() {
		header ( "location: " . base_url () );
		die ();
	}
		
	function nilaiPreferensi(){
		$dataArray = array ( 
				'pic' => 'Abdul Wakhid' 
		);
	
		$param = array(
				'data' => 'xxx'
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$kriteria = $this->M_kriteria->list_kriteria();
			$kandidat = $this->M_analisa->list_kandidat();
			$idKandidat = "";
			//$data=[];
			foreach ($this->M_analisa->list_kandidat() as $value) {
				$idKandidat = $value['idKandidat'];
              
				
/* 				$each_data = array(
					//'nama_restoran' => $value['nama'],
					'nilai_prefensi' => array()
				); */
				

				foreach ($this->M_kriteria->list_kriteria() as $row) {
					//$total = $this->M_analisa->total_kriteria($row['idKriteria']);
					$sql = "select round(exp(sum(log(pow(SK.bobot,SK.bobot/total_sk)))),4) subtotal,(K.bobot/total_k) total_k
					from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat
													 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria
													 inner join kriteria K on SK.idKriteria = K.idKriteria
													 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
													 join (select sum(bobot) total_sk from subkriteria where idKriteria = '".$row['idKriteria']."') tsk
													 join (select sum(bobot) total_k from kriteria) tk
					where TK.idKandidat = '".$value['idKandidat']."' and K.idKriteria = '".$row['idKriteria']."' and  HA.isApprove = '0'";
					$query = $this->db->query($sql)->result_array();
					//echo $this->db->last_query();die;
					if($query[0]['subtotal'] == NULL){
						$subtot = 0;
					}else{
						$subtot = $query[0]['subtotal'] ;
					}
					$each_kriteria=array (
							'nama_restoran' => $value['nama'],
							'nama_kriteria' => $row['namaKriteria'],
							
							'nilai' => $subtot
						);
					
					$foo['nilai_prefensi'][] = $each_kriteria;
				}
				
				
				
				$foo['nilai_prefensi']; //ini bisa dikasih sama dengan lagi?
				array_push($data,$foo['nilai_prefensi']);
			}
			if($foo['nilai_prefensi']){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['data'] = (array) $foo['nilai_prefensi'];
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Tidak Ada Data";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function matriksPreferensi(){
		$dataArray = array ( 
				'pic' => 'Abdul Wakhid' 
		);
	
		$param = array(
				'data' => 'xxx'
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$kriteria = $this->M_kriteria->list_kriteria();
			$kandidat = $this->M_analisa->list_kandidat();
			$idKandidat = "";
			foreach ($this->M_analisa->list_kandidat() as $value) {
				$idKandidat = $value['idKandidat'];
				foreach ($this->M_kriteria->list_kriteria() as $row) {
					$total = $this->M_analisa->total_kriteria($row['idKriteria']);
					$sql = "select round(exp(sum(log(pow(SK.bobot,SK.bobot/total_sk)))),4) subtotal,(K.bobot/total_k) total_k
							from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat
							inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria
							inner join kriteria K on SK.idKriteria = K.idKriteria
							inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
							join (select sum(bobot) total_sk from subkriteria where idKriteria = '".$row['idKriteria']."') tsk
							join (select sum(bobot) total_k from kriteria) tk
							where TK.idKandidat = '".$value['idKandidat']."' and K.idKriteria = '".$row['idKriteria']."' and  HA.isApprove = '0'";
					$query = $this->db->query($sql)->result_array();
					$prefensi = round(pow($query[0]['subtotal'],$query[0]['total_k']),4);
                    $total_prefensi += $prefensi;
					$each_kriteria=array (
							'nama_restoran' => $value['nama'],
							'nama_kriteria' => $row['namaKriteria'],
							'nilai' => $prefensi
						);
					$foo['matriks_prefensi'][] = $each_kriteria;
				}
				
				$foo['matriks_prefensi'];
				array_push($data,$foo['nilai_prefensi']);
			}
			if($foo['matriks_prefensi']){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['data'] 				= (array) $foo['matriks_prefensi'];
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Tidak Ada Data";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function nilaiPreferensiTotalWPM(){
		$dataArray = array ( 
				'pic' => 'Abdul Wakhid' 
		);
	
		$param = array(
				'data' => 'xxx'
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_analisa->hasil_wpm();
			
			if($data){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['nilai_preferensi_total_WPM'] 	= (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Tidak Ada Data";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function hasil_analisa_WPM(){
		$dataArray = array ( 
				'pic' => 'Abdul Wakhid' 
		);
	
		$param = array(
				'data' => 'xxx'
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_analisa->hasil();
			//echo $this->db->last_query();die;
			foreach ($this->M_analisa->hasil() as $value) {
				$idKandidat = $value['idKandidat'];
				$total_prefensi = 0 ;
				$cek = $this->M_analisa->hasil_keterangan($value['idKandidat']);
				
			}
			
			if($data){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['nilai_preferensi_total_WPM'] 	= (array) $data;
				$dataArray ['results']['hasil_prefensi'] 	= (array) $cek;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Tidak Ada Data";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function cari(){
		$dataArray = array ( 
				'pic' => 'Abdul Wakhid' 
		);
	
		$param = array(
				'cari' => $this->input->post('cari'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_analisa->hasil_cari($param['cari']);
			if($data){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['nilai_preferensi_total_WPM'] 	= (array) $data;
				//$dataArray ['results']['hasil_prefensi'] 	= (array) $cek;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Tidak Ada Data";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function cariByPenilaian(){
		$dataArray = array ( 
				'pic' => 'Abdul Wakhid' 
		);
	
		$param = array(
				'idSubKriteria' => $this->input->post('idSubKriteria'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_analisa->hasil_cari_by_kriteria($param['idSubKriteria']);
			
			if($data){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['nilai_preferensi_total_WPM'] 	= (array) $data;
				//$dataArray ['results']['hasil_prefensi'] 	= (array) $cek;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Tidak Ada Data";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	////-----------------------REGISTER PENGGUNA------------------------------/////////////
	function register(){
		$dataArray = array ( 
				'pic' => 'abdul' 
		);
		$param = array(
				'namaPengguna' 	 =>  $this->input->post('namaPengguna'),
				'alamatPengguna' =>  $this->input->post('alamatPengguna'),
				'noHP' 			 =>  $this->input->post('noHP'),
				'username' 		 =>  $this->input->post('username'),
				'password' 		 =>  $this->input->post('password'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$cek_username = $this->m_login->checkusername($param['username']);
			if($cek_username == 0){
				$dataPengguna = array(
					'namaPengguna' => $param['namaPengguna'],
					'alamatPengguna' => $param['alamatPengguna'],
					'noHP' => $param['noHP'],
					'username' => $param['username'],
					'password' => md5($param['password']),
				);
				$insert = $this->db->insert('pengguna',$dataPengguna);
				
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Register berhasil";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );  
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Register gagal, username sudah terpakai";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
			if($insert){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Register berhasil";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Register gagal";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	////-----------------------LOGIN------------------------------/////////////
		
	function login(){
		$dataArray = array ( 
				'pic' => 'Abdul' 
		);
	
		$param = array(
				'username' =>  $this->input->post('username'),
				'password' =>  $this->input->post('password'),
				
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->m_login->checkLoginApps($param['username'], $param['password']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Login berhasil";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Username atau password salah";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	////-----------------------SARAN PENGGUNA------------------------------/////////////
	function saran(){
		$dataArray = array ( 
				'pic' => 'Abdul' 
		);
		$param = array(
				'idPengguna' 	 =>  $this->input->post('idPengguna'),
				'saran' 		 =>  $this->input->post('saran'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
				$dataPengguna = array(
					'idPengguna' 	=> $param['idPengguna'],
					'saran' 		=> $param['saran'],
					'created_at' 	=> date("Y-m-d h:i:s"),
				);
				$insert = $this->db->insert('saran',$dataPengguna);
				
			
			if($insert){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Berhasil";
				$dataArray ['results']['data'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Gagal";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function listKriteria(){
		$dataArray = array ( 
				'pic' => 'Abdul Wakhid' 
		);
	
		$param = array(
				'data' => 'xxx'
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_kriteria->list_kriteria();
			
			if($data){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['kriteria'] 	= (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Tidak Ada Data";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function listSubKriteria(){
		$dataArray = array ( 
				'pic' => 'Abdul Wakhid' 
		);
	
		$param = array(
				'idKriteria' => $this->input->post('idKriteria'),
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_kriteria->listKriteriaSubById($param['idKriteria']);
			
			if($data){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['kriteria'] 	= (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Tidak Ada Data";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	
}