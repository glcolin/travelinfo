<?php
class ModelCommonColumnLeft extends Model {	
	
	public function getCategorys($data=array()){
		$query = $this->db->query("SELECT distinct(item_id),title from aa_".$data['class_type']."_categorys where language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getBanners($data=array()){
		$query = $this->db->query("SELECT * from aa_".$data['class_type']."_banners where position='".$data['position']."' and language_id='".$data['language_id']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
}
?>