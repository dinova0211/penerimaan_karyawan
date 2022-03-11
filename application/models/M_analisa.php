<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_analisa extends CI_Model {
	
	public function __construct(){
        parent::__construct();
        $this->load->database(); 
    }
	
	public function list_kandidat(){
		$this->db->select("TK.idKandidat,TD.namaPengguna");
		$this->db->from("kandidat TK");
		$this->db->join("pengguna TD","TK.idRestoran = TD.idPengguna");
		$this->db->join("hasilanalisa HA","TK.idKandidat = HA.idKandidat");
		$this->db->where("HA.isApprove","0");
		$query	 = $this->db->get();
		$results = $query->result_array();
		return $results;
	}

	public function subtotal_kriteria($idKandidat,$idKriteria){
		$sql = "select round(exp(sum(log(pow(SK.bobot,SK.bobot/total_sk)))),4) subtotal,(K.bobot/total_k) total_k
				from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat
												 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria
												 inner join kriteria K on SK.idKriteria = K.idKriteria
												 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
												 join (select sum(bobot) total_sk from subkriteria where idKriteria = '".$idKriteria."') tsk
												 join (select sum(bobot) total_k from kriteria) tk
				where TK.idKandidat = '".$idKandidat."' and K.idKriteria = '".$idKriteria."' and  HA.isApprove = '0'";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}

	public function total_kriteria($idKriteria){
		$sql = "select round(exp(sum(log(pow(SK.bobot,SK.bobot/total_sk)))),4) total,(K.bobot/total_k) total_k
				from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat
												 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria
												 inner join kriteria K on SK.idKriteria = K.idKriteria
												 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
												 join (select sum(bobot) total_sk from subkriteria where idKriteria = '".$idKriteria."') tsk
												 join (select sum(bobot) total_k from kriteria) tk
				where K.idKriteria = '".$idKriteria."' and  HA.isApprove = '0'";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results[0];
	}

	public function subtotal_kriteria2($idKandidat,$idKriteria){
		$sql = "select sum(SK.bobot*SK.bobot*K.bobot) subtotal
				from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat
												 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria
												 inner join kriteria K on SK.idKriteria = K.idKriteria
												 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
				where TK.idKandidat = '".$idKandidat."' and K.idKriteria = '".$idKriteria."' and HA.isApprove = '0'";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}

	public function hasil_wpm(){
		$sql = "select 
		                TD.namaPengguna,
		                HA.nilaiWPM hasil,
		                HA.idKandidat
				from 
				        hasilanalisa HA 
				        inner join kandidat TK on HA.idKandidat = TK.idKandidat
						inner join pengguna TD on TK.idRestoran = TD.idPengguna
				where 
				        isApprove = 0
				order by 
				        HA.nilaiWPM desc";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}
	
	public function hasil_wpm2(){ 
		$sql = "select MAX(HA.nilaiWPM) total, TD.*,HA.nilaiWPM hasil,HA.idKandidat
				from hasilanalisa HA inner join kandidat TK on HA.idKandidat = TK.idKandidat
									 inner join restorant TD on TK.idRestoran = TD.restorant_id
				where isApprove = 0
				order by HA.nilaiWPM desc";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}

	public function subtotal_kriteriaSAW($idKandidat,$idKriteria){
		$sql = "select sum((SK.bobot/maksimum)*SK.bobot) subtotal 
				from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat 
								 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria 
								 inner join kriteria K on SK.idKriteria = K.idKriteria 
								 inner join (select DK.idSubKriteria,max(SK.bobot) maksimum
											from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat 
															 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria 
															 inner join kriteria K on SK.idKriteria = K.idKriteria
											where K.idKriteria = '".$idKriteria."'
								group by idSubKriteria) Z on Z.idSubKriteria =  DK.idSubKriteria
				where TK.idKandidat = '".$idKandidat."' and K.idKriteria = '".$idKriteria."'";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}

	public function subtotal_kriteria2SAW($idKandidat,$idKriteria){
		$sql = "select ((subtotal/maksimum)*total) subtotal from (
				select sum((SK.bobot/maksimum)*SK.bobot) subtotal 
				from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat 
								 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria 
								 inner join kriteria K on SK.idKriteria = K.idKriteria 
								 inner join (select DK.idSubKriteria,max(SK.bobot) maksimum
											from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat 
															 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria 
															 inner join kriteria K on SK.idKriteria = K.idKriteria
											where K.idKriteria = '".$idKriteria."'
								group by idSubKriteria) Z on Z.idSubKriteria =  DK.idSubKriteria
				where TK.idKandidat = '".$idKandidat."' and K.idKriteria = '".$idKriteria."') A
				join (
select max(subtotal) maksimum from (
	select sum((SK.bobot/maksimum)*SK.bobot) subtotal ,K2.max_bobot
	from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat 
								 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria 
								 inner join kriteria K on SK.idKriteria = K.idKriteria
								 inner join (select DK.idSubKriteria,max(SK.bobot) maksimum
												from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat 
																				 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria 
																				 inner join kriteria K on SK.idKriteria = K.idKriteria
												where K.idKriteria = '".$idKriteria."'
												group by idSubKriteria) Z on Z.idSubKriteria =  DK.idSubKriteria
									join (select max(bobot) max_bobot from subkriteria where is_delete = 0 and idKriteria = '".$idKriteria."') K2 
	where K.idKriteria = '".$idKriteria."'
group by TK.idKandidat) A) B
				join (select max(bobot) total from kriteria where idKriteria = '".$idKriteria."') C
				";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}
	
	public function hasil(){
		$sql = "select 
		                TD.namaPengguna,
		                TD.alamatPengguna, 
		                TD.noHP, 
		                HA.nilaiWPM hasil,
        				CASE  
        				WHEN HA.nilaiWPM >= 5 THEN 'Sangat Baik'
        				WHEN HA.nilaiWPM >= 4 THEN 'Baik'
        				WHEN HA.nilaiWPM >= 3 THEN 'Cukup Baik'
        				WHEN HA.nilaiWPM >= 2 THEN 'Rendah'
        				ELSE 'Sangat Rendah'
        				END as keterangan,
        				HA.idKandidat
				from 
				        hasilanalisa HA 
				        inner join kandidat TK on HA.idKandidat = TK.idKandidat
				        inner join pengguna TD on TK.idRestoran = TD.idPengguna
				where 
				        isApprove = 0
				order by 
				        HA.nilaiWPM desc";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}
	
	public function hasil_cari($cari){
		$sql = "select TD.restorant_name,TD.foto, TD.alamat, TD.email, TD.no_hp, HA.nilaiWPM hasil,
				CASE  
				WHEN HA.nilaiWPM >= 5 THEN 'Sangat Baik'
				WHEN HA.nilaiWPM >= 4 THEN 'Baik'
				WHEN HA.nilaiWPM >= 3 THEN 'Cukup Baik'
				WHEN HA.nilaiWPM >= 2 THEN 'Rendah'
				ELSE 'Sangat Rendah'
				END as keterangan ,
		
				HA.idKandidat
				from hasilanalisa HA inner join kandidat TK on HA.idKandidat = TK.idKandidat
									 inner join restorant TD on TK.idRestoran = TD.restorant_id
				where isApprove = 0 and TD.alamat LIKE '%".$cari."%' OR TD.nama LIKE '%".$cari."%' OR HA.nilaiWPM LIKE '%".$cari."%'
				order by HA.nilaiWPM desc";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}
	
	
	public function hasil_cari_by_penilaian($kriteria){
		$sql = "select TD.restorant_name,TD.foto, TD.alamat, TD.email, TD.no_hp, HA.nilaiWPM hasil,
				CASE  
				WHEN HA.nilaiWPM >= 5 THEN 'Sangat Baik'
				WHEN HA.nilaiWPM >= 4 THEN 'Baik'
				WHEN HA.nilaiWPM >= 3 THEN 'Cukup Baik'
				WHEN HA.nilaiWPM >= 2 THEN 'Rendah'
				ELSE 'Sangat Rendah'
				END as keterangan ,
		
				HA.idKandidat
				from hasilanalisa HA inner join kandidat TK on HA.idKandidat = TK.idKandidat
									 inner join restorant TD on TK.idRestoran = TD.restorant_id
				where isApprove = 0 and  HA.nilaiWPM >= '".$kriteria."'
				order by HA.nilaiWPM desc";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}
	
	
	
	public function hasil_keterangan($idKandidat){
		$sql = "select CASE  
				WHEN round(sum(SK.bobot)/count(SK.bobot),0) >= 5 THEN 'Sangat Baik'
				WHEN round(sum(SK.bobot)/count(SK.bobot),0) >= 4 THEN 'Baik'
				WHEN round(sum(SK.bobot)/count(SK.bobot),0) >= 3 THEN 'Cukup Baik'
				WHEN round(sum(SK.bobot)/count(SK.bobot),0) >= 2 THEN 'Rendah'
				ELSE 'Sangat Rendah'
				END as hasil_prefensi 
				from kandidat TK inner join detilkandidat DK on TK.idKandidat = DK.idKandidat
												 inner join subkriteria SK on DK.idSubKriteria = SK.idSubKriteria
												 inner join kriteria K on SK.idKriteria = K.idKriteria
												 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
				where TK.idKandidat = '".$idKandidat."' and  HA.isApprove = '0' ";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results[0];
	}
	
	public function detailHasil($id){
		$sql = "Select * from hasilanalisa where idHasilAnalisa = '".$id."'";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results[0];
	}
	
	public function hasil_cari_by_kriteria($kriteria){
		$sql = "select TD.restorant_name,TD.foto, TD.alamat, TD.email, TD.no_hp, HA.nilaiWPM hasil,namaSubKriteria,
				CASE  
				WHEN HA.nilaiWPM >= 5 THEN 'Sangat Baik'
				WHEN HA.nilaiWPM >= 4 THEN 'Baik'
				WHEN HA.nilaiWPM >= 3 THEN 'Cukup Baik'
				WHEN HA.nilaiWPM >= 2 THEN 'Rendah'
				ELSE 'Sangat Rendah'
				END as keterangan ,
		
				HA.idKandidat
				from hasilanalisa HA 
				inner join kandidat TK on HA.idKandidat = TK.idKandidat
				inner join detilkandidat DTK on DTK.idKandidat = TK.idKandidat
				inner join subkriteria SK on SK.idSubKriteria = DTK.idSubKriteria
				inner join restorant TD on TK.idRestoran = TD.restorant_id
				where isApprove = 0 and  DTK.idSubKriteria = '".$kriteria."'
				order by HA.nilaiWPM desc";
		$query	 = $this->db->query($sql);
		$results = $query->result_array();
		return $results;
	}
	
}