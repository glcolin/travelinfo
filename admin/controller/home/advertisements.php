<?php 
class ControllerHomeAdvertisements extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Advertisement");

		$this->load->model('home/advertisements');

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

		$this->template = 'home/advertisements_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$data = array();
		
		$data=array(
			
		);
		
		$advertisements_total=$this->model_home_advertisements->getTotalAdvertisements($data);
		
		$this->data['advertisements'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($advertisements_total as $advertisement) {
			$sort_default[]=$advertisement['id'];
			
			$action = array();
			
			if ($advertisement['image_url'] && file_exists(DIR_IMAGE.$advertisement['image_url'])) {
				$image = $this->model_tool_image->resize($advertisement['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('home/advertisements/edit', 'advertisement_id=' . $advertisement['id'] . $url)
			);
			
			$this->data['advertisements'][$advertisement['id']]=array(
				"info" => $advertisement,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('home/advertisements/addnew', $url);
		
		$this->data['delete'] = $this->url->link('home/advertisements/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Advertisement"); 
		
		$this->load->model('home/advertisements');
		
		$this->model_home_advertisements->deleteAdvertisement($this->request->post);
	  		
		$this->session->data['success'] = "Delete advertisement success!";

		$url = '';
			
		$this->redirect($this->url->link('home/advertisements', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('home/advertisements');
		$this->model_home_advertisements->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Advertisements"); 
		
		$this->load->model('home/advertisements');
		
		$this->model_home_advertisements->addAdvertisement($this->request->post);
	  		
		$this->session->data['success'] = "Add advertisement success!";

		$url = '';
			
		$this->redirect($this->url->link('home/advertisements', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add Advertisement"); 
		
		$this->load->model('home/advertisements');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('home/advertisements');

    	$this->document->setTitle("Advertisement edit");
		
		$this->load->model('home/advertisements');
		
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
							
									
		if (!isset($this->request->get['advertisement_id'])) {
			$this->data['action'] = $this->url->link('home/advertisements/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('home/advertisements/update', 'advertisement_id=' . $this->request->get['advertisement_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('home/advertisements', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('home/advertisements/update', $url);
		
		$advertisement_info=array();	

		if (isset($this->request->get['advertisement_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$advertisement_info = $this->model_home_advertisements->getAdvertisement($this->request->get['advertisement_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['advertisement_info']	=	$advertisement_info;
										
		$this->template = 'home/advertisements_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('home/advertisements', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('home/advertisements');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_home_advertisements->update_advertisement($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('home/advertisements', $url));
		}

	}
  
}
?>
