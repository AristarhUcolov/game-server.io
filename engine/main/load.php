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
class Load {
	private $registry;

	public function __construct($registry) {
		$this->registry = $registry;
	}
	
	public function view($name, $vars = array()){
		$file = APPLICATION_DIR . 'views/' . $name . '.php';
		if(is_readable($file)){
			extract($vars);
			
	  		ob_start();
	  		include($file);
	  		$content = ob_get_contents();
	  		ob_end_clean();
			
	  		return $content;
		}
		exit('Ошибка: Не удалось загрузить шаблон ' . $name . '!');
	}
	
	public function model($name){
		$modelClass = $name . 'Model';
		$modelPath = APPLICATION_DIR . 'models/' . $name . '.php';
		
		if(is_readable($modelPath)){
			require_once($modelPath);
			if(class_exists($modelClass)){
				$this->registry->$modelClass = new $modelClass($this->registry);
				return true;
			}
		}
		exit('Ошибка: Не удалось загрузить модель ' . $name . '!');
	}
	
	public function library($name){
		$libClass = $name . 'Library';
		$libPath = ENGINE_DIR . 'libs/' . $name . '.php';
		
		if(is_readable($libPath)){
			require_once($libPath);
			return true;
		}
		exit('Ошибка: Не удалось загрузить библиотеку ' . $name . '!');
	}
	
	public function checkLicense() {
		
	}

}
?>
