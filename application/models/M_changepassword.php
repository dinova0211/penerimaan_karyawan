<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_changepassword extends CI_Model {
 
   public function checkpassdosen($par,$par2){
        $this->db->select("id");
        $this->db->from("dosen");
        $this->db->where("id",$par);
        $this->db->where("password",$par2);
        $query  = $this->db->get();
        $result = $query->num_rows();
        return $result;
   } 

   public function checkpasspetugas($par,$par2){
        $this->db->select("idPetugas");
        $this->db->from("petugas");
        $this->db->where("idPetugas",$par);
        $this->db->where("password",$par2);
        $query  = $this->db->get();
        $result = $query->num_rows();
        return $result;
   } 

}

