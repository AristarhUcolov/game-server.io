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

class controlController extends Controller {
	public function index($serverid = null) {
		$this->load->checkLicense();
		
		$this->document->setActiveSection('admin');
		$this->document->setActiveItem('servers');
		
		if(!$this->user->isLogged()) {
			$this->session->data['error'] = "Вы не авторизированы!";
			$this->response->redirect($this->config->url . 'account/login');
		}
		if($this->user->getAccessLevel() < 2) {
			$this->session->data['error'] = "У вас нет доступа к данному разделу!";
			$this->response->redirect($this->config->url);
		}
		
		$this->load->library('query');
		$this->load->model('servers');
		$this->load->model('serversStats');
		
		$error = $this->validate($serverid);
		if($error) {
			$this->session->data['error'] = $error;
			$this->response->redirect($this->config->url . 'servers/index');
		}
		
		$server = $this->serversModel->getServerById($serverid, array('users', 'games', 'locations'));
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
		
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('admin/servers/control', $this->data);
	}
	
	public function action($serverid = null, $action = null) {
		$this->load->checkLicense();
		
		if(!$this->user->isLogged()) {
			$this->data['status'] = "error";
			$this->data['error'] = "Вы не авторизированы!";
			return json_encode($this->data);
		}
		if($this->user->getAccessLevel() < 2) {
			$this->data['status'] = "error";
			$this->data['error'] = "У вас нет доступа к данному разделу!";
			return json_encode($this->data);
		}
		
		$this->load->model('servers');
		$this->load->library('ssh2');
		
		$error = $this->validate($serverid);
		if($error) {
			$this->data['status'] = "error";
			$this->data['error'] = $error;
			return json_encode($this->data);
		}
		
		$server = $this->serversModel->getServerById($serverid, array('users', 'locations', 'games'));
				
		
		$ssh2Lib = new ssh2Library();
			
        $link = $ssh2Lib->connect($server['location_ip'], $server['location_user'], $server['location_password']);
		switch($action) {
			case 'start': {
				if($server['server_status'] == 1) {
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно запустили сервер!";
					} else {
						$this->data['status'] = "error";
						$this->data['error'] = $result['description'];
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть выключен!";
				}
				break;
			}
			case 'reinstall': {
				if($server['server_status'] == 1) {
					$result = $this->serversModel->execServerAction($serverid, 'reinstall');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 1));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно переустановили сервер!";
					} else {
						$this->data['status'] = "error";
						$this->data['error'] = $result['description'];
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть выключен!";
				}
				break;
			}
			case 'restart': {
				if($server['server_status'] == 2) {
					$result = $this->serversModel->execServerAction($serverid, 'restart');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно перезапустили сервер!";
					} else {
						$this->data['status'] = "error";
						$this->data['error'] = $result['description'];
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть включен!";
				}
				break;
			}
			case 'stop': {
				if($server['server_status'] == 2) {
					$result = $this->serversModel->execServerAction($serverid, 'stop');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 1));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно выключили сервер!";
					} else {
						$this->data['status'] = "error";
						$this->data['error'] = $result['description'];
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть включен!";
				}
				break;
			}
			case 'block': {
				if($server['server_status'] == 1) {
					$this->serversModel->updateServer($serverid, array('server_status' => 0));
					$this->data['status'] = "success";
					$this->data['success'] = "Вы успешно заблокировали сервер!";
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть выключен!";
				}
				break;
			}
			case 'unblock': {
				if($server['server_status'] == 0) {
					$this->serversModel->updateServer($serverid, array('server_status' => 1));
					$this->data['status'] = "success";
					$this->data['success'] = "Вы успешно разблокировали сервер!";
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть заблокированн!";
				}
				break;
			}
				case 'delete': {
				if($server['server_status'] == 1) {
					if($this->user->getAccessLevel() == 3){
						$result = $this->serversModel->execServerAction($serverid, 'delete');
						if($result['status'] == "OK") {
							$this->serversModel->deleteServer($serverid);
							$this->data['status'] = "success";
							$this->data['success'] = "Вы успешно удалили сервер!";
							mysql_query("drop database `gs$serverid`");
							mysql_query("drop user `gs$serverid`");
						} else {
							$this->data['status'] = "error";
							$this->data['error'] = $result['description'];
						}
					} else {
						$this->session->data['error'] = "У вас нет доступа к данному разделу!";
						$this->response->redirect($this->config->url);
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть выключен!";
				}
				break;
			}
						case 'cvz': {
				if($server['server_status'] == 1) {
				if($server['version'] == 1) {
				$this->data['status'] = "error";
				$this->data['error'] = "Версия вашего сервера и так 0.3z-R4!";
				}
				$output = $ssh2Lib->execute($link, "cp /home/cp/gameservers/files/samp_ver/sampz/* /home/gs$serverid");
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->serversModel->updateServer($serverid, array('version' => 1));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили версию 0.3z!";
					} else {
						$this->data['status'] = "error";
						$this->data['error'] = $result['description'];
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть выключен!";
				}
				break;
			}
						case 'cvx': {
				if($server['server_status'] == 1) {
				if($server['version'] == 3) {
				$this->data['status'] = "error";
				$this->data['error'] = "Версия вашего сервера и так 0.3x-R1!";
				}
				$output = $ssh2Lib->execute($link, "cp /home/cp/gameservers/files/samp_ver/sampx/* /home/gs$serverid");
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->serversModel->updateServer($serverid, array('version' => 3));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили версию 0.3x!";
					} else {
						$this->data['status'] = "error";
						$this->data['error'] = $result['description'];
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть выключен!";
				}
				break;
			}
			case 'cve': {
				if($server['server_status'] == 1) {
				$output = $ssh2Lib->execute($link, "cp /home/cp/gameservers/files/samp_ver/sampe/* /home/gs$serverid");
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->serversModel->updateServer($serverid, array('version' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили версию 0.3e!";
					} else {
						$this->data['status'] = "error";
						$this->data['error'] = $result['description'];
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть выключен!";
				}
				break;
			}
						case 'cvz1000': {
				if($server['server_status'] == 1) {
				$output = $ssh2Lib->execute($link, "cp /home/cp/gameservers/files/samp_ver/sampz1000/* /home/gs$serverid");
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->serversModel->updateServer($serverid, array('version' => 1));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили версию 0.3z-R4-1000!";
					} else {
						$this->data['status'] = "error";
						$this->data['error'] = $result['description'];
					}
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = "Сервер должен быть выключен!";
				}
				break;
			}
			default: {
				$this->data['status'] = "error";
				$this->data['error'] = "Вы выбрали несуществующее действие!";
				break;
			}
		}
		
		return json_encode($this->data);
	}
	
	public function ajax($serverid = null) {
		$this->load->checkLicense();
		if(!$this->user->isLogged()) {  
	  		$this->data['status'] = "error";
			$this->data['error'] = "Вы не авторизированы!";
			return json_encode($this->data);
		}
		if($this->user->getAccessLevel() < 2) {
			$this->data['status'] = "error";
			$this->data['error'] = "У вас нет доступа к данному разделу!";
			return json_encode($this->data);
		}
		
		$this->load->model('servers');
		
		$error = $this->validate($serverid);
		if($error) {
			$this->data['status'] = "error";
			$this->data['error'] = $error;
			return json_encode($this->data);
		}
		
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$errorPOST = $this->validatePOST();
			if(!$errorPOST) {
				$slots = @$this->request->post['slots'];
				$editpassword = @$this->request->post['editpassword'];
				$password = @$this->request->post['password'];
				
				$serverData['server_slots'] = $slots;
				
				if($editpassword) {
					$serverData['server_password'] = $password;
				}
				
				$result = $this->serversModel->execServerAction($serverid, 'updatepassword');
				if($result['status'] == "OK") {
					$this->serversModel->updateServer($serverid, $serverData);
					$this->data['status'] = "success";
					$this->data['success'] = "Вы успешно отредактировали сервер!";
				} else {
					$this->data['status'] = "error";
					$this->data['error'] = $result['description'];
				}
			} else {
				$this->data['status'] = "error";
				$this->data['error'] = $errorPOST;
			}
		}

		return json_encode($this->data);
	}
	
	private function validate($serverid) {
		$this->load->checkLicense();
		$result = null;
		
		if(!$this->serversModel->getTotalServers(array('server_id' => (int)$serverid))) {
			$result = "Запрашиваемый сервер не существует!";
		}
		return $result;
	}
	
	private function block($serverid) {
		$this->load->checkLicense();
		$this->serversModel->updateServer($serverid, array('server_status' => 0));
	}
	
	private function validatePOST() {
		$this->load->checkLicense();
		$this->load->library('validate');
		
		$validateLib = new validateLibrary();
		
		$result = null;
		
		$slots = @$this->request->post['slots'];
		$editpassword = @$this->request->post['editpassword'];
		$password = @$this->request->post['password'];
		$password2 = @$this->request->post['password2'];
		
		if($editpassword) {
			if(!$validateLib->password($password)) {
				$result = "Пароль должен содержать от 6 до 32 латинских букв, цифр и знаков <i>,.!?_-</i>!";
			}
			elseif($password != $password2) {
				$result = "Введенные вами пароли не совпадают!";
			}
		}
		return $result;
	}
}
?>
