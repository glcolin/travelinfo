<?php   
class ControllerCommonAjax extends Controller {
	protected function index() {
		
	} 
	
	public function select_language(){
		$this->session->data['language'] = $this->request->post['language'];
		echo "1";
	}	
	
	public function set_compare_id(){
		if(count($this->session->data[$this->request->post['class_type']."_ids"])>=3 && $this->request->post['id'] && $this->request->post['status']=="checked"){
			echo "false";
		}
		else{
			if(isset($this->request->post['status']) && $this->request->post['status']=="checked"){
				$this->session->data[$this->request->post['class_type']."_ids"][] = $this->request->post['id'];
			}
			else{
				if(is_array($this->session->data[$this->request->post['class_type']."_ids"])){
					foreach($this->session->data[$this->request->post['class_type']."_ids"] as $key=>$value){
						if($value==$this->request->post['id']){
							unset($this->session->data[$this->request->post['class_type']."_ids"][$key]);
						}
					}
				}
			}
			echo implode(',',$this->session->data[$this->request->post['class_type']."_ids"]);
		}
	}
}
?>
