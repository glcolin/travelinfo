<?php 
class ControllerCruisesCruises extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Cruises");

		$this->load->model('cruises/cruises');

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

		$this->template = 'cruises/cruises_list.tpl';
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
		
		$categorys = $this->model_cruises_cruises->getCategorys();
		$this->data['categorys'] = isset($categorys[1])?$categorys[1]:array();
		
		$data=array(
			'category' => $this->data['category']
		);
		
		$cruises_total=$this->model_cruises_cruises->getTotalCruises($data);
		
		$this->data['cruises'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($cruises_total as $cruise) {
			$sort_default[]=$cruise['id'];
			
			$action = array();

			if ($cruise['image_url'] && file_exists(DIR_IMAGE.$cruise['image_url'])) {
				$image = $this->model_tool_image->resize($cruise['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('cruises/cruises/edit', 'cruise_id=' . $cruise['id'] . $url)
			);
			
			$this->data['cruises'][$cruise['id']]=array(
				"info" => $cruise,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('cruises/cruises/addnew', $url);
		
		$this->data['delete'] = $this->url->link('cruises/cruises/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Cruises"); 
		
		$this->load->model('cruises/cruises');
		
		$this->model_cruises_cruises->deleteCruise($this->request->post);
	  		
		$this->session->data['success'] = "Delete cruise success!";

		$url = '';
			
		$this->redirect($this->url->link('cruises/cruises', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('cruises/cruises');
		$this->model_cruises_cruises->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Cruises"); 
		
		$this->load->model('cruises/cruises');
		
		$this->model_cruises_cruises->addCruise($this->request->post);
	  		
		$this->session->data['success'] = "Add cruise success!";

		$url = '';
			
		$this->redirect($this->url->link('cruises/cruises', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add cruise"); 
		
		$this->load->model('cruises/cruises');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('cruises/cruises');

    	$this->document->setTitle("Cruise edit");
		
		$this->load->model('cruises/cruises');
		
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
							
									
		if (!isset($this->request->get['cruise_id'])) {
			$this->data['action'] = $this->url->link('cruises/cruises/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('cruises/cruises/update', 'cruise_id=' . $this->request->get['cruise_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('cruises/cruises', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('cruises/cruises/update', $url);
		
		$cruise_info=array();	

		if (isset($this->request->get['cruise_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$cruise_info = $this->model_cruises_cruises->getCruise($this->request->get['cruise_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['cruise_info']	=	$cruise_info;
		
		$this->data['categorys']	=  $this->model_cruises_cruises->getCategorys();
										
		$this->template = 'cruises/cruises_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('cruises/cruises', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('cruises/cruises');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_cruises_cruises->update_cruise($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('cruises/cruises', $url));
		}

	}
  
}
?>
