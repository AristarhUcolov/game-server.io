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
class registerController extends Controller {
	public function index() {
		$this->load->checkLicense();
		$this->document->setActiveSection('account');
		$this->document->setActiveItem('register');
		
		if($this->user->isLogged()) {
			$this->session->data['error'] = "Вы уже авторизированы!";
			$this->response->redirect($this->config->url);
		}

		$this->getChild(array('common/loginheader', 'common/loginfooter'));
		return $this->load->view('account/register', $this->data);
	}
	
	public function ajax() {
		$this->load->checkLicense();
		if($this->user->isLogged()) {  
	  		$this->data['status'] = "error";
			$this->data['error'] = "Вы уже авторизированы!";
			return json_encode($this->data);
		}
		
		$this->load->library('mail');
		$this->load->model('users');
		
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$errorPOST = $this->validatePOST();
			if(!$errorPOST) {
				$lastname = @$this->request->post['lastname'];
				$firstname = @$this->request->post['firstname'];
				$email = @$this->request->post['email'];
				$password = @$this->request->post['password'];
				
				$userData = array(
					'user_email'		=> $email,
					'user_password'		=> $password,
					'user_firstname'	=> $firstname,
					'user_lastname'		=> $lastname,
					'user_status'		=> 1,
					'user_balance'		=> 0,
					'user_access_level'	=> 1
				);
				
				$this->usersModel->createUser($userData);
				
				$mailLib = new mailLibrary();
				
				$mailLib->setFrom($this->config->mail_from);
				$mailLib->setSender($this->config->mail_sender);
				$mailLib->setTo($email);
				$mailLib->setSubject('Регистрация аккаунта');
				
				$mailData = array();
				
				$mailData['firstname'] = $firstname;
				$mailData['lastname'] = $lastname;
				$mailData['email'] = $email;
				$mailData['password'] = $password;
				
				$text = $this->load->view('mail/account/register', $mailData);
				
				$mailLib->setText($text);
				$mailLib->send();
				
				$this->data['status'] = "success";
				$this->data['success'] = "Вы успешно зарегистрировались!";
			} else {
				$this->data['status'] = "error";
				$this->data['error'] = $errorPOST;
			}
		}

		return json_encode($this->data);
	}
	
	private function validatePOST() {
	
		$this->load->library('validate');
		
		$validateLib = new validateLibrary();
		
		$result = null;
		
		$lastname = @$this->request->post['lastname'];
		$firstname = @$this->request->post['firstname'];
		$email = @$this->request->post['email'];
		$password = @$this->request->post['password'];
		$password2 = @$this->request->post['password2'];
		$captcha = @$this->request->post['captcha'];
		
		$captchahash = @$this->session->data['captcha'];
		unset($this->session->data['captcha']);
		
		if(!$validateLib->lastname($lastname)) {
			$result = "Укажите свою реальную фамилию!";
		}
		elseif(!$validateLib->firstname($firstname)) {
			$result = "Укажите свое реальное имя!";
		}
		elseif(!$validateLib->email($email)) {
			$result = "Укажите свой реальный E-Mail!";
		}
		elseif(!$validateLib->password($password)) {
			$result = "Пароль должен содержать от 6 до 32 латинских букв, цифр и знаков <i>,.!?_-</i>!";
		}
		elseif($password != $password2) {
			$result = "Введенные вами пароли не совпадают!";
		}
		elseif($captcha != $captchahash) {
			$result = "Укажите правильный код с картинки! Попробуйте нажать на картинку, чтобы обновить ее.";
		}
		elseif($this->usersModel->getTotalUsers(array('user_email' => $email))) {
			$result = "Указанный E-Mail уже зарегистрирован!";
		}
		return $result;
	}
}
?>
