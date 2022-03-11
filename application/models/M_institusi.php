<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_institusi extends CI_Model {
	
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function list_institusi(){
		$this->db->select("*");
		$this->db->from("institusi");
		$query	 = $this->db->get();
		$results = $query->result_array();
		return $results;
	}
	
	public function check_faByID($par){
		$this->db->select("*");
		$this->db->from("institusi");
		$this->db->where("fa_ID",$par);
		$query	 = $this->db->get();
		$results = $query->result_array();
		return $results[0];
	}
}