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
<?php echo $header ?>
 <style>
   .thumb img  {
    border: 2px solid #55c5e8; /* Рамка вокруг фотографии */
    padding: 15px; /* Расстояние от картинки до рамки */
    background: #666; /* Цвет фона */
    margin-bottom: -17px; /* Отступ снизу */
	margin-left: -6px;
	margin-right: -6px;
	margin-top: -6px;
	opacity: 0.7; /* Значение прозрачности */
    filter: alpha(Opacity=30); /* Прозрачность в IE */
   }
  </style>



  <body>
				    						<section class="content-header no-margin">
                    <h1 class="text-center">
                     Панель управления игровым хостингом HOSTIN 5.1   
                    </h1>
                </section>
				<section class="content">
				<div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
</div></div>
<div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua" style="border-radius:10px;">
                                <div class="inner">
                                    <h3>
                                        Заказ
                                    </h3>
                                    <p>
                                        Игрового сервера
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/servers/order" class="small-box-footer" style="border-radius:10px;">
                                    Заказать <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green" style="border-radius:10px;">
                                <div class="inner">
                                    <h3>
                                        100<sup style="font-size: 20px">%</sup>
                                    </h3>
                                    <p>
                                        Скидка
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/servers/order" class="small-box-footer" style="border-radius:10px;">
                                    Бесплатно <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow" style="border-radius:10px;">
                                <div class="inner">
                                    <h3>
                                        100+
                                    </h3>
                                    <p>
                                        Серверов
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="/monitor" class="small-box-footer" style="border-radius:10px;">
                                    Мониторинг <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red" style="border-radius:10px;">
                                <div class="inner">
                                    <h3>
                                        99.9<sup style="font-size: 20px">%</sup>
                                    </h3>
                                    <p>
                                        Uptime
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="/servers/order" class="small-box-footer" style="border-radius:10px;">
                                    Бесплатно <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div>
					<div class="row">	
	<div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-red">
                                        Качество
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-light blue-soft" style="height: 120px; border-radius:10px;">
			<div class="visual">
				<i class="fa fa-gears"></i>
			</div>
			<div class="details">
				<div class="number" style="font-size: 18px;">
					Простая панель управления
				</div>
				<div class="desc" style="font-size: 11px;text-align: justify;padding-left: 34px;">
					Может показаться, что управление игровым сервером не всегда легко, но с панелью управления HOSTIN 5.1
                     управлять сервером легко и просто.
				</div>
			</div>
		</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-light blue-ebonyclay" style="height: 120px; border-radius:10px;">
			<div class="visual">
				<i class="fa fa-cloud-download"></i>
			</div>
			<div class="details">
				<div class="number" style="font-size: 18px;">
					Моментальная установка сервера
				</div>
				<div class="desc" style="font-size: 11px;text-align: justify;padding-left: 34px;">
					Все операции с сервером выполняются в автоматическом режиме. Установка карт, модов и
					плагинов в один клик. Выполнение заданий по расписанию и многое другое.
				</div>
			</div>
		</div>
	</div>

                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>
                                    	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-light green-soft" style="height: 120px; border-radius:10px;">
			<div class="visual">
				<i class="fa fa-globe"></i>
			</div>
			<div class="details">
				<div class="number" style="font-size: 18px;">
					Низкий пинг, высокая надежность
				</div>
				<div class="desc" style="font-size: 11px;text-align: justify;padding-left: 34px;">
					Минимальный для России пинг, вы предоставляете своим пользователям игру без задержек, что исключительно высоко ценится в сфере онлайн-игр.
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-light red-soft" style="height: 120px; border-radius:10px;">
			<div class="visual">
				<i class="fa fa-folder-open"></i>
			</div>
			<div class="details">
				<div class="number" style="font-size: 18px;">
					FTP-доступ
				</div>
				<div class="desc" style="font-size: 11px;text-align: justify;padding-left: 34px;">
					FTP-доступ по отдельному протоколу передачи вы имеете право в любое время суток и в
					режиме онлайн изменить любые настройки сервера.
				</div>
			</div>
		</div>
	</div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-green">
                                        Надежность
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
								<li>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-light purple-soft" style="height: 120px; border-radius:10px;">
			<div class="visual">
				<i class="fa fa-clock-o"></i>
			</div>
			<div class="details">
				<div class="number" style="font-size: 18px;">
					Высокий Uptime
				</div>
				<div class="desc" style="font-size: 11px;text-align: justify;padding-left: 34px;">
					Быстрая и непрерывная работа сервера надежность работы выделенного канала гарантирована
					профессиональной техникой, которую использует наша компания.
				</div>
			</div>
		</div>
	</div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-light yellow-gold" style="height: 120px; border-radius:10px;">
			<div class="visual">
				<i class="fa fa-tasks"></i>
			</div>
			<div class="details">
				<div class="number" style="font-size: 18px;">
					Оборудование
				</div>
				<div class="desc" style="font-size: 11px;text-align: justify;padding-left: 34px;">
					Наша компания покупает и использует только самое лучшее и современное серверное
					оборудование, которое позволяет игрокам насладиться игрой без задержек и провисаний
					FPS.
				</div>
			</div>
		</div>
	</div>
	</li>
                                <!-- END timeline item -->
                            </ul>
                        </div>


					<!-- Start SiteHeart code -->
<script>
(function(){
var widget_id = 660856;
_shcp =[{widget_id : widget_id}];
var lang =(navigator.language || navigator.systemLanguage 
|| navigator.userLanguage ||"en")
.substr(0,2).toLowerCase();
var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
var hcc = document.createElement("script");
hcc.type ="text/javascript";
hcc.async =true;
hcc.src =("https:"== document.location.protocol ?"https":"http")
+"://"+ url;
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hcc, s.nextSibling);
})();
</script>
<!-- End SiteHeart code -->
<?php echo $footer ?>
