<?php 
class ControllerToursCategorys extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Category");

		$this->load->model('tours/categorys');

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

		$this->template = 'tours/categorys_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$data = array();
		
		$data=array(
			
		);
		
		$categorys_total=$this->model_tours_categorys->getTotalCategorys($data);
		
		$this->data['categorys'] = array();
		
		foreach ($categorys_total as $category) {
			$sort_default[]=$category['item_id'];
			
			$action = array();
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('tours/categorys/edit', 'category_id=' . $category['item_id'] . $url)
			);
			
			$this->data['categorys'][$category['item_id']]=array(
				"info" => $category,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('tours/categorys/addnew', $url);
		
		$this->data['delete'] = $this->url->link('tours/categorys/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Category"); 
		
		$this->load->model('tours/categorys');
		
		$this->model_tours_categorys->deleteCategory($this->request->post);
	  		
		$this->session->data['success'] = "Delete category success!";

		$url = '';
			
		$this->redirect($this->url->link('tours/categorys', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('tours/categorys');
		$this->model_tours_categorys->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Categorys"); 
		
		$this->load->model('tours/categorys');
		
		$this->model_tours_categorys->addCategory($this->request->post);
	  		
		$this->session->data['success'] = "Add category success!";

		$url = '';
			
		$this->redirect($this->url->link('tours/categorys', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add Category"); 
		
		$this->load->model('tours/categorys');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('tours/categorys');

    	$this->document->setTitle("Category edit");
		
		$this->load->model('tours/categorys');
		
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
							
									
		if (!isset($this->request->get['category_id'])) {
			$this->data['action'] = $this->url->link('tours/categorys/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('tours/categorys/update', 'category_id=' . $this->request->get['category_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('tours/categorys', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('tours/categorys/update', $url);
		
		$category_info=array();	

		if (isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$category_info = $this->model_tours_categorys->getCategory($this->request->get['category_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['category_info']	=	$category_info;
										
		$this->template = 'tours/categorys_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('tours/categorys', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('tours/categorys');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_tours_categorys->update_category($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('tours/categorys', $url));
		}

	}
  
}
?>
