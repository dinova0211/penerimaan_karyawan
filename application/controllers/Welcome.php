<?php
class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$data['hello']='hellow world';

		$data['destination'] = array(
			'site' => 'block_view/home',
		);

		$data['collection'] = array(
			'title' => 'My Title',
			'heading' => 'My Heading',
			'message' => 'My Message'
		);
		

		$this->load->view('modular_view_index', $data);
	}
}
