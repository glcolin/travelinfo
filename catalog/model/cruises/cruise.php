<?php
class ModelCruisesCruise extends Model {	
	
	public function getBanners($data=array()){
		$query = $this->db->query("SELECT * from aa_cruises_banners where position='".$data['position']."' and language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getCategorys($data=array()){
		$query = $this->db->query("SELECT item_id,title from aa_cruises_categorys where language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getItem($data=array()){
		$query = $this->db->query("SELECT * from aa_cruises where language_id='".$data['language_id']."' and item_id='".$data['item_id']."' ");
		$row=$query->row;

		return $row;
	}
}
?>