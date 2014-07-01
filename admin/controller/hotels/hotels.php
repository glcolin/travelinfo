<?php 
class ControllerHotelsHotels extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Hotels");

		$this->load->model('hotels/hotels');

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

		$this->template = 'hotels/hotels_list.tpl';
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
		
		$categorys = $this->model_hotels_hotels->getCategorys();
		$this->data['categorys'] = isset($categorys[1])?$categorys[1]:array();
		
		$data=array(
			'category' => $this->data['category']
		);
		
		$hotels_total=$this->model_hotels_hotels->getTotalHotels($data);
		
		$this->data['hotels'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($hotels_total as $hotel) {
			$sort_default[]=$hotel['id'];
			
			$action = array();

			if ($hotel['image_url'] && file_exists(DIR_IMAGE.$hotel['image_url'])) {
				$image = $this->model_tool_image->resize($hotel['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => "Edit",
				'href' => $this->url->link('hotels/hotels/edit', 'hotel_id=' . $hotel['id'] . $url)
			);
			
			$this->data['hotels'][$hotel['id']]=array(
				"info" => $hotel,
				"image" => $image,
				"action" => $action
			);
		}
			
		$this->data['insert'] = $this->url->link('hotels/hotels/addnew', $url);
		
		$this->data['delete'] = $this->url->link('hotels/hotels/delete', $url);	
				
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("Hotels"); 
		
		$this->load->model('hotels/hotels');
		
		$this->model_hotels_hotels->deleteHotel($this->request->post);
	  		
		$this->session->data['success'] = "Delete hotel success!";

		$url = '';
			
		$this->redirect($this->url->link('hotels/hotels', $url));
		
	}
	
	public function saveSort(){
		$this->load->model('hotels/hotels');
		$this->model_hotels_hotels->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("Hotels"); 
		
		$this->load->model('hotels/hotels');
		
		$this->model_hotels_hotels->addHotel($this->request->post);
	  		
		$this->session->data['success'] = "Add hotel success!";

		$url = '';
			
		$this->redirect($this->url->link('hotels/hotels', $url));	
	}
	
	public function addnew(){
		$this->document->setTitle("Add hotel"); 
		
		$this->load->model('hotels/hotels');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('hotels/hotels');

    	$this->document->setTitle("Hotel edit");
		
		$this->load->model('hotels/hotels');
		
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
							
									
		if (!isset($this->request->get['hotel_id'])) {
			$this->data['action'] = $this->url->link('hotels/hotels/insert', $url);
		} else {
			$this->data['action'] = $this->url->link('hotels/hotels/update', 'hotel_id=' . $this->request->get['hotel_id'] . $url);
		}
		
		$this->data['cancel'] = $this->url->link('hotels/hotels', $url, 'SSL');
		
		//$this->data['action'] = $this->url->link('hotels/hotels/update', $url);
		
		$hotel_info=array();	

		if (isset($this->request->get['hotel_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$hotel_info = $this->model_hotels_hotels->getHotel($this->request->get['hotel_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		$this->data['hotel_info']	=	$hotel_info;
		
		$this->data['categorys']	=  $this->model_hotels_hotels->getCategorys();
										
		$this->template = 'hotels/hotels_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->data['cancel']=$this->url->link('hotels/hotels', $url);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('hotels/hotels');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_hotels_hotels->update_hotel($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('hotels/hotels', $url));
		}

	}
  
}
?>
