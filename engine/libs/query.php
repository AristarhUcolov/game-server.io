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
class queryLibrary {
	private $driver;
	
	public function __construct($driver) {
		$class = $driver . 'Query';
		if(is_readable(ENGINE_DIR . 'libs/query/base.php')) {
			require_once(ENGINE_DIR . 'libs/query/base.php');
		} else {
			exit('Ошибка: Не удалось загрузить базовый query-драйвер!');
		}
		if(is_readable(ENGINE_DIR . 'libs/query/' . $driver . '.driver.php')) {
			require_once(ENGINE_DIR . 'libs/query/' . $driver . '.driver.php');
		} else {
			exit('Ошибка: Не удалось загрузить query-драйвер ' . $driver . '!');
		}
		$this->driver = new $class();
	}
		
  	public function connect($ip, $port) {
		return $this->driver->connect($ip, $port);
  	}
	
  	public function disconnect() {
		return $this->driver->disconnect();
  	}
	
  	public function getInfo() {
		return $this->driver->getInfo();
  	}
}
?>
