<?php

class M_Check_login extends CI_Model {


    function login($email,$password){
        $this->db->select('*');
        $this->db->from('login as us');
        $this->db->where('us.email', $email);
        $this->db->where('us.password', md5($password));
        $query = $this->db->get()->row_array();
        return $query;
    }


	

		$kodemax = str_pad($kode,2, "0",STR_PAD_LEFT);
		$date = date('dmy');
		//$text = str_replace(' ', '', $kodemax);
		$kodejadi  = $date.$kodemax;
		return $kodejadi;

	}


}
