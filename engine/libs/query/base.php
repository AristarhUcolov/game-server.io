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
class QueryBase {
	protected $ip;
	protected $port;
	
	protected $socket;
	
	protected function write($bytes) {
		return fwrite($this->socket, $bytes);
	}
	
	protected function readInt8() {
		return ord($this->read(1));
	}
	
	protected function readInt16() {
		$int = unpack('Sint', $this->read(2));
		return $int['int'];
	}
	
	protected function readString() {
		$string = null;
		while(($char = $this->read(1)) != "\x00") {
			$string .= $char;
		}
		return $string;
	}
	
	protected function read($len) {
		return fread($this->socket, $len);
	}
}
?>