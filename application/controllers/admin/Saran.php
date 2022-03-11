<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Saran extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_saran');
		$this->load->model('M_umum');
	}


	public function index(){
		$data['userLogin'] 	= $this->session->userdata('loginData');
		$data['listData']	= $this->M_saran->getAll();
 		$data['v_content'] 	= 'member/saran/list';
		$this->load->view('member/layout', $data);	
	}


	
}