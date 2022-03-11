<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('M_artikel');
		$this->load->library("ckeditor");
    }

    public function daftar(){
        $data['userLogin'] = $this->session->userdata('loginData'); 
        $data['listData'] = $this->M_artikel->getAllArticle();
        $data['v_content'] = 'member/artikel/list';
        $this->load->view('member/layout', $data);

    }
	

    public function add(){
        $data['userLogin'] = $this->session->userdata('loginData');
		$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
            array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
        );
		$this->ckeditor->config['width'] = '676px';
        $this->ckeditor->config['height'] = '270px';
        $data['listData'] = $this->M_artikel->getAllCategoryActive();
        $data['v_content'] = 'member/artikel/add';
        $this->load->view('member/layout', $data);
        
    }

    public function doAdd(){
        $post = $this->input->post();
		$dataToInsert = array(  "ArticleSubject" => $post['txtArticleSubject'],
								"ArticleContent" => $post['txtArticleContent'],
								"ArticleCatID" => $post['txtArticleCatID'],
								"IsActive" => '1',
								"created_at" => date('Y-m-d'));

		if($this->db->insert('article',$dataToInsert)){

		$this->m_umum->generatePesan("Berhasil menambahkan artikel","berhasil");
		
		}else{
		
		$this->m_umum->generatePesan("Gagal menambahkan artikel","gagal");
			
		}
		redirect('admin/artikel/add');
    }

    public function doDelete($id){
        $hapus = $this->db->delete('article',array('ArticleID' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus artikel","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus artikel","gagal");   
        }
        redirect('admin/artikel/daftar');
    }

    public function edit($id){
        $dataartikel = $this->M_artikel->getArticleByID($id);
        if(count($dataartikel)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan artikel dengan ID tsb","gagal"); 
            redirect('admin/artikel/daftar');
        }else{
			$this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
			$this->ckeditor->config['toolbar'] = array(
				array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
			);
			$this->ckeditor->config['width'] = '676px';
			$this->ckeditor->config['height'] = '270px';
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $dataartikel;
			$data['listData'] = $this->M_artikel->getAllCategoryActive();
            $data['v_content'] = 'member/artikel/edit';
            $this->load->view('member/layout', $data);
        }
    }
 
    public function doEdit($id){
            $post = $this->input->post();
            $dataToInsert = array(  "ArticleSubject" => $post['txtArticleSubject'],
									"ArticleContent" => $post['txtArticleContent'],
									"ArticleCatID" => $post['txtArticleCatID'],
									"IsActive" => $post['txtStatus'],
									"created_at" => date('Y-m-d'));
            if($this->db->update('article',$dataToInsert,array('ArticleID' => $id))){
				$this->m_umum->generatePesan("Berhasil update artikel","berhasil");           
            }else{           
				$this->m_umum->generatePesan("Gagal update artikel","gagal");    
            }
            redirect('admin/artikel/edit/'.$id);
    }
//-------------------------------------------------------------
	public function kategori(){
		$data['userLogin'] = $this->session->userdata('loginData'); 
		$data['listData'] = $this->M_artikel->getAllCategory();
		$data['v_content'] = 'member/artikel/listKategori';
		$this->load->view('member/layout', $data);

    }

    public function addKategori(){
        $data['userLogin'] = $this->session->userdata('loginData');
        $data['v_content'] = 'member/artikel/addKategori';
        $this->load->view('member/layout', $data);
        
    }

    public function doAddKategori(){
        $post = $this->input->post();   
		$dataToInsert = array(  "CategoryName" => $post['txtKategori'],
								"IsActive" => '1',
								"created_at" => date('Y-m-d'));

		if($this->db->insert('article_category',$dataToInsert)){

		$this->m_umum->generatePesan("Berhasil menambahkan kategori","berhasil");
		
		}else{
		
		$this->m_umum->generatePesan("Gagal menambahkan kategori","gagal");
			
		}
		redirect('admin/artikel/addKategori');
    }

    public function doDeleteKategori($id){
        $hapus = $this->db->delete('article_category',array('ArticleCatID' => $id));
        if($hapus){
          $this->m_umum->generatePesan("Berhasil menghapus kategori","berhasil");  
        }else{
           $this->m_umum->generatePesan("Gagal menghapus kategori","gagal");   
        }
        redirect('admin/artikel/kategori');
    }

    public function editKategori($id){
        $datakategori = $this->M_artikel->getCategoryByID($id);
        if(count($datakategori)==0){
            $this->m_umum->generatePesan("Tidak dapat menemukan kategori dengan ID tsb","gagal"); 
            redirect('admin/artikel/kategori');
        }else{
            $data['userLogin'] = $this->session->userdata('loginData');
            $data['dataDetail'] = $datakategori;
            $data['v_content'] = 'member/artikel/editKategori';
            $this->load->view('member/layout', $data);
        }
    }

    public function doEditKategori($id){
            $post = $this->input->post();
            $dataToInsert = array(  "CategoryName" => $post['txtKategori'],
									"IsActive" => $post['txtStatus']);
            if($this->db->update('article_category',$dataToInsert,array('ArticleCatID' => $id))){
				$this->m_umum->generatePesan("Berhasil update kategori","berhasil");           
            }else{           
				$this->m_umum->generatePesan("Gagal update kategori","gagal");    
            }
            redirect('admin/artikel/editKategori/'.$id);
    }
	

}