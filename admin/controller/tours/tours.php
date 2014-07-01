<?php 
class ControllerToursTours extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Tours");

		$this->load->model('tours/tours');

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

		$this->template = 'tours/tours_list.tpl';
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
		
		$categorys = $this->model_tours_tours->getCategorys();
		$this->data['categorys'] = isset($categorys[1])?$categorys[1]:array();
		
		$data=array(
			'category' => $this->data['category']
		);
		
		$tours_total=$this->model_tours_tours->getTotalTours($data);
		
		$this->data['tours'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($tours_total as $tour) {
			$sort_default[]=$tour['id'];
			
			$action = array();

			if ($tour['image_url'] && file_exists(DIR_IMAGE.$tour['image_url'])) {
				$image = $this->model_tool_image->resize($tour['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('tours/tours/edit', 'tour_id=' . $tour['id'] . $url)
			);
			
			$this->data['tours'][$tour['id']]=array(
				"info" => $tour,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('tours/tours/addnew', $url);
		
		$this->data['delete'] = $this->url->link('tours/tours/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Tours"); 
		
		$this->load->model('tours/tours');
		
		$this->model_tours_tours->deleteTour($this->request->post);
	  		
		$this->session->data['success'] = "Delete tour success!";

		$url = '';
			
		$this->redirect($this->url->link('tours/tours', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('tours/tours');
		$this->model_tours_tours->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Tours"); 
		
		$this->load->model('tours/tours');
		
		$this->model_tours_tours->addTour($this->request->post);
	  		
		$this->session->data['success'] = "Add tour success!";

		$url = '';
			
		$this->redirect($this->url->link('tours/tours', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add tour"); 
		
		$this->load->model('tours/tours');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('tours/tours');

    	$this->document->setTitle("Tour edit");
		
		$this->load->model('tours/tours');
		
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
							
									
		if (!isset($this->request->get['tour_id'])) {
			$this->data['action'] = $this->url->link('tours/tours/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('tours/tours/update', 'tour_id=' . $this->request->get['tour_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('tours/tours', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('tours/tours/update', $url);
		
		$tour_info=array();	

		if (isset($this->request->get['tour_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$tour_info = $this->model_tours_tours->getTour($this->request->get['tour_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['tour_info']	=	$tour_info;
		
		$this->data['categorys']	=  $this->model_tours_tours->getCategorys();
										
		$this->template = 'tours/tours_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('tours/tours', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('tours/tours');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_tours_tours->update_tour($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('tours/tours', $url));
		}

	}
  
}
?>
