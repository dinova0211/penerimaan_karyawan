<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_kota');
		$this->load->model('m_foto_wisata');
		$this->load->model('m_lokasi_wisata');
		$this->load->model('m_kriteria');
		$this->load->model('m_electre');
    }
	
	public function index(){	
		$data['list_kota']			= $this->m_kota->get_all();
		$data['foto_wisata'] 		= $this->m_foto_wisata->all();
		$data['list_lokasi_wisata'] = $this->m_lokasi_wisata->all();
		$data['kriteria']			= $this->m_kriteria->getKriteria();
		$data['v_content']			= "front/rekomendasi/cari_lokasi";
        $this->load->view('front/layout',$data);
	}
	
	
	
	public function doAdd(){
        $post = $this->input->post();
		$jenis_wisata = $post['jenis_wisata'];
		$data['jenis_wisata'] = $jenis_wisata;
		
		$this->db->truncate("weight");
		$kriteria		= $this->m_kriteria->getKriteria();
		
		
		// MASUKIN LOKASI ORIGINNYA
		$dataToInsert = array( 	"id" => "lokasi_asal",
								"lokasi" => $post['Postcode'],
								"latlng" => $post['lat'].",".$post['lng']
							);
		$this->db->insert('weight',$dataToInsert);
		
		// MASUKIN BOBOT KRITERIA YANG DIPILIH
		
		foreach($kriteria as $kkey => $vkriteria){
			$dataToInsert = array( 	"id" 		=> $vkriteria['slug'],
									"weight" 	=> ($post[$vkriteria['slug']]),
							);
			$this->db->insert('weight',$dataToInsert);
		}
		
		if($post['fasilitas']){
			$fasCount = count($post['fasilitas']);
			$fas = "";
			$fas2 = "";
			foreach($post['fasilitas'] as $key => $vfasilitas){
				$fas .= $vfasilitas.",";
				if($key == $fasCount-1){
					
					$fas2 .= "'".$vfasilitas."'";
				}else{
					$fas2 .= "'".$vfasilitas."',";
				}	
				
			}
			
			$data['fas'] = $fas2;
		}else{
			$data['fas'] = "";
			$fas2		 = "'kosong'";
		}
		
		$data_lokasi_wisata	= $this->m_lokasi_wisata->getLokByCari($jenis_wisata,$fas2);
		foreach($data_lokasi_wisata as $vLokasi){
			$kordinat = explode(',', $vLokasi['latlng']); // untuk koordinat lokasi
			
			$jarak = $this->distance($post['lat'],
									 $kordinat[0],
									 $post['lng'],
									 $kordinat[1]);
			
			foreach($kriteria as $vkriteria){
				if($vkriteria['slug'] == "jarak"){
					$getMaxRange = $this->db->query("SELECT
												*
											FROM
												sub_kriteria
											WHERE
												id_kriteria = 3
											order by range1 DESC limit 1")->row();
					$getSub = $this->db->query("SELECT
											*
										FROM
											sub_kriteria
										WHERE
											id_kriteria = 3
										AND '".round($jarak['distance'])."' >= range1 AND '".round($jarak['distance'])."' <= range2")->row();
					
					if($getMaxRange){
						if($jarak['distance'] >= $getMaxRange->range1){
							$sub_kriteria = $getMaxRange->id_sub_kriteria;
							$bobot		  = $getMaxRange->nilai;
						}else{
							$sub_kriteria = $getSub->id_sub_kriteria;
							$bobot		  = $getSub->nilai;
						}
					}else{
						$sub_kriteria = $getSub->id_sub_kriteria;
						$bobot		  = $getSub->nilai;
					}
					$valKriteria = $jarak['distance'];
					
				}else{
					$getMaxRange = $this->db->query("SELECT
												*
											FROM
												sub_kriteria
											WHERE
												id_kriteria = 2
											order by range1 DESC limit 1")->row();
					$getSub = $this->db->query("SELECT
											*
										FROM
											sub_kriteria
										WHERE
											id_kriteria = 2
										AND '".round($jarak['time'])."' >= range1 AND '".round($jarak['time'])."' <= range2")->row();
					if($getMaxRange){
						if($jarak['time'] >= $getMaxRange->range1){
							$sub_kriteria = $getMaxRange->id_sub_kriteria;
							$bobot		  = $getMaxRange->nilai;
						}else{
							$sub_kriteria = $getSub->id_sub_kriteria;
							$bobot		  = $getSub->nilai;
						}
					}else{
						$sub_kriteria = $getSub->id_sub_kriteria;
						$bobot		  = $getSub->nilai;
					}
					
					$valKriteria = $jarak['time']; 
				}
				
				
				if($vkriteria['slug'] <> "biaya"){
					$cek_inserted_bobot = $this->db->query("SELECT
														*
													FROM
														weight_lokasi_wisata
													WHERE
														id_lokasi_wisata = ".$vLokasi['id_lokasi_wisata']."
													AND id_bobot = '".$vkriteria['slug']."'")->row();
													
					$dataToInsert = array( 	
									"id_lokasi_wisata" 	=> $vLokasi['id_lokasi_wisata'],
									"id_bobot" 			=> $vkriteria['slug'],
									"sub_kriteria" 		=> $sub_kriteria,
									"bobot" 			=> $bobot,
									'value'				=> $valKriteria,
					);
					
					
					if(empty($cek_inserted_bobot)){
						$insert = $this->db->insert("weight_lokasi_wisata",$dataToInsert);
						
					}else{
						$update = $this->db->update("weight_lokasi_wisata",$dataToInsert,array("id_lokasi_wisata"=>$vLokasi['id_lokasi_wisata'], "id_bobot" => $vkriteria['slug']));
					}
					
				}
			}
		}

		$data['listKriteria'] 		= $kriteria;
		$listKriteria				= $data['listKriteria'];
		$weight 					= $this->db->query("select * from weight")->result_array();
		$data['listAlternatif'] = $this->db->query('SELECT
														*
													FROM
														weight_lokasi_wisata
													INNER JOIN lokasi_wisata ON lokasi_wisata.id_lokasi_wisata = weight_lokasi_wisata.id_lokasi_wisata
													WHERE
														weight_lokasi_wisata.id_lokasi_wisata IN (
															SELECT
																id_lokasi_wisata
															FROM
																weight_lokasi_wisata
															WHERE
																id_lokasi_wisata IN (
																	SELECT
																		id_lokasi_wisata
																	FROM
																		weight_lokasi_wisata
																	WHERE
																		id_bobot = "biaya"
																	AND bobot = '.$weight [1]['weight'].'
																)
															AND id_bobot = "jarak"
															AND bobot = '.$weight [3]['weight'].'
														)
													AND id_bobot = "waktu"
													AND bobot = '.$weight [2]['weight'].'
													AND `lokasi_wisata`.`id_jenis_wisata` = '.$jenis_wisata.'
													
													')->result_array();
		$listAlternatif = $data['listAlternatif'];
		
		
		$this->db->truncate("pembobotan_normalisasi");
		$this->db->truncate("concordance_discordance");
		$this->db->truncate("aggregate_dominan");
		$this->db->truncate("normalisasi");
		
		////////////////////////////// LANGKAH 1. NORMALISASI ////////////////////////////////
		
		$no = 1;
		foreach ($listAlternatif as $key_a => $alt){
			$hasil_akhir = 0;
			foreach ($listKriteria as $krt){ 
				$nilaiAlt = $this->m_electre->getNilaiAlt($alt['id_lokasi_wisata'], $krt['slug']);
				
				$nilaiSemuaAlt = $this->m_electre->getNilaiAlt($alt['id_lokasi_wisata']);
				
				$nilaiPangkat = 0;
				foreach($nilaiSemuaAlt as $vBobot){
					$nilaiPangkat += pow($vBobot['value'],2);
				}
				
				$nilaiNormalisasi = $nilaiAlt['value']/sqrt($nilaiPangkat);
				$hasil_akhir += $nilaiNormalisasi;
		
				$insertNormalisasi = array(
						"id_lokasi_wisata"	=> 	$alt['id_lokasi_wisata'],
						"id_kriteria"		=>	$krt['id_kriteria'],
						"bobot"				=>	$nilaiNormalisasi 
				);
				$this->db->insert("normalisasi", $insertNormalisasi);
			}	
		}
		
		//////////////////////////////// LANGKAH 2. PEMBOBOTAN NORMALISASI ///////////////////////
		$noAlt = 0;
		foreach ($listAlternatif as $key_a => $alt){ 
			$noAlt++;
	 
			$noKrt = 0;
			foreach ($listKriteria as $krt){ 
				$noKrt++;
				
				$nilaiAlt = $this->m_electre->getNilaiAlt($alt['id_lokasi_wisata'], $krt['slug']);
				
				$nilaiSemuaAlt = $this->m_electre->getNilaiAlt($alt['id_lokasi_wisata']);
				
				$nilaiPangkat = 0;
				foreach($nilaiSemuaAlt as $vBobot){
					
					$nilaiPangkat += pow($vBobot['value'],2);
				}
				
				$nilaiBobotNormalisasi = ($nilaiAlt['value']/sqrt($nilaiPangkat)) * $krt['bobot'];
				
				$simpanBobotNorm = array(
					"id_lokasi_wisata"	=> $alt['id_lokasi_wisata'],
					"kriteria"			=> $krt['id_kriteria'],
					"bobot"				=> $nilaiBobotNormalisasi,
					"baris"				=> "baris".$noAlt."_"."kolom".$noKrt,
				);
				$this->db->insert("pembobotan_normalisasi", $simpanBobotNorm);
			}
		}
		
		//////////////////////////////// LANGKAH 3A. MENENTUKAN CONCORDANCE ///////////////////////
		$no1=0;
		
		foreach ($listAlternatif as $alt1){ 
			$no1++;
			$no2=0;
			foreach ($listAlternatif as $alt2){ 
				$no2++;
				if($no1 <> $no2){
					$no3=0;
					foreach ($listAlternatif as $alt3){ 
						$no3++;
					}
					
					$no3=0;
					$noHPerband = 0;
					$rangeHPerband = "";
					$totalBobot = 0;
					foreach ($listAlternatif as $key_alt => $alt3){ 
						$no3++;
						$noHPerband++;
						
						$param1 = "baris".$no1."_"."kolom".$no3;
						$perbad1 = $this->m_electre->getBobotPembNorm($param1);
						
						$param2 = "baris".$no2."_"."kolom".$no3;
						$perbad2 = $this->m_electre->getBobotPembNorm($param2);
						
						if($perbad1['bobot'] >= $perbad2['bobot']){
							$getKriteria = $this->m_kriteria->getKriteriaById($noHPerband);
							
							$totalBobot += $getKriteria['bobot'];
							$rangeHPerband .= $noHPerband.",";
						}
					}
					$insertConcordance = array(
						"kolom"		=> "C".$no1.",".$no2 ,
						"bobot"		=> $totalBobot,
						"status"	=> "C"
					);
					$this->db->insert("concordance_discordance", $insertConcordance);
				}
			}
		}
		
		/////////////////////////////// LANGKAH 3B. MENENTUKAN DISCORDANCE //////////////////////
		
		$no1=0;
		
		foreach ($listAlternatif as $alt1){ 
			$no1++;
			$no2=0;
			foreach ($listAlternatif as $alt2){ 
				$no2++;
				if($no1 <> $no2){
					foreach ($listKriteria as $krt){ 
						$getBNorm1 = $this->m_electre->getBobotNormalisasi($alt1['id_lokasi_wisata'],$krt['id_kriteria']);
						$getBNorm2 = $this->m_electre->getBobotNormalisasi($alt2['id_lokasi_wisata'],$krt['id_kriteria']);
						$contoh_param = "A".$alt1['id_lokasi_wisata']."K".$krt['id_kriteria'] ." - ". "A".$alt2['id_lokasi_wisata']."K".$krt['id_kriteria'];
					}
		
					$no3=0;
					$noHPerband = 0;
					$rangeHPerband = "";
					$totalBobot = 0;
					foreach ($listAlternatif as $key_alt => $alt3){ 
						$no3++;
						$noHPerband++;
						
						$param1 = "baris".$no1."_"."kolom".$no3;
						$perbad1 = $this->m_electre->getBobotPembNorm($param1);
						
						$param2 = "baris".$no2."_"."kolom".$no3;
						$perbad2 = $this->m_electre->getBobotPembNorm($param2);
						
						if($perbad1['bobot'] < $perbad2['bobot']){
							$getKriteria = $this->m_kriteria->getKriteriaById($noHPerband);
							$totalBobot += $getKriteria['bobot'];
							$rangeHPerband .= $noHPerband.",";
						}
					}
					
					$insertDiscordace = array(
						"kolom"		=> "D".$no1.",".$no2 ,
						"bobot"		=> $totalBobot,
						"status"	=> "D"
					);
					
					$this->db->insert("concordance_discordance", $insertDiscordace);
				}
			}
		}
		
		//////////////////////////////// LANGKAH 4.A Menentukan Concordance///////////////////////
		
		$no1=0;
		foreach ($listAlternatif as $alt1){ 
			$no1++;					
			$no2=0;
			foreach ($listAlternatif as $alt2){ 
				$no2++;
				$param = "D".$no1.",".$no2;
				if($no1 == $no2){
					$bobot = "-";
				}else{
					$getBobot = $this->m_electre->getBobotDC($param);
					$bobot = $getBobot['bobot'];
				}									
			}
		}
		
		//////////////////////////////// LANGKAH 4.B Menentukan DISCORDANCE///////////////////////
		
		$no1=0;
		foreach ($listAlternatif as $alt1){ 
			$no1++;
			$no2=0;
			foreach ($listAlternatif as $alt2){ 
				$no2++;
				$param = "D".$no1.",".$no2;
				if($no1 == $no2){
					$bobot = "-";
				}else{
					$getBobot = $this->m_electre->getBobotDC($param);
					$bobot = $getBobot['bobot'];
				}
			}
		}
		
		///////////////////// LANGKAH 5. Menentukan Matriks Dominan Concordance dan Disordance ///////////////////
		$getJml = $this->m_electre->getSumBobotDC("C");
		$getCount = $this->m_electre->getCountBobotDC("C");
		
		$getJml = $this->m_electre->getSumBobotDC("D");
		$getCount = $this->m_electre->getCountBobotDC("D");
		
		$no1=0;						
		foreach ($listAlternatif as $alt1){ 
			$no1++;
			$no2=0;
			foreach ($listAlternatif as $alt2){ 
				$no2++;
				$param = "C".$no1.",".$no2;
				if($no1 == $no2){
					$bobot = "-";
					$matriks = "-";
				}else{
					$getBobot = $this->m_electre->getBobotDC($param);
					$bobot = $getBobot['bobot'];
					
					$getJml = $this->m_electre->getSumBobotDC("C");
					$getCount = $this->m_electre->getCountBobotDC("C");
					
					$bagi = $getJml['jml'] / $getCount['jml'];
					
					if($bobot >= $bagi){
						$matriks = 1;
					}else{
						$matriks = 0;
					}
				}									
			}
		}
		
		
		$no1=0;
		foreach ($listAlternatif as $alt1){ 
			$no1++;					
			$no2=0;
			foreach ($listAlternatif as $alt2){ 
				$no2++;
				$param = "D".$no1.",".$no2;
				if($no1 == $no2){
					$bobot = "-";
					$matriks = "-";
				}else{
					$getBobot = $this->m_electre->getBobotDC($param);
					$bobot = $getBobot['bobot'];
					
					$getJml = $this->m_electre->getSumBobotDC("D");
					$getCount = $this->m_electre->getCountBobotDC("D");
					
					$bagi = $getJml['jml'] / $getCount['jml'];
					
					if($bobot >= $bagi){
						$matriks = 1;
					}else{
						$matriks = 0;
					}
				}	
			}
		}
		
		//////////////////////Langkah 6 Menentukan Aggregate Dominance Matriks//////////////////////////////
		
		$no1=0;
		
		foreach ($listAlternatif as $alt1){ 
			$no1++;
			$no2=0;
			foreach ($listAlternatif as $alt2){ 
				$no2++;
				
				$param = "C".$no1.",".$no2;
				$param2 = "D".$no1.",".$no2;
				if($no1 == $no2){
					$bobot = "-";
					$matriks = "-";
					$fxg = "-";
				}else{
					$getBobot = $this->m_electre->getBobotDC($param);
					$bobot = $getBobot['bobot'];
					
					$getJml = $this->m_electre->getSumBobotDC("C");
					$getCount = $this->m_electre->getCountBobotDC("C");
					
					$bagi = $getJml['jml'] / $getCount['jml'];
					
					if($bobot >= $bagi){
						$matriks = 1;
					}else{
						$matriks = 0;
					}
					
					$getBobot2 = $this->m_electre->getBobotDC($param2);
					$bobot2 = $getBobot2['bobot'];
					$getJml2 = $this->m_electre->getSumBobotDC("D");
					//echo $this->db->last_query();die;
					$getCount2 = $this->m_electre->getCountBobotDC("D");
					$bagi2 = $getJml2['jml'] / $getCount2['jml'];
					
					if($bobot2 >= $bagi2){
						$matriks2 = 1;
					}else{
						$matriks2 = 0;
					}
					
					$fxg = $matriks * $matriks2;
					
					$aggregate_dominan = array(
						"alternatif1"	=> $alt1['id_lokasi_wisata'],
						"alternatif2"	=> $alt2['id_lokasi_wisata'],
						"bobot"			=> $fxg
					);
					
					$this->db->insert("aggregate_dominan", $aggregate_dominan);
				}
			}
		}
		
		
		////////////////////////////////Langkah 7 Kesimpulan dan Hasil/////////////////////////////
		$getHA = $this->db->query("SELECT
								*, sum(bobot) jml
							FROM
								aggregate_dominan
							inner join lokasi_wisata on lokasi_wisata.id_lokasi_wisata = aggregate_dominan.alternatif1
							inner join kota on kota.id_kota = lokasi_wisata.id_kota
							WHERE
								bobot <> 0
							GROUP BY alternatif1
							ORDER BY sum(bobot)")->result_array();
		if(!empty($getHA)){
			$data['getHA'] = $getHA; 
		}else{
			$data['getHA'] = $this->m_electre->getNormalisasi();
		}
						
		$data['v_content']	="front/rekomendasi/rekomendasi";
        $this->load->view('front/layout',$data);
		
		/* $data['v_content'] 		= 'member/electre/list';
		$this->load->view('member/layout', $data); */
		
		//redirect('front/rekomendasi/hasil/'.$jenis_wisata);
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
