<?php

class ModelArticlesArticles extends Model {


	public function getArticles(){

		$query = $this->db->query("SELECT * FROM aa_articles WHERE language_id = 1");
		$rows=$query->rows;

		return $rows;

	}

	
	public function getArticle($id) {
		$query = $this->db->query("SELECT * FROM aa_articles WHERE item_id=".$id);
		$rows=$query->rows;
		$result=array();
		foreach($rows as $row){
			$result[$row['language_id']]=$row;
		}
				
		return $result;
	}

	
	public function updateArticle($data=array()){
		
		$languages = $this->session->data['languages'];
		
		$query=$this->db->query("select item_id from aa_articles where item_id=".$data['article_id']);
		$row=$query->row;
		$item_id=$row['item_id'];
		
		foreach($languages as $language){
			$query2=$this->db->query("select id from aa_articles where item_id=".$row['item_id']." and language_id=".$language['language_id']);
			if($query2->row){
				$this->db->query("update aa_articles set 
				content='".$this->db->escape($data['article_content'][$language['language_id']])."'		 
				where item_id=".$item_id." and language_id=".$language['language_id']);
			}
		}
	}











}