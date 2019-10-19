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
class DB {
	private $driver;
	
	public function __construct($driver, $hostname, $username, $password, $database) {
		$class = $driver . 'Driver';
		if(is_readable(ENGINE_DIR . 'database/' . $driver . '.php')) {
			require_once(ENGINE_DIR . 'database/' . $driver . '.php');
		} else {
			exit('Ошибка: Не удалось загрузить драйвер базы данных ' . $driver . '!');
		}
		$this->driver = new $class($hostname, $username, $password, $database);
	}
		
  	public function query($sql) {
		return $this->driver->query($sql);
  	}
	
	public function escape($value) {
		return $this->driver->escape($value);
	}
	
  	public function countAffected() {
		return $this->driver->countAffected();
  	}
  	public function getLastId() {
		return $this->driver->getLastId();
  	}
  	public function getCount() {
		return $this->driver->getCount();
  	}
}
?>
