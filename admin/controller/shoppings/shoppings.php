<?php 
class ControllerShoppingsShoppings extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Shopping addresses");

		$this->load->model('shoppings/shoppings');

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

		$this->template = 'shoppings/shoppings_list.tpl';
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
		
		$categorys = $this->model_shoppings_shoppings->getCategorys();
		$this->data['categorys'] = isset($categorys[1])?$categorys[1]:array();
		
		$data=array(
			'category' => $this->data['category']
		);
		
		$shoppings_total=$this->model_shoppings_shoppings->getTotalShoppings($data);
		
		$this->data['shoppings'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($shoppings_total as $shopping) {
			$sort_default[]=$shopping['id'];
			
			$action = array();

			if ($shopping['image_url'] && file_exists(DIR_IMAGE.$shopping['image_url'])) {
				$image = $this->model_tool_image->resize($shopping['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('shoppings/shoppings/edit', 'shopping_id=' . $shopping['id'] . $url)
			);
			
			$this->data['shoppings'][$shopping['id']]=array(
				"info" => $shopping,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('shoppings/shoppings/addnew', $url);
		
		$this->data['delete'] = $this->url->link('shoppings/shoppings/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Shopping addresses"); 
		
		$this->load->model('shoppings/shoppings');
		
		$this->model_shoppings_shoppings->deleteShopping($this->request->post);
	  		
		$this->session->data['success'] = "Delete shopping success!";

		$url = '';
			
		$this->redirect($this->url->link('shoppings/shoppings', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('shoppings/shoppings');
		$this->model_shoppings_shoppings->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Shopping addresses"); 
		
		$this->load->model('shoppings/shoppings');
		
		$this->model_shoppings_shoppings->addShopping($this->request->post);
	  		
		$this->session->data['success'] = "Add shopping success!";

		$url = '';
			
		$this->redirect($this->url->link('shoppings/shoppings', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add shopping address"); 
		
		$this->load->model('shoppings/shoppings');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('shoppings/shoppings');

    	$this->document->setTitle("Shopping address edit");
		
		$this->load->model('shoppings/shoppings');
		
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
							
									
		if (!isset($this->request->get['shopping_id'])) {
			$this->data['action'] = $this->url->link('shoppings/shoppings/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('shoppings/shoppings/update', 'shopping_id=' . $this->request->get['shopping_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('shoppings/shoppings', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('shoppings/shoppings/update', $url);
		
		$shopping_info=array();	

		if (isset($this->request->get['shopping_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$shopping_info = $this->model_shoppings_shoppings->getShopping($this->request->get['shopping_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['shopping_info']	=	$shopping_info;
		
		$this->data['categorys']	=  $this->model_shoppings_shoppings->getCategorys();
										
		$this->template = 'shoppings/shoppings_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('shoppings/shoppings', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('shoppings/shoppings');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_shoppings_shoppings->update_shopping($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('shoppings/shoppings', $url));
		}

	}
  
}
?>
