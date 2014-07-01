<?php 
class ControllerAttractionsBanners extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Banner");

		$this->load->model('attractions/banners');

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

		$this->template = 'attractions/banners_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$data = array();
		
		$data=array(
			
		);
		
		$banners_total=$this->model_attractions_banners->getTotalBanners($data);
		
		$this->data['banners'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($banners_total as $banner) {
			$sort_default[]=$banner['id'];
			
			$action = array();
			
			if ($banner['image_url'] && file_exists(DIR_IMAGE.$banner['image_url'])) {
				$image = $this->model_tool_image->resize($banner['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('attractions/banners/edit', 'banner_id=' . $banner['id'] . $url)
			);
			
			$this->data['banners'][$banner['id']]=array(
				"info" => $banner,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('attractions/banners/addnew', $url);
		
		$this->data['delete'] = $this->url->link('attractions/banners/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Banner"); 
		
		$this->load->model('attractions/banners');
		
		$this->model_attractions_banners->deleteBanner($this->request->post);
	  		
		$this->session->data['success'] = "Delete banner success!";

		$url = '';
			
		$this->redirect($this->url->link('attractions/banners', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('attractions/banners');
		$this->model_attractions_banners->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Banners"); 
		
		$this->load->model('attractions/banners');
		
		$this->model_attractions_banners->addBanner($this->request->post);
	  		
		$this->session->data['success'] = "Add banner success!";

		$url = '';
			
		$this->redirect($this->url->link('attractions/banners', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add Banner"); 
		
		$this->load->model('attractions/banners');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('attractions/banners');

    	$this->document->setTitle("Banner edit");
		
		$this->load->model('attractions/banners');
		
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
							
									
		if (!isset($this->request->get['banner_id'])) {
			$this->data['action'] = $this->url->link('attractions/banners/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('attractions/banners/update', 'banner_id=' . $this->request->get['banner_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('attractions/banners', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('attractions/banners/update', $url);
		
		$banner_info=array();	

		if (isset($this->request->get['banner_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$banner_info = $this->model_attractions_banners->getBanner($this->request->get['banner_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['banner_info']	=	$banner_info;
										
		$this->template = 'attractions/banners_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('attractions/banners', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('attractions/banners');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_attractions_banners->update_banner($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('attractions/banners', $url));
		}

	}
  
}
?>
