<?php

class M_landing_page extends CI_Model {


    function login($email,$password){
        $this->db->select('*');
        $this->db->from('login as us');
        $this->db->where('us.email', $email);
        $this->db->where('us.password', md5($password));
        $query = $this->db->get()->row_array();
        return $query;
    }




}
