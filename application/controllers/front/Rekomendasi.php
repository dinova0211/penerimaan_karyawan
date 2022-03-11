<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('M_kriteria');
		$this->load->model('M_analisa');
    }
	
	public function pilihRestoran($id){	
		$data['kriteria']			= $this->M_kriteria->list_kriteria();
		$data['id_restoran']		= $id;
		$data['v_content']			= "front/rekomendasi/cari_lokasi";
        $this->load->view('front/layout',$data);
	}
	
	
	
	public function doAdd(){
        $post = $this->input->post();
		
		$this->db->truncate('detilkandidat');
		/*
		print_r($post);die;
		$insertData = array(
			"idRestoran"	=> 	$post['id_restoran'],
			"tglPegajuan"	=>	date("Y-m-d H:i:s")
		);
		
		$insert 	= $this->db->insert("kandidat",$insertData);
		$insertID 	= $this->db->insert_id();
		
		*/
		
		foreach (array_filter($post['nama_restorant']) as $key => $value) {
			
			$insertData = array(
				"idRestoran"	=> 	$value,
				"tglPegajuan"	=>	date("Y-m-d H:i:s")
			);
			
			$insert 	= $this->db->insert("kandidat",$insertData);
			$insertID 	= $this->db->insert_id();
			
			$sql = $this->db->query("select * from restorant where restorant_id = '".$value."' ")->result();
			foreach ($sql as $vSql){
				$insertSubData = array(
					"idKandidat"	=> $insertID,
					"idSubKriteria"	=> $vSql->C2,
					
					);
				$this->db->insert("detilkandidat",$insertSubData);
			}
			
			foreach ($sql as $vSql){
				$insertSubData = array(
					"idKandidat"	=> $insertID,
					"idSubKriteria"	=> $vSql->C3,
					
					);
				$this->db->insert("detilkandidat",$insertSubData);
			}
			
			foreach ($sql as $vSql){
				$insertSubData = array(
					"idKandidat"	=> $insertID,
					"idSubKriteria"	=> $vSql->C4,
					
					);
				$this->db->insert("detilkandidat",$insertSubData);
			}
			
			foreach ($sql as $vSql){
				$insertSubData = array(
					"idKandidat"	=> $insertID,
					"idSubKriteria"	=> $vSql->C6,
					
					);
				$this->db->insert("detilkandidat",$insertSubData);
			}
			foreach ($sql as $vSql){
				$insertSubData = array(
					"idKandidat"	=> $insertID,
					"idSubKriteria"	=> $vSql->C7,
					
					);
				$this->db->insert("detilkandidat",$insertSubData);
			}
			$insertHasilArray = array(
					"idKandidat"	=> $insertID,
					"nilaiWPM"		=> 0,
				);
			$insert_hasil = $this->db->insert("hasilanalisa",$insertHasilArray);
			
		}				
		

		$idKandidat1 = "";
		$grand_total_prefensi = 0 ;
		foreach ($this->M_analisa->list_kandidat() as $value) {
			$idKandidat1 = $value['idKandidat'];
			$total_prefensi = 0;
			
			foreach ($this->M_kriteria->list_kriteria() as $row) {
				$total = $this->M_analisa->total_kriteria($row['idKriteria']);
				foreach ($this->M_analisa->subtotal_kriteria($idKandidat1,$row['idKriteria']) as $data) {
					//echo $this->db->last_query();die;
					$prefensi = round(pow($data['subtotal'],$data['total_k']),4);
					 $total_prefensi += $prefensi;
				}
			}
			$this->db->update('hasilanalisa',array('nilaiWPM' => $total_prefensi),array('idKandidat' => $idKandidat1));
		}
		
		$data['hasilAnalisa'] = $this->M_analisa->hasil_wpm2();
		//echo $this->db->last_query();die;
		
		$data['v_content']	="front/rekomendasi/rekomendasi";
        $this->load->view('front/layout',$data);
		
		
    }
	
	
	function distance($lat1, $lat2 , $long1, $long2){
		
		//ORIGIN : -6.989918, 110.422969
		//DEST   : -7.056229, 110.486117
		$url1 = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1."%2C".$long1."&destinations=".$lat2."%2C".$long2."&mode=driving&language=pl-PL%20&key=AIzaSyD7Mr1SnmpnkqSqZZcFDXOPK0LVGJ1aqV4";
		
		
		$str_url1 = str_replace(' ','',$url1);
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $str_url1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if ($err) {
		  echo "cURL Error #:".$err;
		} else {
			$response_a = json_decode($response, true);
			
			$distance	= $response_a['rows'][0]['elements'][0]['distance']['value']; //KM
			$time 		= $response_a['rows'][0]['elements'][0]['duration']['value'];  //MENIT
			
			//$time		= intval($index_time); //MENIT
			
			$dataDistTime	= array(
							"distance"	=> $distance/1000, ///////DARI M KE KM
							"time"		=> ($time/60)/60 ///////DARI DETIK KE MENIT KE JAM
			);
			
			return $dataDistTime;
		}
	}
}
