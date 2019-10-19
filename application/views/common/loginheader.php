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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $description ?>">
	<meta name="keywords" content="<?php echo $keywords ?>">
	<meta name="generator" content="Hos7.Ru">
	
	<title><?php echo $title ?> | <?php echo $description ?></title>
    
    <link href="/application/public/css/main.css" rel="stylesheet">
	<link href="/application/public/css/bootstrap.css" rel="stylesheet">
	
	<script src="/application/public/js/jquery.min.js"></script>
	<script src="/application/public/js/jquery.form.min.js"></script>
	<script src="/application/public/js/bootstrap.min.js"></script>
	<script src="/application/public/js/main.js"></script>
	
	<style>
		body {
			padding-top: 72px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" target="_blank" href="/">HOSTIN 5.1</a>
		</div>
	</div>
</div>
	<!-- Powered by LitePanel -->
	<div id="content" class="container">
		<?php if(isset($error)): ?><div class="alert alert-danger"><strong>Ошибка!</strong> <?php echo $error ?></div><?php endif; ?> 
		<?php if(isset($warning)): ?><div class="alert alert-warning"><strong>Внимание!</strong> <?php echo $warning ?></div><?php endif; ?> 
		<?php if(isset($success)): ?><div class="alert alert-success"><strong>Выполнено!</strong> <?php echo $success ?></div><?php endif; ?> 

<style>

	body {

  margin: 0;
  font: 12px/1.7em 'Open Sans', arial, sans-serif;
  background: #000 url("/application/public/img/bg.png") center top no-repeat;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 1.428571429;
  color: #000;
  background-color: #000
	}

	</style>
</head>

<body>
