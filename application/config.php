<?php
/*
Copyright (c) 2016 HOSTING RUS

Данная лицензия разрешает лицам, получившим копию данного программного обеспечения
и сопутствующей документации (в дальнейшем именуемыми «Программное Обеспечение»),
безвозмездно использовать Программное Обеспечение в  личных целях, включая неограниченное
право на использование, копирование, изменение, добавление, публикацию, распространение,
также как и лицам, которым запрещенно использовать Програмное Обеспечение в коммерческих целях,
предоставляется данное Программное Обеспечение,при соблюдении следующих условий:

Developed by LiteDevel
*/
$config = array(
	// Название компании.
	// Пример: ExampleHost
	'title'			=>		'Панель игрового хостинга',
	
	// Описание компании (meta description).
	// Пример: Game Hosting ExampleHost
	'description'	=>		'Hos7.Ru',
	
	// Ключевые слова (meta keywords).
	// Пример: game hosting, game servers
	'keywords'		=>		'game hosting, game servers, hostin rus, hostin 5.1, hostin, hos7 ru',
	
	// URL панели управления.
	// Обратите внимание на то, что панель управления должна располагаться в корне (под)домена.
	// http://example.com/, http://cp.example.com/, http://panel.example.com/ - правильно.
	// http://example.com/panel/ - неправильно.
	'url'			=>		'http://hos7.ru/',
	
	// Токен.
	// Используется для запуска скриптов из Cron`а.
	'token'			=>		'tokenxd',
	
	// Тип СУБД.
	// По умолчанию поддерживается только СУБД MySQL (mysql).
	'db_type'		=>		'mysql',
	
	// Хост БД.
	// Пример: localhost, 127.0.0.1, db.example.com и пр.
	'db_hostname'	=>		'127.0.0.1',
	
	// Имя пользователя СУБД.
	'db_username'	=>		'root',
	
	// Пароль пользователя СУБД.
	'db_password'	=>		'pass',
	
	// Название БД.
	'db_database'	=>		'game',
	
	// E-Mail отправителя.
	// Пример: support@example.com, noreply@example.com
	'mail_from'		=>		'support@hos7.ru',
	
	// Имя отправителя.
	// Пример: ExampleHost Support
	'mail_sender'	=>		'Hos7.Ru || Администрация',
	
	// URL мерчанта.
	// Для активированных аккаунтов - https://merchant.roboxchange.com
	// Для неактивированных аккаунтов - http://test.robokassa.ru/Index.aspx
	'rk_server'		=>		'https://merchant.roboxchange.com',
	
	// Логин в системе ROBOKASSA.
	'rk_login'		=>		'login',
	
	// Пароль №1 в системе ROBOKASSA.
	'rk_password1'	=>		'pass1',
	
	// Пароль №2 в системе ROBOKASSA.
	'rk_password2'	=>		'pass2',
	
	//UNITPAY URL
	'unitpay_url'	=>		'https://unitpay.ru/pay',
	
	//UNITPAY секретный ключ 
	'unitpay_secret'=>		'dcbadedcda6a9ca3f8e1cf89db37f3d0'
);
?>