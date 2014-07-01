<?php  
class ControllerCommonFooter extends Controller {
	protected function index() {
		$this->load->model('common/footer');
		
		$language=$this->session->data['language'];
		
		$data=array(
			"language_id"=>$language
		);
		
		$this->data['friendlinks'] = $this->model_common_footer->getFriendlinks($data);
		
		$this->template = 'common/footer.tpl';
		
		$this->render();
	}
}
?>