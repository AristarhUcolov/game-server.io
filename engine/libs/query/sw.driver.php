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
class mineQuery extends QueryBase {
	public function connect($ip, $port) {
		$this->ip = $ip;
		$this->port = $port;
		$this->socket = fsockopen($this->ip, $this->port, $sockError, $sockErrorNum, 2);
		socket_set_timeout($this->socket, 1);
	}
	
	public function disconnect() {
		fclose($this->socket);
	}
	
	private function sendPacket() {
		$packet = "\xFE";
		
		$this->write($packet);
	}
	
	public function getInfo() {
		$this->sendPacket();
		
		var_dump($this->socket);
		if($this->socket != false){while(!feof($this->socket)) $response .= fgets($this->socket);}
        fclose($this->socket);
		
		$response = str_replace("\x00", "", $response);
		$response = explode("\xFF\x16", $response);
		$response = explode("\xA7", $response[1]);
		$data['sv_name'] = $response[0];
		
		$data['sv_map'] = 'No';
		$data['gamemode'] = 'No';
		
		$data['players'] = $response[1];
		$data['sv_max_clients'] = $response[2];
		
		return $data;
	}
}
?>