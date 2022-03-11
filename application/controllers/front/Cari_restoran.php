<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cari_restoran extends CI_Controller {

	function __construct() {
        parent::__construct();
        //$this->load->model('m_login');
		$this->load->model('m_umum');
		$this->load->model('M_restaurant');
    }
	
	public function index(){	
		
		if($_GET['restoran']){
			$data['list_restoran'] = $this->M_restaurant->getRestaurantSearch($_GET['restoran']);
			
		}
		$data['v_content']	="front/cari_wisata/form";
        $this->load->view('front/layout',$data);
	}
	
	public function wisata_detail($id_lokasi_wisata){
		$data['detailData'] = $this->db->query("select * from lokasi_wisata where id_lokasi_wisata = '".$id_lokasi_wisata."'")->row();
		$data['getFoto'] = $this->db->query("select * from foto_lokasi_wisata where id_lokasi_wisata = '".$id_lokasi_wisata."' limit 1")->row_array();
		$data['fasilitas'] = $this->m_lokasi_wisata->detil_fas($id_lokasi_wisata);
		
		$data['v_content']	="front/lokasi_wisata/detail";
        $this->load->view('front/layout',$data);
	}

	
}
