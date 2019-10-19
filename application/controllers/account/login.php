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
class loginController extends Controller {
	public function index() {
		$this->load->checkLicense();
		$this->document->setActiveSection('account');
		$this->document->setActiveItem('login');
		
		if($this->user->isLogged()) {
			$this->session->data['error'] = "Вы не авторизированы!";
			$this->response->redirect($this->config->url);
		}

		$this->getChild(array('common/loginheader', 'common/loginfooter'));
		return $this->load->view('account/login', $this->data);
	}
	
	public function ajax() {
		$this->load->model('users');
		$this->load->checkLicense();
		if($this->user->isLogged()) {  
	  		$this->data['status'] = "error";
			$this->data['error'] = "Вы не авторизированы!";
			return json_encode($this->data);
		}
		
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$errorPOST = $this->validatePOST();
			if(!$errorPOST) {
				$email = @$this->request->post['email'];
				$password = @$this->request->post['password'];
				
				if($this->user->login($email, $password)) {
					

					
					$this->data['status'] = "success";
					$this->data['success'] = "Вы успешно вошли!";
				} else {
					
					$userid=$this->usersModel->getIdByEmail($email);$ip=$this->request->server['REMOTE_ADDR'];
					$this->usersModel->createAuthLog($userid['user_id'],$ip,'0',$password);
					
					$this->data['status'] = "error";
					$this->data['error'] = "Вы ввели не верный логин или пароль!";
				}
			} else {
				$this->data['status'] = "error";
				$this->data['error'] = $errorPOST;
			}
			
		}else{
			$this->data['status'] = "error";
			$this->data['error'] = "Не POST запрос";
		}

		return json_encode($this->data);
	}
	
	private function validatePOST() {
	
		$this->load->library('validate');
		
		$validateLib = new validateLibrary();
		
		$result = null;
		
		$email = @$this->request->post['email'];
		$password = @$this->request->post['password'];
		
		if(!$validateLib->email($email)) {
			$result = "Укажите свой реальный E-Mail!";
		}
		elseif(!$validateLib->password($password)) {
			$result = "Пароль должен содержать от 6 до 32 латинских букв, цифр и знаков <i>,.!?_-</i>!";
		}
		return $result;
	}
}
?>
