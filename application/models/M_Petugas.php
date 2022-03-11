<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_petugas extends CI_Model {
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function check_email_dosen($email){
		$this->db->select('*');
        $this->db->from('petugas');
        $this->db->where('email', $email);
        $query = $this->db->get();
		$result= $query->num_rows();
		return $result;
	}
	
	public function check_email_petugas($email){
		$this->db->select('*');
        $this->db->from('petugas');
        $this->db->where('email', $email);
        $query = $this->db->get();
		$result= $query->num_rows();
		return $result;
	}

	public function listPetugas(){
		$this->db->select("*");
		$this->db->from('petugas');
		$this->db->where("level<>",'1');
        $query = $this->db->get();
		$result= $query->result_array();
		return $result;
	}

	public function getDataPetugas($par){
		$this->db->select('*');
        $this->db->from('petugas');
        $this->db->where('idPetugas', $par);
        $query = $this->db->get();
		$result= $query->result_array();
		return $result[0];
	}

}