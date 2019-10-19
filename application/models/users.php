<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
class usersModel extends Model {
	public function createUser($data) {
		$sql = "INSERT INTO `users` SET ";
		$sql .= "user_email = '" . $this->db->escape($data['user_email']) . "', ";
		$sql .= "user_password = '" . $this->db->escape($data['user_password']) . "', ";
		$sql .= "user_firstname = '" . $this->db->escape($data['user_firstname']) . "', ";
		$sql .= "user_lastname = '" . $this->db->escape($data['user_lastname']) . "', ";
		$sql .= "user_status = '" . (int)$data['user_status'] . "', ";
		$sql .= "user_balance = '" . (float)$data['user_balance'] . "', ";
		$sql .= "user_access_level = '" . (int)$data['user_access_level'] . "', ";
		$sql .= "user_date_reg = NOW()";
		$this->db->query($sql);
		return $this->db->getLastId();
	}
	
	public function deleteTicketMessage($userid) {
		$sql = "DELETE FROM `users` WHERE user_id = '" . (int)$userid . "'";
		$this->db->query($sql);
	}
	
	public function updateUser($userid, $data = array()) {
		$sql = "UPDATE `users`";
		if(!empty($data)) {
			$count = count($data);
			$sql .= " SET";
			foreach($data as $key => $value) {
				$sql .= " $key = '" . $this->db->escape($value) . "'";
				
				$count--;
				if($count > 0) $sql .= ",";
			}
		}
		$sql .= " WHERE `user_id` = '" . (int)$userid . "'";
		$query = $this->db->query($sql);
		return true;
	}
		public function getUser($data = array(), $sort = array(), $options = array()) {
		$sql = "SELECT * FROM `users`";
		if(!empty($data)) {
			$count = count($data);
			$sql .= " WHERE";
				$sql .= " $key = '" . $this->db->escape($value) . "'";
				
				$count--;
				if($count > 0) $sql .= " AND";
		}
		
		if(!empty($sort)) {
			$count = count($sort);
			$sql .= " ORDER BY";
				$sql .= " $key " . $value;
				
				$count--;
				if($count > 0) $sql .= ",";

		}
		
		if(!empty($options)) {
			if($options['start'] < 0) {
				$options['start'] = 0;
			}
			if($options['limit'] < 1) {
				$options['limit'] = 20;
			}
			$sql .= " LIMIT " . (int)$options['start'] . "," . (int)$options['limit'];
		}
		$query = $this->db->query($sql);
		return $query->rows;
	}
	public function getUsers($data = array(), $sort = array(), $options = array()) {
		$sql = "SELECT * FROM `users`";
		if(!empty($data)) {
			$count = count($data);
			$sql .= " WHERE";
			foreach($data as $key => $value) {
				$sql .= " $key = '" . $this->db->escape($value) . "'";
				
				$count--;
				if($count > 0) $sql .= " AND";
			}
		}
		
		if(!empty($sort)) {
			$count = count($sort);
			$sql .= " ORDER BY";
			foreach($sort as $key => $value) {
				$sql .= " $key " . $value;
				
				$count--;
				if($count > 0) $sql .= ",";
			}
		}
		
		if(!empty($options)) {
			if($options['start'] < 0) {
				$options['start'] = 0;
			}
			if($options['limit'] < 1) {
				$options['limit'] = 20;
			}
			$sql .= " LIMIT " . (int)$options['start'] . "," . (int)$options['limit'];
		}
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getUserById($userid) {
		$sql = "SELECT * FROM `users` WHERE `user_id` = '" . (int)$userid . "' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row;
	}
	public function getUserByEmail($useremail) {
		$sql = "SELECT * FROM `users` WHERE `user_email` = '" . $this->db->escape($useremail) . "' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row;
	}
	public function getUserByImg($userimg) {
		$sql = "SELECT * FROM `users` WHERE `user_img` = '" . $this->db->escape($userimg) . "' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row;
	}
		public function getUserByTest($test_server) {
		$sql = "SELECT * FROM `users` WHERE `test_server` = '" . $this->db->escape($test_server) . "' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row;
	}
	public function getTotalUsers($data = array()) {
		$sql = "SELECT COUNT(*) AS count FROM `users`";
		if(!empty($data)) {
			$count = count($data);
			$sql .= " WHERE";
			foreach($data as $key => $value) {
				$sql .= " $key = '" . $this->db->escape($value) . "'";
				
				$count--;
				if($count > 0) $sql .= " AND";
			}
		}
		$query = $this->db->query($sql);
		return $query->row['count'];
	}
	
	public function upUserBalance($userid, $value) {
	  	$query = $this->db->query("UPDATE `users` SET user_balance = user_balance+" . (float)$value . " WHERE user_id = '" . (int)$userid . "'");
	}
	
	public function downUserBalance($userid, $value) {
	  	$query = $this->db->query("UPDATE `users` SET user_balance = user_balance-" . (float)$value . " WHERE user_id = '" . (int)$userid . "'");
	}
	public function createAuthLog($userid, $ip, $status, $password) {
		$ipDetail=array();
		$f = file_get_contents("http://api.hostip.info/?ip=".$ip);
		 
		//Получаем название города
		preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si", $f, $city);
		$ipDetail['city'] = ($city AND $city[2]) ? $city[2] : ''; 
		 
		//Получаем название страны
		preg_match("@<countryName>(.*?)</countryName>@si", $f, $country);
		$ipDetail['country'] = $country[1];
		 
		//Получаем код страны
		preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si", $f, $countryCode);
		$ipDetail['countryCode'] = $countryCode[1];
		
	  	$query=$this->db->query("INSERT INTO `authlog` (`id`, `user`, `ip`, `city`, `country`, `code`, `datetime`, `status`, `password`) VALUES (NULL, '".$userid."', '".$ip."', '".$ipDetail['city']."', '".$ipDetail['country']."', '".$ipDetail['countryCode']."', NOW(), '".$status."', '".$password."');");
	}
	
	public function getAuthLog($userid) {
		$sql = "SELECT * FROM `authlog` WHERE `user` = '".(int)$userid."' ORDER BY(`id`) DESC LIMIT 20";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getIdByEmail($email) {
		$sql = "SELECT `user_id` FROM `users` WHERE `user_email` = '" . $this->db->escape($email) . "' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row;
	}
	
	public function getSkidkaByCode($code, $rewrite) {
		$sql = "SELECT `skidka` FROM `promo` WHERE `cod` = '" . $this->db->escape($code) . "' AND `used` < `replace` LIMIT 1";
		$query = $this->db->query($sql);
		
		if($rewrite == true){
			$zapros = $this->db->query("UPDATE `promo` SET `used`= `used`+1 WHERE `cod` = '" . $this->db->escape($code) . "' AND `used` < `replace` LIMIT 1");
		}
		return $query->row;
	}
}
?>
