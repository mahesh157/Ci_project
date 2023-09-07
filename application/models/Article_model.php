<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model{
 
	public function getArticle($ID)
	{
		$this->db->select('articles .*,categories.name as category_name');
		$this->db->where('articles.ID',$ID);

		$this->db->join('categories','categories.categories_ID = articles.category','left');
		

		$query=$this->db->get('articles');
		$article=$query->row_array();
		return $article;
	
	}
    public function getArticles($param = array())
	{
		if(isset($param['offset']) && isset($param['limit'])){
		$this->db->limit($param['offset'],$param['limit']);
		}
		// serach bar
		if(isset($param['q'])){
			$this->db->or_like('title',trim($param['q']));
			$this->db->or_like('author',trim($param['q']));
		}
		
	       $query=$this->db->get('articles');
	       $articles=$query->result_array();
	       return $articles;
	
	}
	public function getArticlescount($param = array())
	{
		  
			if(isset($param['q'])){
				$this->db->or_like('title',trim($param['q']));
				$this->db->or_like('author',trim($param['q']));
			}
			if (isset($param['category_ID'])){
             $this->db->where('category',$param['category_ID']);

			}
			
	     $count=$this->db->count_all_results('articles');
       // echo $this->db->last_query();
	         return $count;
	
	}

// this method will save the article 
     public function addArticle($formArray)
	{
        $this->db->insert('articles',$formArray);
        return$this->db->insert_id();
	}
    public function updateArticle($ID,$formArray)
	{
	$this->db->where('ID',$ID);
	$this->db->update('articles',$formArray);
	}
    public function deleteArticle($ID)
	{
		$this->db->where('ID',$ID);
		$this->db->delete('articles');
	}
	  // front method 
	  public function getArticlesFront($param = array())
	  {
		  if(isset($param['offset']) && isset($param['limit'])){
		  $this->db->limit($param['offset'],$param['limit']);
		  }
		  // serach bar
		  if(isset($param['q'])){
			  $this->db->or_like('title',trim($param['q']));
			  $this->db->or_like('author',trim($param['q']));
		  }
		  if (isset($param['category_ID'])){
			$this->db->where('category',$param['category_ID']);

		   }
		  
		    $this->db->select('articles.* ,categories.name as category_name');
            $this->db->where('articles.status',1);

		    $this->db->order_by('articles. create_at','DESC');

			$this->db->join('categories','categories.categories_ID=articles.category','left');

			 $query=$this->db->get('articles');
			 $articles=$query->result_array();
			 //echo $this->db->last_query();
			 return $articles;
	  
	  }
   
}
?>
