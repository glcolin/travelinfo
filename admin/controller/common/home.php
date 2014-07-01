<?php   
class ControllerCommonHome extends Controller {   
	public function index() {
		if (!$this->user->isLogged()){ 
			//redirect to common/login 
			$this->redirect($this->url->link('common/login'));
		}
	 
		$this->document->setTitle('Admin Home');
		
		$this->template = 'common/home.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	public function login() {
		
	}
	
}
?>