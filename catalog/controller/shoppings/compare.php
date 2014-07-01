<?php  
class ControllerShoppingsCompare extends Controller {
	public function index() {
		$this->document->setTitle("America Travel Info");
	
		$this->load->model('shoppings/compare');
		
		global $LANGUAGE;
		$this->data['TEXT'] = $LANGUAGE;
		
		$language=$this->session->data['language'];
		
		
		$limit = 10;
		
		//header banner
		$data=array(
			"position"=>"header",
			"language_id"=>$language
		);
		$header_banners = $this->model_shoppings_compare->getBanners($data);
		$this->data['header_banners_link'] = $header_banners?$header_banners[0]['link']:'';
		$this->data['header_banners'] = $header_banners?$header_banners[0]['image_url']:'';
		
		//category
		$this->session->data['class_type'] = "shoppings";
		$this->session->data['class_title'] = "shoppings";
		$data=array(
			"language_id"=>$language
		);
		$categorys = $this->model_shoppings_compare->getCategorys($data);
		$current_category = isset($this->request->get['cid'])?$this->request->get['cid']:"";
		$this->data['current_category'] = $current_category;
		$this->data['category_title'] = "";
		foreach($categorys as $category){
			if($category['item_id']==$current_category){
				$this->data['category_title'] = $category['title'];
			}
		}
		
		//items
		$ids=array();
		if(isset($this->request->get['ids'])){
			$ids = explode(',',$this->request->get['ids']);
		}
		
		$this->session->data['shoppings_ids'] = array();
		
		$data=array(
			"ids" => $ids,
			"language_id"=>$language
		);
		$items = $this->model_shoppings_compare->getItems($data);
	
		$items_result=array();
		foreach($items as $item){
			$item['title_link'] = $item['custom_link']=="yes"?$item['website']:'./index.php?route=shoppings/shopping&cid='.$item['category'].'&item_id='.$item['item_id'];
			$items_result[] = $item;
		}
	
		$this->data['items'] = $items_result;

		$this->template = 'shoppings/compare.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
	}
}
?>