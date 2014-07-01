<?php 
class ControllerHomeFriendlinks extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Friendlink");

		$this->load->model('home/friendlinks');

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

		$this->template = 'home/friendlinks_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$data = array();
		
		$data=array(
			
		);
		
		$friendlinks_total=$this->model_home_friendlinks->getTotalFriendlinks($data);
		
		$this->data['friendlinks'] = array();
		
		foreach ($friendlinks_total as $friendlink) {
			$sort_default[]=$friendlink['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('home/friendlinks/edit', 'friendlink_id=' . $friendlink['id'] . $url)
			);
			
			$this->data['friendlinks'][$friendlink['id']]=array(
				"info" => $friendlink,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('home/friendlinks/addnew', $url);
		
		$this->data['delete'] = $this->url->link('home/friendlinks/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Friendlink"); 
		
		$this->load->model('home/friendlinks');
		
		$this->model_home_friendlinks->deleteFriendlink($this->request->post);
	  		
		$this->session->data['success'] = "Delete friendlink success!";

		$url = '';
			
		$this->redirect($this->url->link('home/friendlinks', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('home/friendlinks');
		$this->model_home_friendlinks->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Friendlinks"); 
		
		$this->load->model('home/friendlinks');
		
		$this->model_home_friendlinks->addFriendlink($this->request->post);
	  		
		$this->session->data['success'] = "Add friendlink success!";

		$url = '';
			
		$this->redirect($this->url->link('home/friendlinks', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add Friendlink"); 
		
		$this->load->model('home/friendlinks');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('home/friendlinks');

    	$this->document->setTitle("Friendlink edit");
		
		$this->load->model('home/friendlinks');
		
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
							
									
		if (!isset($this->request->get['friendlink_id'])) {
			$this->data['action'] = $this->url->link('home/friendlinks/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('home/friendlinks/update', 'friendlink_id=' . $this->request->get['friendlink_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('home/friendlinks', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('home/friendlinks/update', $url);
		
		$friendlink_info=array();	

		if (isset($this->request->get['friendlink_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$friendlink_info = $this->model_home_friendlinks->getFriendlink($this->request->get['friendlink_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['friendlink_info']	=	$friendlink_info;
										
		$this->template = 'home/friendlinks_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('home/friendlinks', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('home/friendlinks');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_home_friendlinks->update_friendlink($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('home/friendlinks', $url));
		}

	}
  
}
?>
