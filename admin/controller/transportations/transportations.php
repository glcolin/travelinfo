<?php 
class ControllerTransportationsTransportations extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Transportations");

		$this->load->model('transportations/transportations');

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

		$this->template = 'transportations/transportations_list.tpl';
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
		
		$categorys = $this->model_transportations_transportations->getCategorys();
		$this->data['categorys'] = isset($categorys[1])?$categorys[1]:array();
		
		$data=array(
			'category' => $this->data['category']
		);
		
		$transportations_total=$this->model_transportations_transportations->getTotalTransportations($data);
		
		$this->data['transportations'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($transportations_total as $transportation) {
			$sort_default[]=$transportation['id'];
			
			$action = array();

			if ($transportation['image_url'] && file_exists(DIR_IMAGE.$transportation['image_url'])) {
				$image = $this->model_tool_image->resize($transportation['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('transportations/transportations/edit', 'transportation_id=' . $transportation['id'] . $url)
			);
			
			$this->data['transportations'][$transportation['id']]=array(
				"info" => $transportation,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('transportations/transportations/addnew', $url);
		
		$this->data['delete'] = $this->url->link('transportations/transportations/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Transportations"); 
		
		$this->load->model('transportations/transportations');
		
		$this->model_transportations_transportations->deleteTransportation($this->request->post);
	  		
		$this->session->data['success'] = "Delete transportation success!";

		$url = '';
			
		$this->redirect($this->url->link('transportations/transportations', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('transportations/transportations');
		$this->model_transportations_transportations->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Transportations"); 
		
		$this->load->model('transportations/transportations');
		
		$this->model_transportations_transportations->addTransportation($this->request->post);
	  		
		$this->session->data['success'] = "Add transportation success!";

		$url = '';
			
		$this->redirect($this->url->link('transportations/transportations', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add transportation"); 
		
		$this->load->model('transportations/transportations');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('transportations/transportations');

    	$this->document->setTitle("Transportation edit");
		
		$this->load->model('transportations/transportations');
		
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
							
									
		if (!isset($this->request->get['transportation_id'])) {
			$this->data['action'] = $this->url->link('transportations/transportations/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('transportations/transportations/update', 'transportation_id=' . $this->request->get['transportation_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('transportations/transportations', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('transportations/transportations/update', $url);
		
		$transportation_info=array();	

		if (isset($this->request->get['transportation_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$transportation_info = $this->model_transportations_transportations->getTransportation($this->request->get['transportation_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['transportation_info']	=	$transportation_info;
		
		$this->data['categorys']	=  $this->model_transportations_transportations->getCategorys();
										
		$this->template = 'transportations/transportations_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('transportations/transportations', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('transportations/transportations');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_transportations_transportations->update_transportation($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('transportations/transportations', $url));
		}

	}
  
}
?>
