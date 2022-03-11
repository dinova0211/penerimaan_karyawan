<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_programStudy extends CI_Model {
	
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function lsit_fakultas(){
		$this->db->select("*");
		$this->db->from("institusi");
		$query	 = $this->db->get();
		$results = $query->result_array();
		return $results;
	}
	
	public function list_progStudy(){
		$this->db->select("psd.*,fa.fa_name");
		$this->db->from("program_study AS psd");
		$this->db->join("institusi AS fa","fa.fa_ID=psd.fa_ID","left");
		$query	= $this->db->get();
		$results= $query->result_array();
		return $results;
	}
	
	public function check_prog_byID($par){
		$this->db->select("*");
		$this->db->from("program_study");
		$this->db->where("psd_ID",$par);
		$query  = $this->db->get();
		$result = $query->result_array();
		return $result[0];
	}
}