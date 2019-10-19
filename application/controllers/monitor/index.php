<?php
/*
Copyright (c) 2014 LiteDevel

������ �������� ��������� �����, ���������� ����� ������� ������������ �����������
� ������������� ������������ (� ���������� ���������� ������������ �����������),
������������ ������������ ����������� ����������� �  ������ �����, ������� ��������������
����� �� �������������, �����������, ���������, ����������, ����������, ���������������,
����� ��� � �����, ������� ���������� ������������ ���������� ����������� � ������������ �����,
��������������� ������ ����������� �����������,��� ���������� ��������� �������:

Developed by LiteDevel
*/
class indexController extends Controller {
	private $limit = 15;
	public function index($page = 1) {
		$this->load->checkLicense();
		
		$this->document->setActiveSection('account');
		$this->document->setActiveItem('servers');
		$this->load->library('query');
		$this->load->model('serversStats');
		$this->load->library('pagination');
		$this->load->model('servers');
		$getData = array();
		
		if(isset($this->request->get['userid'])) {
			$getData['servers.user_id'] = (int)$this->request->get['userid'];
		}
		
		if(isset($this->request->get['gameid'])) {
			$getData['servers.game_id'] = (int)$this->request->get['gameid'];
		}
		
		if(isset($this->request->get['locationid'])) {
			$getData['servers.location_id'] = (int)$this->request->get['locationid'];
		}
		$getOptions = array(
			'start' => ($page - 1) * $this->limit,
			'limit' => $this->limit
		);
		
		$total = $this->serversModel->getTotalServers($getData);
		$servers = $this->serversModel->getServers($getData, array('games', 'locations'), array(), $getOptions);
		$paginationLib = new paginationLibrary();
		
		$paginationLib->total = $total;
		$paginationLib->page = $page;
		$paginationLib->limit = $this->limit;
		$paginationLib->url = $this->config->url . 'monitor/index/index/{page}';
		
		$pagination = $paginationLib->render();
		$this->data['servers'] = $servers;
		$this->data['pagination'] = $pagination;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('monitor/index', $this->data);
	}
}
?>
