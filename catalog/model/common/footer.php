<?php
class ModelCommonFooter extends Model {	
	
	public function getFriendlinks($data=array()){
		$query = $this->db->query("SELECT * from aa_home_friendlinks where language_id='".$data['language_id']."' order by sort,update_date asc");
		$rows=$query->rows;
		
		return $rows;
	}
}
?>