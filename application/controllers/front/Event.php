<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	function __construct() {
        parent::__construct();
        //$this->load->model('m_login');
		$this->load->model('m_kota');
		$this->load->model('m_foto_wisata');
		$this->load->model('m_lokasi_wisata');
		$this->load->model('m_global');
		$this->load->model('m_event');
		
		$this->load->library('pagination');
    }
	
	public function index(){
		
		if($_GET['event']){
			$data['listData'] = $this->db->query("select * from new_event where nama_event like '%".$_GET['event']."%'")->result_array();
		}else{
			$data['listData'] = $this->db->query("select * from new_event")->result_array();
		}
		$data['v_content']	="front/event/event_page";
        $this->load->view('front/layout',$data);
	}
	
}
