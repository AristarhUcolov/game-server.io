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
	public function index() {
		$this->load->checkLicense();
		if(!$this->user->isLogged()) {
			$this->response->redirect($this->config->url . 'account/login');
		}
		if($this->user->getAccessLevel() < 2) {
			$this->session->data['error'] = "У вас нет доступа к данному разделу!";
			$this->response->redirect($this->config->url);
		}
		
		$this->load->model('servers');
		$this->load->model('tickets');
		$this->load->model('users');
		
		$userid = $this->user->getId();
		
		$this->data['logged'] = true;
		$this->data['user_email'] = $this->user->getEmail();
		$this->data['user_id'] = $userid;
		$this->data['user_firstname'] = $this->user->getFirstname();
		$this->data['user_lastname'] = $this->user->getLastname();
		$this->data['user_balance'] = $this->user->getBalance();
		$this->data['user_access_level'] = $this->user->getAccessLevel();
		$ticketsSort = array(
			'ticket_status'		=> 'DESC',
			'ticket_date_add'	=> 'DESC'
		);
		
		$options = array(
			'start' => 0,
			'limit' => 5
		);
		$users = $this->usersModel->getUserById(array('user_id' => (int)$userid), array('users'), array(), $options);
		$servers = $this->serversModel->getServers(array('user_id' => (int)$userid), array('games', 'locations'), array(), $options);
		$tickets = $this->ticketsModel->getTickets(array('user_id' => (int)$userid), array(), $ticketsSort, $options);
		$this->data['servers'] = $servers;
		$this->data['tickets'] = $tickets;
		$this->data['users'] = $users;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('admin/index', $this->data);
	}
}
?>