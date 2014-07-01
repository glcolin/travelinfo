<?php  
class ControllerArticlesArticle extends Controller {
	public function index() {
	
		$this->load->model('articles/articles');
		
		global $LANGUAGE;
		$this->data['TEXT'] = $LANGUAGE;
		
		$language=$this->session->data['language'];

		if(isset($this->request->get['id'])){
			$articles = $this->model_articles_articles->getArticle($this->request->get['id']);
			$this->data['content'] = html_entity_decode($articles[$language]['content'], ENT_QUOTES, 'UTF-8');
		}else{
			$this->data['content'] = '';
		}
		
		//render
		$this->template = 'articles/article.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
		);
										
		$this->response->setOutput($this->render());
	}
}
?>