<?php 
class ControllerAmusementsAmusements extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Amusements");

		$this->load->model('amusements/amusements');

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

		$this->template = 'amusements/amusements_list.tpl';
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
		
		$categorys = $this->model_amusements_amusements->getCategorys();
		$this->data['categorys'] = isset($categorys[1])?$categorys[1]:array();
		
		$data=array(
			'category' => $this->data['category']
		);
		
		$amusements_total=$this->model_amusements_amusements->getTotalAmusements($data);
		
		$this->data['amusements'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($amusements_total as $amusement) {
			$sort_default[]=$amusement['id'];
			
			$action = array();

			if ($amusement['image_url'] && file_exists(DIR_IMAGE.$amusement['image_url'])) {
				$image = $this->model_tool_image->resize($amusement['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('amusements/amusements/edit', 'amusement_id=' . $amusement['id'] . $url)
			);
			
			$this->data['amusements'][$amusement['id']]=array(
				"info" => $amusement,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('amusements/amusements/addnew', $url);
		
		$this->data['delete'] = $this->url->link('amusements/amusements/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Amusements"); 
		
		$this->load->model('amusements/amusements');
		
		$this->model_amusements_amusements->deleteAmusement($this->request->post);
	  		
		$this->session->data['success'] = "Delete amusement success!";

		$url = '';
			
		$this->redirect($this->url->link('amusements/amusements', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('amusements/amusements');
		$this->model_amusements_amusements->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Amusements"); 
		
		$this->load->model('amusements/amusements');
		
		$this->model_amusements_amusements->addAmusement($this->request->post);
	  		
		$this->session->data['success'] = "Add amusement success!";

		$url = '';
			
		$this->redirect($this->url->link('amusements/amusements', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add amusement"); 
		
		$this->load->model('amusements/amusements');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('amusements/amusements');

    	$this->document->setTitle("Amusement edit");
		
		$this->load->model('amusements/amusements');
		
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
							
									
		if (!isset($this->request->get['amusement_id'])) {
			$this->data['action'] = $this->url->link('amusements/amusements/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('amusements/amusements/update', 'amusement_id=' . $this->request->get['amusement_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('amusements/amusements', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('amusements/amusements/update', $url);
		
		$amusement_info=array();	

		if (isset($this->request->get['amusement_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$amusement_info = $this->model_amusements_amusements->getAmusement($this->request->get['amusement_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['amusement_info']	=	$amusement_info;
		
		$this->data['categorys']	=  $this->model_amusements_amusements->getCategorys();
										
		$this->template = 'amusements/amusements_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('amusements/amusements', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('amusements/amusements');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_amusements_amusements->update_amusement($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('amusements/amusements', $url));
		}

	}
  
}
?>
