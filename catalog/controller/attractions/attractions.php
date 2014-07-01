<?php  
class ControllerAttractionsAttractions extends Controller {
	public function index() {
		$this->document->setTitle("America Travel Info");
	
		$this->load->model('attractions/attractions');
		
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
		$header_banners = $this->model_attractions_attractions->getBanners($data);
		$this->data['header_banners_link'] = $header_banners?$header_banners[0]['link']:'';
		$this->data['header_banners'] = $header_banners?$header_banners[0]['image_url']:'';
		
		//category
		$this->session->data['class_type'] = "attractions";
		$this->session->data['class_title'] = "attractions";
		$data=array(
			"language_id"=>$language
		);
		$categorys = $this->model_attractions_attractions->getCategorys($data);
		$current_category = isset($this->request->get['cid'])?$this->request->get['cid']:"";
		$this->data['current_category'] = $current_category;
		$this->data['category_title'] = "";
		foreach($categorys as $category){
			if($category['item_id']==$current_category){
				$this->data['category_title'] = $category['title'];
			}
		}
		
		//items
		$search="";
		if(isset($this->request->get['search'])){
			$search = $this->request->get['search'];
		}
		
		$data=array(
			"category"=>$current_category,
			"language_id"=>$language,
			"search"=>$search,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		$items = $this->model_attractions_attractions->getItems($data);
		$data=array(
			"category"=>$current_category,
			"search"=>$search,
			"language_id"=>$language
			
		);
		$items_total = $this->model_attractions_attractions->getItems($data);
		$this->data['items'] = $items;
		$items_count=count($items_total);
		
		//pagination
		$route = $this->request->get['route'];
		
		$pagination = new Pagination();
		$pagination->total = $items_count;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link($route, 'cid='.$current_category.'&page={page}', 'SSL');
		$this->data['pagination'] = $pagination->render();

		$this->template = 'attractions/attractions.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
										
		$this->response->setOutput($this->render());
	}
}
?>