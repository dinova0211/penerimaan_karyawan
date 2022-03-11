<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datadosen extends MY_AdminController {
    function __construct() {
        parent::__construct();
        $this->load->model('m_dosen');
    }


    public function index(){
  		$data['user'] = (array) $this->user;
        $data['dosen_data'] = $this->m_dosen->getDataDosen($this->user->id);
        $data['lists']['fakultas'] = $this->m_dosen->getFakultas();
        $data['lists']['program_studi'] = $this->m_dosen->getProgramStudi();
  		$data['v_content'] = 'member/datadosen';
  		$this->load->view('member/layout',$data);
  	}

    public function datadosen() {
      $data['user'] = (array) $this->user;
      $data['v_content'] = 'member/dashboard/content';
  		$this->load->view('member/layout',$data);
    }


}
