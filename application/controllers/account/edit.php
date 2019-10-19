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
class editController extends Controller {
	public function index() {
		$this->load->checkLicense();
		$this->document->setActiveSection('account');
		$this->document->setActiveItem('edit');
		$this->load->model('users');
		if(!$this->user->isLogged()) {
			$this->session->data['error'] = "Вы не авторизированы!";
			$this->response->redirect($this->config->url . 'account/login');
		}
		if($this->user->getAccessLevel() < 0) {
			$this->session->data['error'] = "У вас нет доступа к данному разделу!";
			$this->response->redirect($this->config->url);
		}
		
		$userData = array(
			'firstname' => $this->user->getFirstname(),
			'lastname' => $this->user->getLastname(),
			'user_email' => $this->user->getEmail()			
		);
		
		$this->data['user'] = $userData;
		$users = $this->usersModel->getUserById(array('user_id' => (int)$userid), array('users'), array(), $options);
		$this->data['users'] = $users;
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('account/edit', $this->data);
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
		
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$errorPOST = $this->validatePOST();
			if(!$errorPOST) {
				$lastname = @$this->request->post['lastname'];
				$firstname = @$this->request->post['firstname'];
				$user_email = @$this->request->post['user_email'];
				$user_img = @$this->request->post['user_img'];
				$editpassword = @$this->request->post['editpassword'];
				$password = @$this->request->post['password'];
				
				$userid = $this->user->getId();
				
				$userData = array(
					'user_firstname'	=> $firstname,
					'user_lastname'		=> $lastname,
					'user_email'		=> $user_email,
					'user_img'		    => $user_img
				);
				
				if($editpassword) {
					$userData['user_password'] = $password;
				}
				
				$this->usersModel->updateUser($userid, $userData);
				
				$this->data['status'] = "success";
				$this->data['success'] = "Изменения сохранены!";
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
		$user_email = @$this->request->post['user_email'];
		$editpassword = @$this->request->post['editpassword'];
		$password = @$this->request->post['password'];
		$password2 = @$this->request->post['password2'];
		
		if(!$validateLib->lastname($lastname)) {
			$result = "Укажите свою реальную фамилию!";
		}
		elseif(!$validateLib->firstname($firstname)) {
			$result = "Укажите свое реальное имя!";
		}
		elseif($editpassword) {
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
