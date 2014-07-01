<?php 
class ControllerArticlesArticles extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("Information");

		$this->load->model('articles/articles');

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
		
		//load article list
		$this->data['articles'] = $this->model_articles_articles->getArticles();

		$this->template = 'articles/article_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);	
				
		$this->response->setOutput($this->render());
	}
	

	
	public function edit() {

    	$this->document->setTitle("Article Edit");
		
		$this->load->model('articles/articles');
		
		$this->session->data['success']= "" ;

    	$this->getForm();
	}	
	
	protected function getForm() {
			
    	if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
															
		if (!isset($this->request->get['article_id'])) {
			exit('ERR...');
		} else {
			$this->data['action'] = $this->url->link('articles/articles/update', 'article_id=' . $this->request->get['article_id']);
		}
		
		$this->data['cancel'] = $this->url->link('articles/articles');
	
		
		$article_info=array();	

		if (isset($this->request->get['article_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$article_info = $this->model_articles_articles->getArticle($this->request->get['article_id']);
    	}
		
		$this->data['languages'] = $this->session->data['languages'];		
		
		$this->data['article_info']	=	$article_info;
		
										
		$this->template = 'articles/article_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('articles/articles');
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_articles_articles->updateArticle($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('articles/articles'));
		}

	}
  
}
?>
