<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle("America Travel Info");
	
		$this->load->model('common/home');
		
		global $LANGUAGE;
		$this->data['TEXT'] = $LANGUAGE;
		
		$language=$this->session->data['language'];
		
		$this->session->data['class_type'] = "home";
		
		//header banner
		$data=array(
			"position"=>"header",
			"language_id"=>$language
		);
		$this->data['header_banners'] = $this->model_common_home->getBanners($data);
		
		//content banner
		$data=array(
			"position"=>"content",
			"language_id"=>$language
		);
		$this->data['content_banners'] = $this->model_common_home->getBanners($data);
		
		//advertisements
		$data=array(
			"language_id"=>$language
		);
		$this->data['advertisements'] = $this->model_common_home->getAdvertisements($data);
	
		//attractions
		$data=array(
			"class_type" => "attractions",
			"language_id" => $language
		);
		$this->data['attractions_data'] = $this->model_common_home->getClassItems($data);
		
		//amusement
		$data=array(
			"class_type" => "amusements",
			"language_id" => $language
		);
		$this->data['amusements_data'] = $this->model_common_home->getClassItems($data);
		
		//restaurants
		$data=array(
			"class_type" => "restaurants",
			"language_id" => $language
		);
		$this->data['restaurants_data'] = $this->model_common_home->getClassItems($data);
		
		//tours
		$data=array(
			"class_type" => "tours",
			"language_id" => $language
		);
		$this->data['tours_data'] = $this->model_common_home->getClassItems($data);
		
		//hotels
		$data=array(
			"class_type" => "hotels",
			"language_id" => $language
		);
		$this->data['hotels_data'] = $this->model_common_home->getClassItems($data);
		
		//transportations
		$data=array(
			"class_type" => "transportations",
			"language_id" => $language
		);
		$this->data['transportations_data'] = $this->model_common_home->getClassItems($data);
		
		//shoppings
		$data=array(
			"class_type" => "shoppings",
			"language_id" => $language
		);
		$this->data['shoppings_data'] = $this->model_common_home->getClassItems($data);
		
		//cruises
		$data=array(
			"class_type" => "cruises",
			"language_id" => $language
		);
		$this->data['cruises_data'] = $this->model_common_home->getClassItems($data);
	
		$this->template = 'common/home.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
	}
}
?>