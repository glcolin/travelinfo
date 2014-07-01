<?php

class ControllerNewsletterNewsletter extends Controller {

	public function index(){
			
		global $LANGUAGE;
		$this->data['TEXT'] = $LANGUAGE;
		
		$this->template = 'newsletter/newsletter.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
		
	}

}