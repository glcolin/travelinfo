<?php  
class ControllerHotelsCompare extends Controller {
	public function index() {
		$this->document->setTitle("America Travel Info");
	
		$this->load->model('hotels/compare');
		
		global $LANGUAGE;
		$this->data['TEXT'] = $LANGUAGE;
		
		$language=$this->session->data['language'];
		
		
		$limit = 10;
		
		//header banner
		$data=array(
			"position"=>"header",
			"language_id"=>$language
		);
		$header_banners = $this->model_hotels_compare->getBanners($data);
		$this->data['header_banners_link'] = $header_banners?$header_banners[0]['link']:'';
		$this->data['header_banners'] = $header_banners?$header_banners[0]['image_url']:'';
		
		//category
		$this->session->data['class_type'] = "hotels";
		$this->session->data['class_title'] = "hotels";
		$data=array(
			"language_id"=>$language
		);
		$categorys = $this->model_hotels_compare->getCategorys($data);
		$current_category = isset($this->request->get['cid'])?$this->request->get['cid']:"";
		$this->data['current_category'] = $current_category;
		$this->data['category_title'] = "";
		foreach($categorys as $category){
			if($category['item_id']==$current_category){
				$this->data['category_title'] = $category['title'];
			}
		}
		
		//items
		//$this->session->data['hotels_ids'] = array("18","21");
		$ids=array();
		if(isset($this->request->get['ids'])){
			$ids = explode(',',$this->request->get['ids']);
		}
		
		$this->session->data['hotels_ids'] = array();
		
		$data=array(
			"ids" => $ids,
			"language_id"=>$language
		);
		$items = $this->model_hotels_compare->getItems($data);
	
		$items_result=array();
		foreach($items as $item){
			$item['title_link'] = $item['custom_link']=="yes"?$item['website']:'./index.php?route=hotels/hotel&cid='.$item['category'].'&item_id='.$item['item_id'];
			$items_result[] = $item;
		}
	
		$this->data['items'] = $items_result;

		$this->template = 'hotels/compare.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
	}
}
?>