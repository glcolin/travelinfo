<?php
class ModelHomeAdvertisements extends Model {
	
	public function getTotalAdvertisements($data = array()){
		$query = $this->db->query("SELECT * from aa_home_advertisements where language_id=1 order by sort asc,update_date desc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getAdvertisement($id) {
		$query = $this->db->query("SELECT * from aa_home_advertisements where item_id=".$id);
		$rows=$query->rows;
		$result=array();
		foreach($rows as $row){
			$result[$row['language_id']]=$row;
		}
				
		return $result;
	}
	
	public function addAdvertisement($data=array()){
	// print_r($data);
		
		$languages = $this->session->data['languages'];
		
		$i=1;
		$item_id=0;
		foreach($languages as $language){
			if($i==1){
				$this->insert_action($data,$language,$item_id);
				$item_id=mysql_insert_id() ;
				$this->db->query("update aa_home_advertisements set item_id=".$item_id." where  id=".$item_id);
			}
			else{
				$this->insert_action($data,$language,$item_id);
			}
			$i++;
		}
	}
	
	public function deleteAdvertisement($data=array()){
		foreach($data['selected'] as $id){
			$query=$this->db->query("select item_id from aa_home_advertisements where id=".$id);
			$row=$query->row;
			$this->db->query("delete from aa_home_advertisements where item_id=".$row['item_id']);
		}
	}
	
	public function update_advertisement($data=array()){
		
		$languages = $this->session->data['languages'];
		
		$query=$this->db->query("select item_id from aa_home_advertisements where id=".$data['advertisement_id']);
		$row=$query->row;
		$item_id=$row['item_id'];
		
		foreach($languages as $language){
			$query2=$this->db->query("select id from aa_home_advertisements where item_id=".$row['item_id']." and language_id=".$language['language_id']);
			if($query2->row){
				$this->db->query("update aa_home_advertisements set 
				title='".$this->db->escape($data['advertisement_title'][$language['language_id']])."',
				link='".$this->db->escape($data['advertisement_link'][$language['language_id']])."',
				image_url='".$data['advertisement_image'][$language['language_id']]."',
				update_date=now()  
				where item_id=".$item_id." and language_id=".$language['language_id']);
			}
			else{
				$this->insert_action($data,$language,$item_id);
			}
		}
	}
	
	public function insert_action($data,$language,$item_id){
		$this->db->query("insert into aa_home_advertisements (item_id,title,link,image_url,language_id,create_date,update_date) values ('".
		$item_id."','".
		$this->db->escape($data['advertisement_title'][$language['language_id']])."','".
		$this->db->escape($data['advertisement_link'][$language['language_id']])."','".
		$data['advertisement_image'][$language['language_id']]."','".
		$language['language_id']."',now(),now())");
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));
		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_home_advertisements set sort='".$key."' where item_id='".$id."'");
		
		}
	}
}
?>
