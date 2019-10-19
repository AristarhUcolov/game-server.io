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
class viewController extends Controller {
	public function index($serverid = null) {
		$this->load->checkLicense();

		
		$this->load->library('query');
		$this->load->model('servers');
		$this->load->model('serversStats');
		$this->load->library('SampQueryAPI');
		$error = $this->validate($serverid);
		if($error) {
			$this->session->data['error'] = $error;
			$this->response->redirect($this->config->url . 'servers/index');
		}
		
		$userid = $this->user->getId();
		
		$server = $this->serversModel->getServerById($serverid, array('games', 'locations'));
		$this->data['server'] = $server;

		if($server['server_status'] == 2) {
			$queryLib = new queryLibrary($server['game_query']);
			$queryLib->connect($server['location_ip'], $server['server_port']);
			$query = $queryLib->getInfo();
			$queryLib->disconnect();
			
			$this->data['query'] = $query;
		}
		
		$stats = $this->serversStatsModel->getServerStats($serverid, "NOW() - INTERVAL 1 DAY", "NOW()");
		$this->data['stats'] = $stats;
		$queryq = new SampQueryAPI($server['location_ip'], $server['server_port']); 
		$this->data['queryq'] = $queryq;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('monitor/view', $this->data);
	}
	
	
	private function validate($serverid) {
		$this->load->checkLicense();
		$result = null;
		
		$userid = $this->user->getId();
		

		return $result;
	}
	
}
?>
