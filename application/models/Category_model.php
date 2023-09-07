<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model{

    public function create($formArray) {
        $this->db->insert('categories',$formArray);
	}
    public function getCategories($params=[]){
        if(!empty($params['queryString'])){
            $this->db->like('name',$params['queryString']);
        }
        $reuslt= $this->db->get('categories')->result_array();
        //echo $this->db->last_query();
       return  $reuslt;
    }
    public function getCategory($categories_ID){
        $this->db->where('categories_ID',$categories_ID);
       $category=$this->db->get('categories')->row_array();
       return  $category;

    }

    public function update($categories_ID,$formArray){
       $this->db->where('categories_ID',$categories_ID);
       $this->db->update('categories',$formArray);
    }

    public function delete($categories_ID){
     $this->db->where('categories_ID',$categories_ID);
     $this->db->delete('categories');
    }

    // front function 
    public function getCategoriesfront($params=[]){
        $this->db->where('categories.status',1);
        $reuslt= $this->db->get('categories')->result_array();
        //echo $this->db->last_query();
       return  $reuslt;
    }
}