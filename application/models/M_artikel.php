<?php

class M_artikel extends CI_Model {
    function __construct() {
        parent::__construct(); 
    }

    function getAllCategory(){
        $this->db->select('*');
        $this->db->from('article_category TP');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	 function getAllCategoryActive(){
        $this->db->select('*');
        $this->db->from('article_category TP');
		$this->db->where('IsActive','1');
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getCategoryByID($id){
        $this->db->select('*');
        $this->db->from('article_category TP');
        $this->db->where('TP.ArticleCatID',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }
	
	 function getAllArticle(){
        $this->db->select('TP.*,AC.CategoryName');
        $this->db->from('article TP');
		$this->db->join('article_category as AC','TP.ArticleCatID = AC.ArticleCatID');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	 function getAllArticleActive(){
        $this->db->select('TP.*,AC.CategoryName');
        $this->db->from('article TP');
		$this->db->join('article_category as AC','TP.ArticleCatID = AC.ArticleCatID');
		$this->db->where('TP.IsActive','1');
		$this->db->order_by('TP.ArticleID','desc');
        $que = $this->db->get()->result_array();
        return $que;
    }
	
	function getAllArticleActivelimit(){
        $this->db->select('TP.*,AC.CategoryName');
        $this->db->from('article TP');
		$this->db->join('article_category as AC','TP.ArticleCatID = AC.ArticleCatID');
		$this->db->where('TP.IsActive','1');
		$this->db->order_by('TP.ArticleID','desc');
		$this->db->limit(3);
        $que = $this->db->get()->result_array();
        return $que;
    }

    function getArticleByID($id){
        $this->db->select('TP.*,AC.CategoryName');
        $this->db->from('article TP');
		$this->db->join('article_category as AC','TP.ArticleCatID = AC.ArticleCatID');
        $this->db->where('TP.ArticleID',$id);
        $que = $this->db->get()->result_array();
        return $que[0];
    }   

    
}
