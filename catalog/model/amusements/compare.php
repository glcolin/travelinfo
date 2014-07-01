<?php
class ModelAmusementsCompare extends Model {	
	
	public function getBanners($data=array()){
		$query = $this->db->query("SELECT * from aa_amusements_banners where position='".$data['position']."' and language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getCategorys($data=array()){
		
		$query = $this->db->query("SELECT item_id,title from aa_amusements_categorys where language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getItems($data=array()){
		$ids_str = implode("','",$data['ids']);
		
		$query = $this->db->query("SELECT * from aa_amusements where language_id='".$data['language_id']."' and item_id in ('".$ids_str."') limit 3");
		$rows=$query->rows;

		return $rows;
	}
}
?>