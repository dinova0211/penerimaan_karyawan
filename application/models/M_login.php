<?php

class M_login extends CI_Model {

    function checkLogin($email,$password){
        $this->db->select('*');
        $this->db->from('petugas');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $query = $this->db->get();

        if($query->num_rows()>0){
            $querycheck = $query->result();

            $dataArr = array(
				'UserID'	=> $querycheck[0]->idPetugas,
				'NIP'		=> "",
				'NamaUser'	=> $querycheck[0]->namaPetugas,
				'foto'		=> $querycheck[0]->foto,
				'lvl'		=> $querycheck[0]->level
			);
            
            $this->session->set_userdata('loginData',$dataArr);
            return true;    
        }else{
            $this->session->set_flashdata('GagalLogin', 'Ya');    
            return false;
        }  
    }
	
	function checkLogin_dosen($email,$password){
		$this->db->select('*');
        $this->db->from('petugas');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        // $this->db->where('is_active',1);
        $query = $this->db->get();

        if($query->num_rows()>0){
            $querycheck = $query->result();

            $dataArr = array(
				'UserID'	=> $querycheck[0]->id,
				'NIP'		=> $querycheck[0]->nip,
				'NamaUser'	=> $querycheck[0]->nama,
				'foto'		=> $querycheck[0]->foto,
				'lvl'		=> "99"
			);
            
            $this->session->set_userdata('loginData',$dataArr);
            return true;    
        }else{
            $this->session->set_flashdata('GagalLogin', 'Ya');    
            return false; 
        }  
	}
	
	function check_email_dosen($email){
		$this->db->select('*');
        $this->db->from('dosen');
        $this->db->where('email', $email);
        $query = $this->db->get();
		$result= $query->num_rows();
		return $result;
	}
	
	function check_email_petugas($email){
		$this->db->select('*');
        $this->db->from('petugas');
        $this->db->where('email', $email);
        $query = $this->db->get();
		$result= $query->num_rows();
		return $result;
	}
	
	public function checkLoginApps($username,$password){
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function checkusername($username){
        $this->db->select('count(*) hitung');
        $this->db->from('pengguna');
        $this->db->where('username', $username);
		$query = $this->db->get();
		$result = $query->row()->hitung;
		return $result;
	}
}