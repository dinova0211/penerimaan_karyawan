<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengajuan extends CI_Model {
	
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function list_fakultas(){
		$this->db->select("*");
		$this->db->from("institusi");
		$query		= $this->db->get();
		$result		= $query->result_array();
		return $result;
	}
	public function list_progstudi(){
		$this->db->select("*");
		$this->db->from("program_study");
		$query	= $this->db->get();
		$result = $query->result_array();
		return $result;
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

	public function list_sub_kriteria($par){
		$this->db->select("*");
		$this->db->from("subkriteria");
		$this->db->where("idKriteria",$par);
		$this->db->where("is_delete",0);
		$query		= $this->db->get();
		$result 	= $query->result_array();
		return $result;
	}

	public function list_pengajuan($par){
		$this->db->select("kn.*,fa1.fa_name AS fa_asal, fa2.fa_name AS fa_tujuan, psd1.psd_name AS psd_asal, psd2.psd_name AS psd_tujuan,hs.ket ,  hs.nilaiWPM,hs.isApprove,hs.suratMutasi");
		$this->db->from("kandidat AS kn");
		$this->db->where("kn.idDosen",$par);
		$this->db->join("hasilanalisa AS hs","hs.idKandidat = kn.idKandidat");
		$this->db->join("institusi AS fa1","fa1.fa_ID=kn.fa_asal","left");
		$this->db->join("institusi AS fa2","fa2.fa_ID=kn.fa_tujuan","left");
		$this->db->join('program_study AS psd1',"psd1.psd_ID = kn.psd_asal","left");
		$this->db->join("program_study AS psd2","psd2.psd_ID = kn.psd_tujuan","left");
		$query		= $this->db->get();
		$result 	= $query->result_array();
		return $result;
	}

	public function listEdit_sub_kriteria($par,$par2){
		$this->db->select("*");
		$this->db->from("detilkandidat AS dtk");
		$this->db->join("subkriteria AS sub","sub.idSubKriteria = dtk.idSubKriteria");
		$this->db->join("kriteria as krit","krit.idKriteria = sub.idKriteria");
		$this->db->where("dtk.idKandidat",$par);
		$this->db->where("krit.idKriteria",$par2);
		$query		= $this->db->get();
		$result 	= $query->row_array();
		return $result;
	}

	public function listEdit_sub_kriteria2($par,$par2,$par3){
		$this->db->select("*");
		$this->db->from("detilkandidat AS dtk");
		$this->db->join("subkriteria AS sub","sub.idSubKriteria = dtk.idSubKriteria");
		$this->db->join("kriteria as krit","krit.idKriteria = sub.idKriteria");
		$this->db->where("dtk.idKandidat",$par);
		$this->db->where("krit.idKriteria",$par2);
		$this->db->where("sub.idSubKriteria",$par3);
		$query		= $this->db->get();
		$result 	= $query->row_array();
		return $result;
	}

	public function listPetugas(){
		$this->db->select("email");
		$this->db->from("petugas");
		$this->db->where("level <>",2);
		$query 	= $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function hitungSAW($par, $par2){
		$sql = "SELECT 
		Y.idKandidat, Y.idDosen,sum(Y.sum_MP) Hasil_MP 
		FROM 
		(select Z.idKandidat,Z.idDosen,Z.idKriteria, sum(Z.MP) sum_MP 
		FROM 
		(select TK.idKandidat,TK.idDosen,TDK.idSubKriteria,TSK.idKriteria,TSK.bobot,TSK.bobot/100 NM, (TSK.bobot/100) * TSK.bobot MP 
		FROM
		kandidat TK
		inner join detilkandidat TDK on TK.idKandidat = TDK.idKandidat 
		inner join subkriteria TSK on TDK.idSubKriteria = TSK.idSubKriteria 
		order by TSK.idKriteria asc,TSK.idSubKriteria asc) Z 
		group by Z.idDosen,Z.idKriteria) Y
		WHERE 
		Y.idDosen = '$par'
		AND
		Y.idKandidat = '$par2'
		group by Y.idDosen ";
		$query	= $this->db->query($sql);
		$result = $query->result_array();
		return $result[0];
	}

	public function hitungWPM($par,$par2){
		$sql = "select Y.idKandidat,Y.idDosen,TD.nip,TD.nama,sum(Y.MP),X.GrandTotal,round(sum(Y.MP)/X.GrandTotal,6) hasil from 
					(select Z.idKandidat,Z.idDosen,Z.idKriteria,sum(Z.NM) sum_NM, GrandTotal_NM,sum(Z.NM) /GrandTotal_NM Hasil_NM,Z.bobot,
									((sum(Z.NM) /GrandTotal_NM)*Z.max_bobot) MP
					from
						(select TK.idKandidat,TK.idDosen,TDK.idSubKriteria,TSK.idKriteria,TSK.bobot,TSK.bobot*TSK.bobot NM,MK.max_bobot
						from kandidat TK inner join detilkandidat TDK on TK.idKandidat = TDK.idKandidat
														 inner join subkriteria TSK on TDK.idSubKriteria = TSK.idSubKriteria
														 inner join (select idKriteria,bobot max_bobot from kriteria) MK on TSK.idKriteria = MK.idKriteria
														 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
						where HA.isApprove = '0'
						order by TSK.idKriteria asc,TSK.idSubKriteria asc) Z
						inner join (select TSK.idKriteria,sum(TSK.bobot*TSK.bobot) GrandTotal_NM
						from kandidat TK inner join detilkandidat TDK on TK.idKandidat = TDK.idKandidat
														 inner join subkriteria TSK on TDK.idSubKriteria = TSK.idSubKriteria
														 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
						where HA.isApprove = '0'
						group by TSK.idKriteria) NM on Z.idKriteria = NM.idKriteria
					group by 	Z.idDosen,Z.idKriteria) Y inner join dosen TD on Y.idDosen = TD.id
				join (select Y.idKandidat,Y.idDosen,sum(Y.MP) GrandTotal from 
					(select Z.idKandidat,Z.idDosen,Z.idKriteria,sum(Z.NM) sum_NM, GrandTotal_NM,sum(Z.NM) /GrandTotal_NM Hasil_NM,Z.bobot,
									((sum(Z.NM) /GrandTotal_NM)*Z.max_bobot) MP
					from
						(select TK.idKandidat,TK.idDosen,TDK.idSubKriteria,TSK.idKriteria,TSK.bobot,TSK.bobot*TSK.bobot NM,MK.max_bobot
						from kandidat TK inner join detilkandidat TDK on TK.idKandidat = TDK.idKandidat
														 inner join subkriteria TSK on TDK.idSubKriteria = TSK.idSubKriteria
														 inner join (select idKriteria,bobot max_bobot from kriteria) MK on TSK.idKriteria = MK.idKriteria
														 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
						where HA.isApprove = '0'
						order by TSK.idKriteria asc,TSK.idSubKriteria asc) Z
						inner join (select TSK.idKriteria,sum(TSK.bobot*TSK.bobot) GrandTotal_NM
						from kandidat TK inner join detilkandidat TDK on TK.idKandidat = TDK.idKandidat
														 inner join subkriteria TSK on TDK.idSubKriteria = TSK.idSubKriteria
														 inner join hasilanalisa HA on HA.idKandidat = TK.idKandidat
						where HA.isApprove = '0'
						group by TSK.idKriteria) NM on Z.idKriteria = NM.idKriteria
					group by 	Z.idDosen,Z.idKriteria) Y) X
					where Y.idDosen = $par and Y.idKandidat = $par2
				group by Y.idDosen ";

		$query	= $this->db->query($sql);
		$result = $query->result_array();
		return $result[0];
	}

	public function check_approval($par){
		$this->db->select("hs.isApprove");
		$this->db->from("hasilanalisa AS hs");
		$this->db->where("hs.isApprove","0");
		$this->db->where("knd.idRestoran",$par);
		$this->db->join("kandidat AS knd","knd.idKandidat = hs.idKandidat");
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}

	public function detailKandidat($id){
		$this->db->select("*");
		$this->db->from("kandidat");
		$this->db->where("idKandidat",$id);
		$query	= $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	
	public function detKandidat($id,$id2){
		$sql = "select * from detilkandidat where idKandidat = '".$id."' and idSubKriteria = '".$id2."' ";
		$query	= $this->db->query($sql);
		$result = $query->result_array();
		return $result[0];
	}
	
	public function listEdit_sub_kriteria_cek($par){
		$this->db->select("*");
		$this->db->from("detilkandidat AS dtk");
		$this->db->join("subkriteria AS sub","sub.idSubKriteria = dtk.idSubKriteria");
		$this->db->join("kriteria as krit","krit.idKriteria = sub.idKriteria");
		$this->db->where("dtk.idKandidat",$par);
		$this->db->where("dtk.idSubKriteria","3");
		$query		= $this->db->get();
		$result 	= $query->row_array();
		return $result;
	}
	
	public function listPenilaian(){
		$this->db->select("kn.*,fa1.fa_name AS fa_asal, fa2.fa_name AS fa_tujuan, psd1.psd_name AS psd_asal, psd2.psd_name AS psd_tujuan,hs.ket ,  hs.nilaiWPM,hs.isApprove,hs.suratMutasi");
		$this->db->from("kandidat AS kn");
		$this->db->join("hasilanalisa AS hs","hs.idKandidat = kn.idKandidat");
		$this->db->join("institusi AS fa1","fa1.fa_ID=kn.fa_asal","left");
		$this->db->join("institusi AS fa2","fa2.fa_ID=kn.fa_tujuan","left");
		$this->db->join('program_study AS psd1',"psd1.psd_ID = kn.psd_asal","left");
		$this->db->join("program_study AS psd2","psd2.psd_ID = kn.psd_tujuan","left");
		$query		= $this->db->get();
		$result 	= $query->result_array();
		return $result;
	}
}