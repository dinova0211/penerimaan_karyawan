<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kriteria extends CI_Model {
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function list_kriteria(){
    	$this->db->select("*");
    	$this->db->from("kriteria");
    	$this->db->where("is_delete","0");
    	$query  = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function list_kriteria_byID($par){
    	$this->db->select("*");
    	$this->db->from("kriteria");
    	$this->db->where("idKriteria",$par);
    	$query  = $this->db->get();
    	$result = $query->result_array();
    	return $result[0];
    }

    public function list_sub(){
    	$this->db->select("sub.*,kr.namaKriteria");
    	$this->db->from("subkriteria as sub");
    	$this->db->join("kriteria as kr","kr.idKriteria = sub.idKriteria","left");
    	$this->db->where("sub.is_delete","0");
    	$this->db->where("kr.is_delete","0");
    	$query  = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function list_sub_byID($par){
    	$this->db->select("sub.*,kr.namaKriteria");
    	$this->db->from("subkriteria as sub");
    	$this->db->join("kriteria as kr","kr.idKriteria = sub.idKriteria","left");
    	$this->db->where("idSubKriteria",$par);
    	$this->db->where("sub.is_delete","0");
    	$this->db->where("kr.is_delete","0");
    	$query  = $this->db->get();
    	$result = $query;
    	return $result;
    }
	
	public function get_list_sub_byID($par){
    	$this->db->select("sub.*,kr.namaKriteria");
    	$this->db->from("subkriteria as sub");
    	$this->db->join("kriteria as kr","kr.idKriteria = sub.idKriteria","left");
    	$this->db->where("sub.idKriteria",$par);
    	$this->db->where("sub.is_delete","0");
    	$this->db->where("kr.is_delete","0");
    	$query  = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }
	
	public function listKriteriaSubById($kriteria){
    	$this->db->select("idSubKriteria, namaSubKriteria");
    	$this->db->from("kriteria");
    	$this->db->join("subkriteria","subkriteria.idKriteria = kriteria.idKriteria");
    	$this->db->where("subkriteria.idKriteria",$kriteria);
    	$query  = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }
    
    public function get_kriteria()
    {
        $this->db->select("idKriteria,
                            namaKriteria,bobot,
                            type");
    	$this->db->from("kriteria");
    	$this->db->order_by("idKriteria","ASC");
    	$query = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }
    
    public function get_label_kriteria()
    {
       
        $this->db->select("idKriteria,type");
    	$this->db->from("kriteria");
    	$this->db->order_by("idKriteria", "asc");
    	$query = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }
    
    public function get_bobot_kriteria()
    {
        $this->db->select("idKriteria,
                            bobot,
                            type");
    	$this->db->from("kriteria");
    	$this->db->order_by("idKriteria", "ASC");
    	$query = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }
    
    public function get_data_karyawan()
    {
        $this->db->select("idPengguna,
                            namaPengguna");
    	$this->db->from("pengguna");
    	$this->db->order_by("namaPengguna", "ASC");
    	$query = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }
    
    public function get_penilaian()
    {
        $this->db->select(" a.idPengguna, 
                            b.idkriteria, 
                            sum(b.nilai) as nilai, 
                            c.type,
                             c.bobot");
    	$this->db->from("pengguna a");
    	$this->db->join("penilaian b",  "a.idPengguna=b.idpengguna","inner");
    	$this->db->join("kriteria c",  "c.idKriteria=b.idkriteria","inner");
    	$this->db->group_by("a.idPengguna,b.idkriteria");
    	$query = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }
    
    public function get_total_kriteria($id_kriteria,$idpengguna)
    {
    //     $this->db->select("sum(log(pow(DK.nilai,DK.nilai/total_k))) totalxx, 
    //                         (K.bobot/total_k) total_k, 
    //                         K.bobot, 
    //                         total_k, 
    //                         K.type");
    // 	$this->db->from("pengguna TK");
    // 	$this->db->join("penilaian DK","TK.idPengguna = DK.idpengguna","inner");
    // 	$this->db->join("subkriteria SK","DK.idsubkriteria = SK.idSubKriteria","inner");
    // 	$this->db->join("kriteria K","SK.idKriteria = K.idKriteria","inner");
    // 	$this->db->join("(select sum(bobot) total_k from kriteria) tk",false);
    // 	$this->db->WHERE("K.idKriteria",$id_kriteria,false);
    // 	$query = $this->db->get();
    // 	$result = $query->result_array();
    // 	return $result;
    	$sql = "select sum(log(pow(DK.nilai,DK.nilai/total_k))) totalxx, (K.bobot/total_k) total_k, K.bobot,  K.type, total_n,K.idKriteria
				from pengguna TK inner join penilaian DK on TK.idPengguna = DK.idpengguna
												 inner join subkriteria SK on DK.idsubkriteria = SK.idSubKriteria
												 inner join kriteria K on SK.idKriteria = K.idKriteria
												
												 
												 join (select sum(bobot) total_k from kriteria) tk
												 join (select sum(nilai) total_n from penilaian where idkriteria='".$id_kriteria."' and idpengguna='".$idpengguna."') tn
				where K.idKriteria = '".$id_kriteria."'";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results[0];
    	
    }
    
    public function check_calback_nilai($idpengguna,$idkriteria,$nilai)
    {
        $this->db->select("count(*)");
    	$this->db->from("hitung_wp");
    	$this->db->WHERE("idpengguna",$idpengguna);
    	$this->db->WHERE("idkriteria",$idkriteria);
    	$result = $this->db->count_all_results();
    	return $result;
    }
    
    public function insert_pw($idpengguna,$idkriteria,$nilai)
    {
        $this->db->set("id",'');
        $this->db->set("idpengguna",$idpengguna);
        $this->db->set("idkriteria",$idkriteria);
        $this->db->set("nwp",$nilai);
    	$this->db->insert("hitung_wp");
    	$this->db->trans_complete();
        
    }
    
    public function delete()
    {
        
        $this->db->empty_table('hitung_wp');
    }
    
    // public function update_pw($idpengguna,$idkriteria,$nilai)
    // {
    //     $this->delete();
    //     $this->db->set("nwp",$nilai);
    //     $this->db->WHERE("idpengguna",$idpengguna);
    //     $this->db->WHERE("idkriteria",$idkriteria);
    // 	$this->db->update("hitung_wp");
    // 	$this->db->trans_complete();
        
    // }
    
    public function getshow_nilai($idpengguna)
    {
        $this->db->select("idpengguna, GROUP_CONCAT(nwp SEPARATOR ',') as htg");
    	$this->db->from("hitung_wp");
    	$this->db->WHERE("idpengguna",$idpengguna);
    	$result = $this->db->get()->result_array();
    	return $result;
    }
    
    
    
}