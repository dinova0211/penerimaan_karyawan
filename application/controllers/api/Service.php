<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Service extends CI_Controller {
	private $signature; 
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'url',
				'form',
				'language' 
		) );
		$this->load->model ( 'M_umum' );
		$this->load->model ( 'M_api' );
		$this->load->model ( 'M_kriteria' );
		
	} 
	
	function index() {
		header ( "location: " . base_url () );
		die ();
	}
	
	function loginUser() {
		$dataArray = array (
				'pic' => '' 
		);
		$email = $this->input->post ( 'email' );
		$password = $this->input->post ( 'password' );
		if ($email && $password) {
			$checkLogin = false;
			$param = array ();
			if (! $this->input->post ( 'password' )) {
				$this->M_api->sendOutput ( $dataArray, 402 );  
			} else {
				$param ['password'] = $password; 
			}
			
			$param ['email'] = $email;
			$checkLogin = $this->M_api->loginUser( $username, $param );
			if ($checkLogin) {
				$dataArray ['results'] = array (
						'success' => 'OK',
						'Username' => ($checkLogin ['Username'] == null || $checkLogin ['Username'] == "") ? "not_set" : $checkLogin ['Username'],
						'UserID' => $checkLogin ['UserID'],
						'FullData' => $checkLogin['all_data']
				); 
				$this->M_api->sendOutput ( $dataArray, 200 );
			} else {
				$dataArray ['results'] = array (
						'success' => 'fail' 
				);
				$this->M_api->sendOutput ( $dataArray, 200 );
			}
		} else {
			$this->M_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function listKriteria(){
		$dataArray = array ( 
				'pic' => '' 
		);
	
		$param = array(
				'data' => 'xxx'
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$kriteria = $this->M_kriteria->list_kriteria();
			var_dump($kriteria);die;
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
	
	function prosesAnalisa(){
		$dataArray = array ( 
				'pic' => '' 
		);
	
		$param = array(
				'data' => 'xxx'
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$kriteria = $this->M_kriteria->list_kriteria();
			if($data){
				$dataArray ['results']['status_request'] 	= "OK";
				$dataArray ['results']['msg'] 				= "Berhasil";
				$dataArray ['results']['list_kategori'] 	= (array) $data;
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
?>