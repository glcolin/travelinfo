<?php 
class ControllerAttractionsAttractions extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Attractions");

		$this->load->model('attractions/attractions');

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

		$this->template = 'attractions/attractions_list.tpl';
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
		
		$data=array(
			'category' => $this->data['category']
		);
		
		$attractions_total=$this->model_attractions_attractions->getTotalAttractions($data);
		
		$this->data['attractions'] = array();
		
		$categorys = $this->model_attractions_attractions->getCategorys();
		$this->data['categorys'] = isset($categorys[1])?$categorys[1]:array();

		$this->load->model('tool/image');
		
		foreach ($attractions_total as $attraction) {
			$sort_default[]=$attraction['id'];
			
			$action = array();

			if ($attraction['image_url'] && file_exists(DIR_IMAGE.$attraction['image_url'])) {
				$image = $this->model_tool_image->resize($attraction['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('attractions/attractions/edit', 'attraction_id=' . $attraction['id'] . $url)
			);
			
			$this->data['attractions'][$attraction['id']]=array(
				"info" => $attraction,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('attractions/attractions/addnew', $url);
		
		$this->data['delete'] = $this->url->link('attractions/attractions/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Attractions"); 
		
		$this->load->model('attractions/attractions');
		
		$this->model_attractions_attractions->deleteAttraction($this->request->post);
	  		
		$this->session->data['success'] = "Delete attraction success!";

		$url = '';
			
		$this->redirect($this->url->link('attractions/attractions', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('attractions/attractions');
		$this->model_attractions_attractions->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Attractions"); 
		
		$this->load->model('attractions/attractions');
		
		$this->model_attractions_attractions->addAttraction($this->request->post);
	  		
		$this->session->data['success'] = "Add attraction success!";

		$url = '';
			
		$this->redirect($this->url->link('attractions/attractions', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add attraction"); 
		
		$this->load->model('attractions/attractions');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('attractions/attractions');

    	$this->document->setTitle("Attraction edit");
		
		$this->load->model('attractions/attractions');
		
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
							
									
		if (!isset($this->request->get['attraction_id'])) {
			$this->data['action'] = $this->url->link('attractions/attractions/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('attractions/attractions/update', 'attraction_id=' . $this->request->get['attraction_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('attractions/attractions', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('attractions/attractions/update', $url);
		
		$attraction_info=array();	

		if (isset($this->request->get['attraction_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$attraction_info = $this->model_attractions_attractions->getAttraction($this->request->get['attraction_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['attraction_info']	=	$attraction_info;
		
		$this->data['categorys']	=  $this->model_attractions_attractions->getCategorys();
										
		$this->template = 'attractions/attractions_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('attractions/attractions', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('attractions/attractions');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_attractions_attractions->update_attraction($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('attractions/attractions', $url));
		}

	}
  
}
?>
