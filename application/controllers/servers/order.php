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
class orderController extends Controller {
	public function index() {
		$this->load->checkLicense();
		$this->document->setActiveSection('servers');
		$this->document->setActiveItem('order');
		
		if(!$this->user->isLogged()) {
			$this->session->data['error'] = "Вы не авторизированы!";
			$this->response->redirect($this->config->url . 'account/login');
		}
		if($this->user->getAccessLevel() < 0) {
			$this->session->data['error'] = "У вас нет доступа к данному разделу!";
			$this->response->redirect($this->config->url);
		}
		$this->load->model('users');
		$users = $this->usersModel->getUserById(array('user_id' => (int)$userid), array('users'),array(),$options);
		$this->data['users'] = $users;
		$this->load->model('games');
		$this->load->model('locations');
		$games = $this->gamesModel->getGames(array('game_status' => 1));
		$locations = $this->locationsModel->getLocations(array('location_status' => 1));
		
		$this->data['games'] = $games;
		$this->data['locations'] = $locations;
		
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('servers/order', $this->data);
	}
	
	public function promo() {
		$this->load->checkLicense();
		if(!$this->user->isLogged()) {  
	  		$this->data['status'] = "error";
			$this->data['error'] = "Вы не авторизированы!";
			return json_encode($this->data);
		}
		if($this->user->getAccessLevel() < 1) {
	  		$this->data['status'] = "error";
			$this->data['error'] = "У вас нет доступа к данному разделу!";
			return json_encode($this->data);
		}
		
		$this->load->model('users');
		
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$code = $this->request->post['code'];
			$skidka = $this->usersModel->getSkidkaByCode($code, true);$kofficent=(100-$skidka['skidka'])/100;
			if($skidka['skidka'] == NULL){
				$this->data['status'] = "error";
				$this->data['error'] = "Данного кода не существует";
			}else{
				$this->data['status'] = "success";
				$this->data['success'] = "Вы активировали скидку ".$skidka['skidka']."%";
				$this->data['skidka'] = $kofficent;
			}
		}

		return json_encode($this->data);
	}
	
	public function ajax() {
		$this->load->checkLicense();
		if(!$this->user->isLogged()) {  
	  		$this->data['status'] = "error";
			$this->data['error'] = "Вы не авторизированы!";
			return json_encode($this->data);
		}
		if($this->user->getAccessLevel() < 1) {
	  		$this->data['status'] = "error";
			$this->data['error'] = "У вас нет доступа к данному разделу!";
			return json_encode($this->data);
		}
		
		$this->load->model('users');
		$this->load->model('games');
		$this->load->model('locations');
		$this->load->model('servers');
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$errorPOST = $this->validatePOST();
			if(!$errorPOST) {
				$gameid = $this->request->post['gameid'];
				$locationid = $this->request->post['locationid'];
				$slots = $this->request->post['slots'];
				$months = $this->request->post['months'];
				$password = $this->request->post['password'];
				$mysql = $this->request->post['mysql'];
				$userid = $this->user->getId();
				$balance = $this->user->getBalance();
				$test_server = $this->usersModel->getUserByTest($test_server);
				$game = $this->gamesModel->getGameById($gameid);
				$port = $this->serversModel->getServerNewPort($locationid, $game['game_min_port'], $game['game_max_port']);
				
				$code = $this->request->post['promo'];
				$skidka = $this->usersModel->getSkidkaByCode($code,true);$kofficent=(100-$skidka['skidka'])/100;
				if($port) {
					$price = $slots * $game['game_price'];
				
					switch($months) {
						case "3":
							$months = 3;
							$price = $price * 0.95;
							break;
						case "6":
							$months = 6;
							$price = $price * 0.90;
							break;
						case "12":
							$months = 12;
							$price = $price * 0.85;
							break;
						default:
							$months = 1;
					}
				
					$price = $price * $months;
				
					if($skidka['skidka'] != NULL){
						$price = $price * $kofficent;
					}
		
			            
						//if($test_server == 0)
					   //{
						if($balance >= $price) {
						$serverData = array(
							'user_id'			=> $userid,
							'game_id'			=> $gameid,
							'location_id'		=> $locationid,
							'database'			=> $mysql,
							'server_slots'		=> $slots,
							'server_port'		=> $port,
							'server_password'	=> $password,
							'server_status'		=> 1,
							'server_months'		=> $months
						);
						$serverid = $this->serversModel->createServer($serverData);
						$this->serversModel->execServerAction($serverid, "install");
						$this->usersModel->downUserBalance($userid, $price);
						$this->data['status'] = "success";
						$this->data['success'] = "Сервер №".$serverid." успешно установлен!";
						$this->data['id'] = $serverid;
						} else {
						$this->data['status'] = "error";
						$this->data['error'] = "На Вашем счету недостаточно средств!";
					    }
					    /*}else{
						 $userData = array(
                         'test_server'   => $test_server
                        );
                        $this->usersModel->updateUser($userid, $userData);
						$serverData = array(
							'user_id'			=> $userid,
							'game_id'			=> $gameid,
							'location_id'		=> $locationid,
							'database'			=> $mysql,
							'server_slots'		=> $slots,
							'server_port'		=> $port,
							'server_password'	=> $password,
							'server_status'		=> 1
						);
						$serverid = $this->serversModel->createTestServer($serverData);
						$this->serversModel->execServerAction($serverid, "install");
						$this->data['status'] = "success";
						$this->data['success'] = "Тест сервер №".$serverid.", на <b>3 календарных дня</b>, успешно установлен.";
						$this->data['id'] = $serverid;
						}*/						
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "На выбранной Вами локации нет свободных портов для данной игры!";
				}
			} else {
				$this->data['status'] = "error";
				$this->data['error'] = $errorPOST;
			}
		}

		return json_encode($this->data);
	}
	
	private function validatePOST() {
		$this->load->checkLicense();
		$this->load->library('validate');
		
		$validateLib = new validateLibrary();
		
		$result = null;
		
		$gameid = @$this->request->post['gameid'];
		$locationid = @$this->request->post['locationid'];
		$slots = @$this->request->post['slots'];
		$months = @$this->request->post['months'];
		$password = @$this->request->post['password'];
		$password2 = @$this->request->post['password2'];
		
		if(!$this->gamesModel->getTotalGames(array('game_id' => (int)$gameid, 'game_status' => 1))) {
			$result = "Вы указали несуществующую игру!";
		}
		elseif(!$this->locationsModel->getTotalLocations(array('location_id' => (int)$locationid, 'location_status' => 1))) {
			$result = "Вы указали несуществующую локацию!";
		}
		elseif(!$this->gamesModel->validateSlots($gameid, $slots)) {
			$result = "Вы указали недопустимое количество слотов!";
		}
		elseif(!$validateLib->password($password)) {
			$result = "Пароль должен содержать от 6 до 32 латинских букв, цифр и знаков <i>,.!?_-</i>!";
		}
		elseif($password != $password2) {
			$result = "Введенные вами пароли не совпадают!";
		}
		return $result;
	}
}
?>
