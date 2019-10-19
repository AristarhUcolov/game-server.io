<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Copyright" content="arirusmanto.com">
<meta name="description" content="Admin MOS Template">
<meta name="keywords" content="Admin Page">
<meta name="author" content="Ari Rusmanto">
<meta name="language" content="Bahasa Indonesia">

<link rel="shortcut icon" href="/application/public/css/mos-css/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="/application/public/css/mos-css/mos-style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
	<div class="inHeader">
		<div class="mosAdmin">
		Привет, Администратор <?php echo $user_firstname ?>!<br>
		<a href="/">Главная</a> | <a href="/account/logout">Выход</a>
		</div>
	<div class="clear"></div>
	</div>
</div>

<div id="wrapper">
	<div id="leftBar">
	<ul>
		<li><a href="/admin">Главная</a></li>
	</ul>
	</div>
	<div id="rightContent">
	<h3><?if($user_access_level == 3):?>Админ-панель<?elseif($user_access_level == 2):?>Панель тех. поддержки<?endif;?></h3>

		<div class="shortcutHome">
		<a href="/admin/servers"><img src="/application/public/css/mos-css/img/photo.png"><br>Все сервера</a>
		</div>
		<div class="shortcutHome">
		<a href="/admin/users"><img src="/application/public/css/mos-css/img/halaman.png"><br>Все пользователи</a>
		</div>
		<div class="shortcutHome">
		<a href="/news/create"><img src="/application/public/css/mos-css/img/posting.png"><br>Создать новость</a>
		</div>
		<div class="shortcutHome">
		<a href="/admin/tickets"><img src="/application/public/css/mos-css/img/template.png"><br>Все запросы</a>
		</div>
		<div class="shortcutHome">
		<a href="/admin/invoices"><img src="/application/public/css/mos-css/img/quote.png"><br>Все счета</a>
		</div>
		<?if($user_access_level == 3):?>
		<div class="shortcutHome">
		<a href="/admin/games"><img src="/application/public/css/mos-css/img/bukutamu.png"><br>Все игры</a>
		</div>
				<div class="shortcutHome">
		<a href="/admin/locations"><img src="/application/public/css/mos-css/img/bukutamu.png"><br>Все локации</a>
		</div>
		<?endif;?>
		<div class="clear"></div>
		
		
	</div>
<div class="clear"></div>
<div id="footer">
	&copy; 2016 (c) HOS7.RU 
</div>
</div>
</body>
</html>