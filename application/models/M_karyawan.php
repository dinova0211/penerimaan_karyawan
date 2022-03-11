<?php

class M_karyawan extends CI_Model {

    function register($data) {
      return $this->db->insert('restorant', $data);
    }

    function login($email,$password){
        $this->db->select('*');
        $this->db->from('login as us');
        $this->db->where('us.email', $email);
        /*$this->db->where('us.password', md5($password));*/
        $query = $this->db->get()->row_array();
        return $query;
    }

    function getDataRestaurant() {
      return $this->db->select('*')
                      ->from('pengguna')
                      ->get()->result_array();
    }



    function getRestaurantbyID($id){
      $this->db->select("*");
      $this->db->from("pengguna");
      $this->db->where("idPengguna",$id);
      $query  = $this->db->get();
      $result = $query->row_array();
      return $result;
    }
	
	function code_otomatis(){
		$this->db->select('Right(idPetugas,2) as kode ',false);
		$this->db->order_by('idPetugas', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('petugas');
		if($query->num_rows()<>0){
			$data = $query->row();
			$kode = intval($data->kode)+1;
		}else{
			$kode = 1;

		}
		$kodemax = str_pad($kode,2, "0",STR_PAD_LEFT);
		$date = date('dmy');
		//$text = str_replace(' ', '', $kodemax);
		$kodejadi  = $date.$kodemax;
		return $kodejadi;

	}
	

	
	public function select_sub_kriteria($id)
	{
	     $this->db->select('idSubKriteria,
	                        namaSubKriteria');
         $this->db->from('subkriteria');
         $this->db->where('idKriteria', $id);
         $query = $this->db->get();
         
         $cb_sub_kriteria='<option>--Pilih Sub Kriteria--</option>';
         foreach ($query->result() as $row)
         {
             $cb_sub_kriteria.='<option value="'.$row->idSubKriteria.'">'.$row->namaSubKriteria.'</option>';
         }
         
         return $cb_sub_kriteria;
	}
	
	public function check_data($v1,$v2,$v3)
	{
	     $this->db->select('count(*) as exist');
         $this->db->from('penilaian');
         $this->db->where('idkriteria', $v2);
         $this->db->where('idsubkriteria', $v3);
         $this->db->where('idpengguna', $v1);
         $query = $this->db->count_all_results();
        
         return $query;
	}
	
	public function check_data_new($v1,$v2,$v3,$v4)
	{
	     $this->db->select('count(*) as exist');
         $this->db->from('penilaian');
         $this->db->where('idkriteria', $v3);
         $this->db->where('idsubkriteria', $v4);
         $this->db->where('idpengguna', $v2);
         $this->db->where('idpenilaian <> ', $v1);
         $query = $this->db->count_all_results();
        
         return $query;
	}
	
	public function getDatapenilaian($id)
	{
	     $this->db->select('a.idpenilaian,
	                        a.idpengguna,
	                        b.namaPengguna,
	                        a.idkriteria,
	                        c.namaKriteria,
	                        a.idsubkriteria,
	                        d.namaSubKriteria,
	                        a.nilai');
         $this->db->from('penilaian a');
         $this->db->join('pengguna b','a.idpengguna=b.idPengguna','left');
         $this->db->join('kriteria c','c.idKriteria=a.idkriteria','left');
         $this->db->join('subkriteria d','d.idsubkriteria=a.idSubKriteria','left');
         $this->db->where('a.idpengguna', $id);
         $query = $this->db->get()->result_array();
        
         return $query;
	}
	
	public function get_edit_penilaian($id)
	{
	    $this->db->select('a.idpenilaian,
	                        a.idpengguna,
	                        b.namaPengguna,
	                        a.idkriteria,
	                        c.namaKriteria,
	                        a.idsubkriteria,
	                        d.namaSubKriteria,
	                        a.nilai');
         $this->db->from('penilaian a');
         $this->db->join('pengguna b','a.idpengguna=b.idPengguna','left');
         $this->db->join('kriteria c','c.idKriteria=a.idkriteria','left');
         $this->db->join('subkriteria d','d.idsubkriteria=a.idSubKriteria','left');
         $this->db->where('a.idpenilaian', $id);
         $query = $this->db->get()->row_array();
        
         return $query;
	}
	
	


}
