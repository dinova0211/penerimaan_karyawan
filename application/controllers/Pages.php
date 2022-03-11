<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	function __construct() {
        parent::__construct(); 
		
		$this->load->model('m_landing_page');
    } 
	
	public function index(){
		
// 		$data['restaurant'] = $this->m_restaurant->getDataRestaurant();
		$data['v_content']	="front/pages";
        $this->load->view('front/layout',$data);
	}

}
