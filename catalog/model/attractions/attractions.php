<?php
class ModelAttractionsAttractions extends Model {	
	
	public function getBanners($data=array()){
		$query = $this->db->query("SELECT * from aa_attractions_banners where position='".$data['position']."' and language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getCategorys($data=array()){
		$query = $this->db->query("SELECT item_id,title from aa_attractions_categorys where language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getItems($data=array()){
		$limit = "";
		if(isset($data['start']) && isset($data['limit'])){
			$limit .= " limit ".$data['start'].",".$data['limit'];
		}
		
		$search = "";
		$category_str = "";
		if($data['search']){
			$search .= " and title like '%".$this->db->escape($data['search'])."%' ";
		}
		else if($data['category']){
			$category_str .= " and category='".$this->db->escape($data['category'])."' ";
		}
		
		$query = $this->db->query("SELECT * from aa_attractions where language_id='".$data['language_id']."' ".$category_str.$search." order by sort asc ".$limit);
		$rows=$query->rows;

		return $rows;
	}
}
?>