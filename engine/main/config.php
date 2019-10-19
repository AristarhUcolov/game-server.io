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
class Config {
	private $data = array();
	
	public function __construct() {
		if(is_readable(APPLICATION_DIR . 'config.php')) {
			require_once(APPLICATION_DIR . 'config.php');
			$this->data = array_merge($this->data, $config);
			return true;
		}
		exit('Ошибка: Не удалось загрузить файл конфигурации!');
	}
	
	public function __set($key, $val){
		$this->data[$key] = $val;
	}
	
	public function __get($key){
		if(isset($this->data[$key])){
			return $this->data[$key];
		}
		return false;
	}
}
?>
