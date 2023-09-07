<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model{

	public function create($fromArray)
	{
	$this->db->insert('comments',$fromArray);
	}
	public function getComments($article_id)
	{

		$this->db->where('article_id',$article_id,$status=null);
		if($status == true){
			$this->db->where('status',1);
		}
		$this->db->order_by('create_at','DESC');
		$comments=$this->db->get('comments')->result_array();
	 // $this->db->last_query();
		return$comments;

	}
}
?>