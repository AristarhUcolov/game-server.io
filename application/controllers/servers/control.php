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
		$this->document->setActiveSection('servers');
		$this->document->setActiveItem('index');
		
		if(!$this->user->isLogged()) {
			$this->session->data['error'] = "Вы не авторизированы!";
			$this->response->redirect($this->config->url . 'account/login');
		}
		if($this->user->getAccessLevel() < 0) {
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

		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('servers/control', $this->data);
	}
	
	public function action($serverid = null, $action = null) {
		$this->load->checkLicense();
		if(!$this->user->isLogged()) {
			$this->data['status'] = "error";
			$this->data['error'] = "Вы не авторизированы!";
			return json_encode($this->data);
		}
		if($this->user->getAccessLevel() < 0) {
	  		$this->data['status'] = "error";
			$this->data['error'] = "У вас нет доступа к данному разделу!";
			return json_encode($this->data);
		}
		
		$this->load->model('servers');
		$this->load->library('ssh2');
		
		$ssh2Lib = new ssh2Library();
		
		$error = $this->validate($serverid);
		if($error) {
			$this->data['status'] = "error";
			$this->data['error'] = $error;
			return json_encode($this->data);
		}	

		$server = $this->serversModel->getServerById($serverid, array('users', 'locations', 'games'));
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
			case 'csz': {
				if($server['server_status'] == 1) {
				$output = $ssh2Lib->execute($link, "cp -rf /home/cp/gameservers/files/cs_plug/amxmod/* /home/gs$serverid/cstrike");
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили плагин amxmodx!";
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
			case 'driftz': {
				if($server['server_status'] == 1) {
				$output = $ssh2Lib->execute($link, "cp -rf /home/cp/gameservers/files/sampauto/driftz/* /home/gs$serverid");
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили сборку <b>Russia-Drift [0.3z]</b>!";
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
						case 'rpz': {
				if($server['server_status'] == 1) {
				$output = $ssh2Lib->execute($link, "cp -rf /home/cp/gameservers/files/sampauto/rpz/* /home/gs$serverid; cd /home/gs$serverid/scriptfiles; echo Mysql_host=" .$server['location_ip']. " > MySQL.ini; echo Mysql_user=gs$serverid >> MySQL.ini; echo Mysql_db=gs$serverid >> MySQL.ini; echo Mysql_password=" .$server['server_password']. " >> MySQL.ini; chmod 777 MySQL.ini; cd /home/gs$serverid; mysql -ugs$serverid -p" .$server['server_password']. " gs$serverid < base.sql; rm base.sql"); 
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили сборку <b>Revelation Role-Play [0.3z]</b>!";
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
									case 'rppz': {
				if($server['server_status'] == 1) {
				$output = $ssh2Lib->execute($link, "cp -rf /home/cp/gameservers/files/sampauto/rppz/* /home/gs$serverid; cd /home/gs$serverid/scriptfiles; echo host=" .$server['location_ip']. " > mysql_settings.ini; echo username=gs$serverid >> mysql_settings.ini; echo password=" .$server['server_password']. " >> mysql_settings.ini; echo database=gs$serverid >> mysql_settings.ini; chmod 777 mysql_settings.ini; cd /home/gs$serverid; mysql -ugs$serverid -p" .$server['server_password']. " gs$serverid < base.sql; rm base.sql"); 
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили сборку <b>BRILLIANT Role-Play (MySQL) [0.3z]</b>!";
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
						case 'cwl': {
				if($server['server_status'] == 1) {
				$output = $ssh2Lib->execute($link, "cp -rf /home/cp/gameservers/files/sampauto/cwl/* /home/gs$serverid");
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили сборку <b>League T/CW v0.1.4i [0.3z]</b>!";
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
			case 'cwa': {
				if($server['server_status'] == 1) {
				$output = $ssh2Lib->execute($link, "cp -rf /home/cp/gameservers/files/sampauto/cwa/* /home/gs$serverid");
				$ssh2Lib->disconnect($link);
					$result = $this->serversModel->execServerAction($serverid, 'start');
					if($result['status'] == "OK") {
						$this->serversModel->updateServer($serverid, array('server_status' => 2));
						$this->data['status'] = "success";
						$this->data['success'] = "Вы успешно установили сборку <b>Attack-Defend v2.6(r) [0.3z]</b>!";
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
		if($this->user->getAccessLevel() < 1) {
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
				$editpassword = @$this->request->post['editpassword'];
				$password = @$this->request->post['password'];
				
				if($editpassword) {
					$serverData['server_password'] = $password;
				}
				
				$this->serversModel->updateServer($serverid, $serverData);
				#$this->serversModel->updateDatebase($serverid, $password);
				$result = $this->serversModel->execServerAction($serverid, 'updatepassword');
				
				if($result['status'] == "OK") {
					#$this->serversModel->updateServer($serverid, $serverData);
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
		
		$userid = $this->user->getId();
		
		if(!$this->serversModel->getTotalServers(array('server_id' => (int)$serverid, 'user_id' => (int)$userid))) {
			$result = "Запрашиваемый сервер не существует!";
		}
		return $result;
	}
	
	private function validatePOST() {
		$this->load->checkLicense();
		$this->load->library('validate');
		
		$validateLib = new validateLibrary();
		
		$result = null;
		
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
