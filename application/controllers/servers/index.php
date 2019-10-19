<?php
/*
Copyright (c) 2014 LiteDevel

Данная лицензия разрешает лицам, получившим копию данного программного обеспечения
и сопутствующей документации (в дальнейшем именуемыми «Программное Обеспечение»),
безвозмездно использовать Программное Обеспечение в  личных целях, включая неограниченное
право на использование, копирование, изменение, добавление, публикацию, распространение,
также как и лицам, которым запрещенно использовать Програмное Обеспечение в коммерческих целях,
предоставляется данное Программное Обеспечение,при соблюдении следующих условий:

Developed by LiteDevel
*/
class indexController extends Controller {
	private $limit = 20;
	public function index($page = 1) {
		$this->load->checkLicense();
		$this->document->setActiveSection('servers');
		$this->document->setActiveItem('index');
		
		if(!$this->user->isLogged()) {
			$this->session->data['error'] = "Р’С‹ РЅРµ Р°РІС‚РѕСЂРёР·РёСЂРѕРІР°РЅС‹!";
			$this->response->redirect($this->config->url . 'account/login');
		}
		if($this->user->getAccessLevel() < 0) {
			$this->session->data['error'] = "РЈ РІР°СЃ РЅРµС‚ РґРѕСЃС‚СѓРїР° Рє РґР°РЅРЅРѕРјСѓ СЂР°Р·РґРµР»Сѓ!";
			$this->response->redirect($this->config->url);
		}
		
		$this->load->library('pagination');
		$this->load->model('servers');
		
		$userid = $this->user->getId();
		
		$options = array(
			'start' => ($page - 1) * $this->limit,
			'limit' => $this->limit
		);
		
		$total = $this->serversModel->getTotalServers(array('user_id' => (int)$userid));
		$servers = $this->serversModel->getServers(array('user_id' => (int)$userid), array('games', 'locations'), array(), $options);
		
		$paginationLib = new paginationLibrary();
		
		$paginationLib->total = $total;
		$paginationLib->page = $page;
		$paginationLib->limit = $this->limit;
		$paginationLib->url = $this->config->url . 'servers/index/index/{page}';
		
		$pagination = $paginationLib->render();
		
		$this->data['servers'] = $servers;
		$this->data['pagination'] = $pagination;
		
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('servers/index', $this->data);
	}
}
?>
