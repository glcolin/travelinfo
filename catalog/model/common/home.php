<?php
class ModelCommonHome extends Model {	
	
	public function getAdvertisements($data=array()){
		$query = $this->db->query("SELECT * from aa_home_advertisements where language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getBanners($data=array()){
		$query = $this->db->query("SELECT * from aa_home_banners where position='".$data['position']."' and language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getClassItems($data=array()){
		$query = $this->db->query("SELECT * from aa_".$data['class_type']." where language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;
		
		return $rows;
	}
}
?>