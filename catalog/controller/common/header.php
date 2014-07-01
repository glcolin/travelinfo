<?php   
class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->load->model('common/header');
		
		global $LANGUAGE;
		$this->data['TEXT'] = $LANGUAGE;
		
		$class_type = $this->session->data['class_type'];
		
		$language=$this->session->data['language'];
		
		$data=array(
			"class_type"=>$class_type,
			"language_id"=>$language
		);
		$this->data['top_banner'] = $this->model_common_header->getTopBanner($data);
		
		$current_page = isset($this->request->get['route'])?$this->request->get['route']:"";
		
		$current_page = explode('/',$current_page);
		
		$this->data['current_page'] = $current_page[0];

		$this->template = 'common/header.tpl';
		
    	$this->render();
	} 	
}
?>
