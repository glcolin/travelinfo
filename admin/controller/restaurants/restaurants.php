<?php 
class ControllerRestaurantsRestaurants extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Restaurants");

		$this->load->model('restaurants/restaurants');

		$this->getList();
		
  	}
	
	protected function getList() {	
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
			unset($this->session->data['success']);
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$url = '';

		$this->template = 'restaurants/restaurants_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$filter_str='';			
		$this->data['category']='';				
		if (isset($this->request->get['category'])) {
			$this->data['category']=$this->request->get['category'];
			$filter_str .= "&category=".$this->request->get['category'];
		}
		
		$categorys = $this->model_restaurants_restaurants->getCategorys();
		$this->data['categorys'] = isset($categorys[1])?$categorys[1]:array();
		
		$data=array(
			'category' => $this->data['category']
		);
		
		$restaurants_total=$this->model_restaurants_restaurants->getTotalRestaurants($data);
		
		$this->data['restaurants'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($restaurants_total as $restaurant) {
			$sort_default[]=$restaurant['id'];
			
			$action = array();

			if ($restaurant['image_url'] && file_exists(DIR_IMAGE.$restaurant['image_url'])) {
				$image = $this->model_tool_image->resize($restaurant['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('restaurants/restaurants/edit', 'restaurant_id=' . $restaurant['id'] . $url)
			);
			
			$this->data['restaurants'][$restaurant['id']]=array(
				"info" => $restaurant,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('restaurants/restaurants/addnew', $url);
		
		$this->data['delete'] = $this->url->link('restaurants/restaurants/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Restaurants"); 
		
		$this->load->model('restaurants/restaurants');
		
		$this->model_restaurants_restaurants->deleteRestaurant($this->request->post);
	  		
		$this->session->data['success'] = "Delete restaurant success!";

		$url = '';
			
		$this->redirect($this->url->link('restaurants/restaurants', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('restaurants/restaurants');
		$this->model_restaurants_restaurants->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Restaurants"); 
		
		$this->load->model('restaurants/restaurants');
		
		$this->model_restaurants_restaurants->addRestaurant($this->request->post);
	  		
		$this->session->data['success'] = "Add restaurant success!";

		$url = '';
			
		$this->redirect($this->url->link('restaurants/restaurants', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add restaurant"); 
		
		$this->load->model('restaurants/restaurants');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('restaurants/restaurants');

    	$this->document->setTitle("Restaurant edit");
		
		$this->load->model('restaurants/restaurants');
		
		$this->session->data['success']="";

    	$this->getForm();
	}	
	
	protected function getForm() {
    	if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$url = '';
							
									
		if (!isset($this->request->get['restaurant_id'])) {
			$this->data['action'] = $this->url->link('restaurants/restaurants/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('restaurants/restaurants/update', 'restaurant_id=' . $this->request->get['restaurant_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('restaurants/restaurants', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('restaurants/restaurants/update', $url);
		
		$restaurant_info=array();	

		if (isset($this->request->get['restaurant_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$restaurant_info = $this->model_restaurants_restaurants->getRestaurant($this->request->get['restaurant_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['restaurant_info']	=	$restaurant_info;
		
		$this->data['categorys']	=  $this->model_restaurants_restaurants->getCategorys();
										
		$this->template = 'restaurants/restaurants_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('restaurants/restaurants', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('restaurants/restaurants');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_restaurants_restaurants->update_restaurant($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('restaurants/restaurants', $url));
		}

	}
  
}
?>
