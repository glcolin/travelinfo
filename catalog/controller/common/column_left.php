<?php  
class ControllerCommonColumnLeft extends Controller {
	protected function index() {
		$this->load->model('common/column_left');
		
		$class_type = $this->session->data['class_type'];
		$this->data['class_title'] = $this->session->data['class_title'];
		
		global $LANGUAGE;
		$this->data['TEXT'] = $LANGUAGE;
		
		$language=$this->session->data['language'];
		
		$data=array(
			"class_type"=>$class_type,
			"language_id"=>$language
		);
		$categorys = $this->model_common_column_left->getCategorys($data);
		$current_category = isset($this->request->get['cid'])?$this->request->get['cid']:"";
		
		if(isset($this->request->get['search'])){
			$current_category = "";
		}
		
		$this->data['current_category'] = $current_category;
		$this->data['categorys'] = $categorys;
		
		//banners
		$data=array(
			"class_type"=>$class_type,
			"position"=>"left",
			"language_id"=>$language
		);
		$this->data['left_banners'] = $this->model_common_column_left->getBanners($data);
		
		$this->data['route'] = $class_type."/".$class_type;
		
		$this->data['search'] = isset($this->request->get['search'])?$this->request->get['search']:'';
		
		$this->template = 'common/column_left.tpl';
								
		$this->render();
	}
}
?>