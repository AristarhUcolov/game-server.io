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
class User {
	private $registry;

	private $user_id;
	private $email;
	private $firstname;
	private $lastname;
	private $balance;
	private $access_level;
    private $user_img;
	private $test_server;
	
  	public function __construct($registry) {
		$this->registry = $registry;
		if (isset($this->registry->session->data['user_id'])) {
			$query = $this->registry->db->query("SELECT * FROM users WHERE user_id = '" . (int)$this->registry->session->data['user_id'] . "' AND user_status = '1'");
			
			if ($query->num_rows) {
				$this->user_id = $query->row['user_id'];
				$this->email = $query->row['user_email'];
				$this->firstname = $query->row['user_firstname'];
				$this->lastname = $query->row['user_lastname'];
				$this->balance = $query->row['user_balance'];
				$this->access_level = $query->row['user_access_level'];
				$this->user_img = $query->row['user_img'];
				$this->test_server = $query->row['test_server'];
			} else {
				$this->logout();
			}
		}
  	}
		
  	public function login($email, $password) {
		$query = $this->registry->db->query("SELECT * FROM users WHERE user_email = '" . $this->registry->db->escape($email) . "' AND user_password = '" . $this->registry->db->escape($password) . "' AND user_status = '1'");

		if($query->num_rows) {
			$this->registry->session->data['user_id'] = $query->row['user_id'];
			
			$this->user_id = $query->row['user_id'];
			$this->email = $query->row['user_email'];
			$this->firstname = $query->row['user_firstname'];
			$this->lastname = $query->row['user_lastname'];
			$this->balance = $query->row['user_balance'];
			$this->access_level = $query->row['user_access_level'];
			$this->user_img = $query->row['user_img'];	
            $this->test_server = $query->row['test_server'];			
	  		return true;
		} else {
	  		return false;
		}
  	}

  	public function logout() {
		unset($this->registry->session->data['user_id']);
	
		$this->user_id = null;
		$this->email = null;
		$this->firstname = null;		
		$this->lastname = null;
		$this->balance = null;
		$this->access_level = 0;
  	}
  
  	public function isLogged() {
		return $this->user_id;
  	}
  
  	public function getId() {
		return $this->user_id;
  	}
	
  	public function getEmail() {
		return $this->email;
  	}
	
  	public function getFirstname() {
		return $this->firstname;
  	}
  	public function getLastname() {
		return $this->lastname;
  	}
	public function getUser_img() {
		return $this->user_img;
  	}
	public function getTest() {
		return $this->test_server;
  	}
  	public function getBalance() {
		return $this->balance;
  	}
	
  	public function getAccessLevel() {
		return $this->access_level;
  	}
}
?>
