<?php

class ModelArticlesArticles extends Model {

	
	public function getArticle($id) {
		$query = $this->db->query("SELECT * FROM aa_articles WHERE item_id=".$id);
		$rows=$query->rows;
		$result=array();
		foreach($rows as $row){
			$result[$row['language_id']]=$row;
		}
				
		return $result;
	}




}