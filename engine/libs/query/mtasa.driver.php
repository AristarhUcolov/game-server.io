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
class mtasaQuery extends QueryBase {
	public function connect($ip, $port) {
		$this->ip = $ip;
		$this->port = $port;
		$this->socket = fsockopen('udp://' . $this->ip, $this->port + 123, $sockError, $sockErrorNum, 2);
		socket_set_timeout($this->socket, 1);
	}
	
	public function disconnect() {
		fclose($this->socket);
	}
	
	private function sendPacket() {
		$packet = "s";
		
		$this->write($packet);
	}
	
	public function getInfo() {
		$this->sendPacket();
		
		if($this->read(4) != "EYE1") return false;
		
		$this->readStringLen();
		$this->readStringLen();
		$data['hostname'] = (string)$this->readStringLen();
		$data['gamemode'] = (string)$this->readStringLen();
		$data['mapname'] = (string)$this->readStringLen();
		$this->readStringLen();
		$data['password'] = (bool)$this->readStringLen();
		$data['players'] = (int)$this->readStringLen();
		$data['maxplayers'] = (int)$this->readStringLen();
		
		return $data;
	}
	
	function readStringLen() {
		$len = $this->readInt8();
		return $this->read($len-1);
	}
}
?>