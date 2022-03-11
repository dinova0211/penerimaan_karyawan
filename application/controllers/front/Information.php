<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller {

	function __construct() {
        parent::__construct();
        //$this->load->model('m_login');
		$this->load->model('m_umum');
		$this->load->model('M_informasi');
    }
	
	public function index(){	
		$data['kategori']			= $this->M_informasi->getAllKategori();
		$data['v_content']			= "front/information/page";
        $this->load->view('front/layout',$data);
	}
}
