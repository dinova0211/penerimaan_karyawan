<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_proses extends CI_Model {
	
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }



	public function list_kriteria($is_upload){
		$this->db->select("*");
		$this->db->from("kriteria");
		//$this->db->where("is_upload",$is_upload);
		$this->db->where("is_delete",0);
		$query		= $this->db->get();
		$result 	= $query->result_array();
		return $result;
	}

	public function list_AllKriteria(){
		$this->db->select("*");
		$this->db->from("kriteria");
		$this->db->where("is_delete",0);
		$query		= $this->db->get();
		$result 	= $query->result_array();
		return $result;
	}

	public function list_sub_kriteria($par,$par2){
		$this->db->select("*");
		$this->db->from("detilkandidat AS dtk");
		$this->db->join("subkriteria AS sub","sub.idSubKriteria = dtk.idSubKriteria");
		$this->db->join("kriteria as krit","krit.idKriteria = sub.idKriteria");
		$this->db->where("dtk.idKandidat",$par);
		$this->db->where("krit.idKriteria",$par2);
		$query		= $this->db->get();
		$result 	= $query->result_array();
		return $result;
	}

	public function list_sub_kriteria2($par){
		$this->db->select("sub.*");
		$this->db->from("subkriteria AS sub");
		$this->db->join("detilkandidat as dtk","dtk.idSubKriteria = sub.idSubKriteria","left");
		$this->db->where("sub.idKriteria",$par);
		$query		= $this->db->get();
		$result 	= $query->result_array();
		return $result;
	}

}