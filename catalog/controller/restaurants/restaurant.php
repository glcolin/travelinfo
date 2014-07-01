<?php  
class ControllerRestaurantsRestaurant extends Controller {
	public function index() {
		$this->document->setTitle("America Travel Info");
	
		$this->load->model('restaurants/restaurant');
		
		global $LANGUAGE;
		$this->data['TEXT'] = $LANGUAGE;
		
		$language=$this->session->data['language'];
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$limit = 10;
		
		//header banner
		$data=array(
			"position"=>"header",
			"language_id"=>$language
		);
		$header_banners = $this->model_restaurants_restaurant->getBanners($data);
		$this->data['header_banners_link'] = $header_banners?$header_banners[0]['link']:'';
		$this->data['header_banners'] = $header_banners?$header_banners[0]['image_url']:'';
		
		//category
		$this->session->data['class_type'] = "restaurants";
		$this->session->data['class_title'] = "restaurants";
		$data=array(
			"language_id"=>$language
		);
		$categorys = $this->model_restaurants_restaurant->getCategorys($data);
		$current_category = isset($this->request->get['cid'])?$this->request->get['cid']:"";
		$this->data['current_category'] = $current_category;
		$this->data['category_title'] = "";
		foreach($categorys as $category){
			if($category['item_id']==$current_category){
				$this->data['category_title'] = $category['title'];
			}
		}
		
		//item
		$data=array(
			"item_id"=>$this->request->get['item_id'],
			"language_id"=>$language
		);
		$this->data['item'] = $this->model_restaurants_restaurant->getItem($data);

		$this->template = 'restaurants/restaurant.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
										
		$this->response->setOutput($this->render());
	}
}
?>