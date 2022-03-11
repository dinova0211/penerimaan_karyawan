<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();

				$this->load->library('form_validation');
    }

	public function index()
	{
		$data['msg'] = $this->session->flashdata('msg');
    $this->load->view('member/Login', $data);
	}

	public function doLogin() {
        $dataPost = $this->input->post();
				$login = $this->m_check_login->login($dataPost['email'], $dataPost['pass']);
        if (!empty($login)) {
					$this->session->set_userdata('user', $login);
          redirect('admin/dashboard');
        } else {
					$msg['status'] = 'error';
					$msg['message'] = 'Email atau password salah';
					$this->session->set_flashdata('msg', $msg);
          redirect('./');
        }
    }

  public function logout() {
      $this->session->unset_userdata('user');
      redirect('./');
  }

}
