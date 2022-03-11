<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('M_global');
    }
	
	public function index(){
		$data['data_kota'] = $this->M_global->get_kota();
		$data['v_content']	="front/location/page";
        $this->load->view('front/layout',$data);
	}
	
	public function location($id_kota){
		
		$data['listData'] = $this->db->query("select * from lokasi_wisata join kota on kota.id_kota = lokasi_wisata.id_kota where lokasi_wisata.id_kota = '".$id_kota."'")->result_array();
		$data['v_content']	="front/location/location_wisata";
        $this->load->view('front/layout',$data);
	}
	
}
