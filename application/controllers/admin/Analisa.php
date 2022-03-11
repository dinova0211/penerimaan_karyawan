<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Analisa extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_analisa');
		$this->load->model('M_kriteria');
		$this->load->model('M_umum');
	}
	
	public function detil_analisa(){  
		$data['userLogin'] = $this->session->userdata('loginData');
		
		$data['kriteria'] = $this->M_kriteria->get_kriteria();
		$data['label_kriteria'] = $this->M_kriteria->get_label_kriteria();
		$data['bobot_kriteria'] = $this->M_kriteria->get_bobot_kriteria();
		
		$data['data_karyawan'] = $this->M_kriteria->get_data_karyawan();
		$data['penilaian']   = $this->M_kriteria->get_penilaian();
 		
 		$data['v_content'] = 'member/analisa/detil_analisa';
		$this->load->view('member/layout', $data);
	}

	
}