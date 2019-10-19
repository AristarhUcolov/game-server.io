<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $description ?>">
	<meta name="keywords" content="<?php echo $keywords ?>">
	<meta name="generator" content="Hos7.Ru">
	<style>
body {
  background: url("http://subtlepatterns.com/patterns/debut_dark.png");
}
</style>
	<title><?php echo $title ?> | <?php echo $description ?></title>


	<script src="/application/public/js/menu/jquery.min.js"></script>
	<script src="/application/public/js/menu/jquery.form.min.js"></script>
	<script src="/application/public/js/menu/jquery.flot.min.js"></script>
	<script src="/application/public/js/menu/jquery.flot.time.min.js"></script>
	<script src="/application/public/js/menu/bootstrap.min.js"></script>
	<script src="/application/public/js/menu/main.js"></script>
    <script type="text/javascript" src="/application/public/js/menu/jquery.fancybox-1.3.0.pack.js"></script>
	<link href="http://thebest-hosting.ru/css/bootstrap-theme.css" rel="stylesheet">
	
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="/application/public/css/menu/morris.css" rel="stylesheet" type="text/css" />
	<link href="/application/public/css/menu/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
	<link href="/application/public/css/menu/datepicker3.css" rel="stylesheet" type="text/css" />
	<link href="/application/public/css/menu/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
	<link href="/application/public/css/menu/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	<link href="/application/public/css/menu/AdminLTE.css" rel="stylesheet" type="text/css" />

	<style>
	
.speed_bar a {
	background: url(/application/public/img/arrow.png) no-repeat right;
	padding-right: 13px;
	color: #535353;
}

.speed_bar a:hover {
	text-decoration: underline;
}

.speed_bar span {
	color: #d8780b;
	text-shadow: 0 1px 0 rgba(102, 102, 102, 0.1);
}
.block_speedbar{
	margin-bottom: 0px;
	-webkit-border-radius: 6px 6px 0px 0px !important;
	-moz-border-radius: 6px 6px 0px 0px !important;
	border-radius: 6px 6px 0px 0px !important;
}
.full_block {
	border-radius: 6px !important;
}

.full_block>.block_content {
	border-radius: 6px !important;
}
.block_content {
	border: 1px solid #dbdbdb;
	border-bottom-left-radius: 6px;
	border-top-left-radius: 6px;
	background: #f7f6f4;
	padding: 13px;
}
.block_title {
	color: #646464;
	text-align: center;
	margin-bottom: 10px;
	text-shadow: 0 1px 0 rgba(102, 102, 102, 0.1);
}

.content_block {
	border-bottom-right-radius: 6px !important;
	border-top-right-radius: 6px !important;
	border-top-left-radius: 0 !important;
	border-bottom-left-radius: 0 !important;
}

.content_block>.block_content {
	border-bottom-right-radius: 6px !important;
	border-top-right-radius: 6px !important;
	border-top-left-radius: 0 !important;
	border-bottom-left-radius: 0 !important;
}
	</style>
		
	</head>
	<body class="skin-blue">
        <!---->
        <header class="header">
            <a href="/" class="logo">
                <!---->
			HOSTIN 5.1
            </a>
            <!---->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-success">:)</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Новости</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
									<?php foreach($tickets as $item): ?> 
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                <img src="/application/public/img/avatar5.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    <?php echo $item['news_title'] ?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo date("d.m.Y в H:i", strtotime($item['news_date_add'])) ?></small>
                                                </h4>
                                                <p><?echo $item['news_text'] ?></p>
                                            </a>
                                        </li><!-- end message -->
										<?php endforeach; ?> 
                                    </ul>
                                </li>
                                <li class="footer"><a href="/news">Все новости</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <td><?php echo $user_firstname ?> <?php echo $user_lastname ?></td>
                            </a>
                            <ul class="dropdown-menu">

                                <!-- Menu Body -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/account/unitpay" class="btn btn-default btn-flat">Баланс</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/account/logout" class="btn btn-danger btn-flat">Выйти</a>
                                    </div>
                                </li>
                            </ul>
						</ul>
					</div>
				</nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img  class="img-circle" src="<?if($users['user_img']):?>  <?echo $users['user_img']?> <?elseif(empty($users['user_img'])):?>/application/public/images/avatars/avatar.png<?endif;?>" style="">	
                        </div>
                        <div class="pull-left info">
                            <p>Привет, <?php echo $user_firstname ?></p>
                            <p><a href="/account/pay"><i class="fa  fa-ruble"></i>&nbsp; <?php echo $user_balance ?></a></p>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
					  </li>
                        <li>
                            <a href="/">
                                <i class="fa fa-align-left"></i> <span>Главная Страница</span>
                            </a>
                        </li>
                        <li>
                            <a href="/servers/order">
                                <i class="fa fa-th"></i> <span>Заказать сервер</span> <small class="badge pull-right bg-green">NEW</small>
                            </a>
                        </li>
                        <li>
                            <a href="/account/pay">
                                <i class="fa fa-money"></i> <span>Пополнить баланс</span> <small class="badge pull-right bg-green">NEW</small>
                            </a>
                        </li>
						  <li>
                            <a href="/tickets">
                                <i class="fa fa-envelope"></i> <span>Тех. поддержка</span>
                            </a>
                        </li>
                        <li>
                            <a href="/servers">
                                <i class="fa fa-laptop"></i> <span>Мои сервера</span>
                            </a>
                        </li>
                        <li>
						<a href="/account/edit">
                                <i class="fa fa-cogs"></i> <span>Настройки</span>
                            </a>
						</li>
                        <li>
							<a href="/news">
                                <i class="fa fa-calendar"></i> <span>Новости</span>
                            </a>
													</li>
                        <li>
							<a href="/admin/panel">
                                <i class="fa fa-tasks"></i> <span>Админ-Панель</span>
                            </a>
                            <li>
                            <a href="/account/logout">
                                <i class="fa fa-sign-out"></i> <span>Выйти</span>
                            </a>
                        </li>
                </section>
                <!-- /.sidebar -->
            </aside>
<aside class="right-side">  


                    <!-- Small boxes (Stat box) -->


       <!-- ./wrapper -->

        <!-- add new calendar event modal -->



        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="/application/public/js/menu/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="/application/public/js/menu/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="/application/public/js/menu/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="/application/public/js/menu/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="/application/public/js/menu/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="/application/public/js/menu/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="/application/public/js/menu/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/application/public/js/menu/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="/application/public/js/menu/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->

		<script src="/application/public/js/menu/app.js" type="text/javascript"></script>


        <!-- AdminLTE for demo purposes -->
        <script src="/application/public/js/menu/demo.js" type="text/javascript"></script>



 <div id="content" class="conteiner">
				<?php if(isset($error)): ?><div class="error"><strong>Ошибка!</strong> <?php echo $error ?></div><?php endif; ?>
				<?php if(isset($warning)): ?><div class="warning"><strong>Внимание!</strong> <?php echo $warning ?></div><?php endif; ?> 
				<?php if(isset($success)): ?><div class="success"><strong>Выполнено!</strong> <?php echo $success ?></div><?php endif; ?> 