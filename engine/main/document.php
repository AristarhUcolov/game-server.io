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
class Document {
	private $title;
	private $activeSection;
	private $activeItem;
	private $scripts = array();
	
	/* Заголовок страницы */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	/* Активный раздел меню */
	public function setActiveSection($section) {
		$this->activeSection = $section;
	}
	
	public function getActiveSection() {
		return $this->activeSection;
	}
	
	/* Активный элемент меню */
	public function setActiveItem($item) {
		$this->activeItem = $item;
	}
	
	public function getActiveItem() {
		return $this->activeItem;
	}
	
	/* Скрипты */
	public function addScript($script) {
		$this->scriptsarray[] = $script;
	}
	
	public function getScripts() {
		return $this->scripts;
	}
}
?>
