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
class ssh2Library {
	public function connect($hostname, $username, $password) {
		if($link = ssh2_connect($hostname, 22)) {
			if(ssh2_auth_password($link, $username, $password)) {
				return $link;
			}
		}
		echo 'Ошибка: Не удалось соединиться с сервером!';
		exit("Ошибка: Не удалось соединиться с сервером!");
	}
		
	function execute($link, $cmd) {
		$stream = ssh2_exec($link, $cmd);
		stream_set_blocking($stream, true);
		$output = "";
		while($get = fgets($stream)) {
			$output .= $get;
		}
		fclose($stream);
		return $output;
	}
	
	public function disconnect($link) {
		ssh2_exec($link, "exit");
	}
}
?>
