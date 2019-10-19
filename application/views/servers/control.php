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
                   	    <script type="text/javascript">
		$(document).ready(function() {
		$("a#single_image").fancybox();
		$("a.grouped_elements").fancybox();
		$("a#inline").fancybox({
	        'hideOnContentClick': true
	        });
	        $("a.group").fancybox({
	        'speedIn'           :       600, 
	        'speedOut'          :       200, 
		'overlayShow'       :       false
	        });
	        });
	    </script>
<style>

#owl-demo {
display: -webkit-box;
overflow: hidden;
} 

#owl-demo .item{
margin: 0 3px;
}

#owl-demo .item img{
  display: block;
  w1idth: auto;
  h1eight: 100%;
}
.section_c_p{padding:5px 0 0 0;display:inline-block;}
.grouped_elements img{border:2px solid #e5e5e5;}
.grouped_elements:hover img{border:2px solid #ccc;}
.curved-hz-1{border:1px solid #bbb;-webkit-box-shadow:0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;-moz-box-shadow:0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;box-shadow:0 4px 5px 0 rgba(0, 0, 0, 0.2), 0 1px 4px rgba(0, 0, 0, 0.2), 0 0 40px rgba(0, 0, 0, 0.1) inset;margin:0 5px 10px 5px;padding:1px;}
.curved-hz-2{float:left;border:1px solid #bbb;-webkit-box-shadow:0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;-moz-box-shadow:0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;box-shadow:0 4px 5px 0 rgba(0, 0, 0, 0.2), 0 1px 4px rgba(0, 0, 0, 0.2), 0 0 40px rgba(0, 0, 0, 0.1) inset;margin:3px 10px 0 0;padding:1px;}
#div-demo{font-size:13px;line-height:140%;color:#333;border-bottom:1px dashed #bcbcbc;margin:0 0 10px;border:none;}
#div-demo b{color:#494949;}
   .leftstr, .rightstr {
    float: left; /* Обтекание справа */ 
    width: 50%; /* Ширина текстового блока */ 
   }
   .rightstr {
    text-align: right; /* Выравнивание по правому краю */ 
   }
</style>

<link rel="stylesheet" href="/application/public/css/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="/application/public/css/owl-carousel/owl.theme.css">
                <script type="text/javascript" src="/application/public/js/jquery.fancybox-1.3.0.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="/application/public/css/jquery.fancybox-1.3.0.css" media="screen" />  
		<script type="text/javascript" src="/application/public/js/owl.carousel.min.js"></script>
    						<section class="content-header no-margin">
                    <h1 class="text-center">
                        Управление сервером
                    </h1>
                </section>
				<section class="content">
												    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Сервер #<?php echo $server['server_id'] ?></span>
</div></div>
							<div id="content" class="col-md-12">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#s1" role="tab" data-toggle="tab">Ваш сервер</a></li>
				<li class=""><a href="#s2" role="tab" data-toggle="tab">Статистика сервера</a></li>
				<li class=""><a href="#s3" role="tab" data-toggle="tab"><?php if($server['database'] == 1):?>FTP и MySQL <?php elseif($server['database'] == 0):?>FTP данные<? endif;?></a></li>
				<li class=""><a href="#s4" role="tab" data-toggle="tab">FTP просмотр</a></li>
				<li class=""><a href="#s5" role="tab" data-toggle="tab">RCON просмотр</a></li>
				<li class=""><a href="#s6" role="tab" data-toggle="tab">Редактирование</a></li>			
			</ul>
			<div class="tab-content"><br>
				<div class="tab-pane active" id="s1">
					<!-- F#1 -->

<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>Информация о сервере
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
		<table class="table table-striped" style="margin-bottom: 0px;">
						<tr>
							<th width="200px" rowspan="20">
								<div align="Center"><img src="<?php echo $server['image_url']?>" style="width:160px; margin-bottom:5px;"></div>
								<?php if($server['server_status'] == 1): ?> 
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-success" onClick="sendAction(<?php echo $server['server_id'] ?>,'start')"><span class="glyphicon glyphicon-off"></span> Включить</button>
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-warning" onClick="sendAction(<?php echo $server['server_id'] ?>,'reinstall')"><span class="glyphicon glyphicon-refresh"></span> Переустановить</button>
                                                                 <a style="width: 100%;margin-bottom: 5px;" href="/servers/pay/index/<?php echo $server['server_id'] ?>" class="btn btn-info"><span class="glyphicon glyphicon-usd"></span> Продлить</a>
								<?php elseif($server['server_status'] == 2): ?> 
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-danger" onClick="sendAction(<?php echo $server['server_id'] ?>,'stop')"><span class="glyphicon glyphicon-off"></span> Выключить</button>
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-info" onClick="sendAction(<?php echo $server['server_id'] ?>,'restart')"><span class="glyphicon glyphicon-refresh"></span> Перезапустить</button>
	                            <a style="width: 100%;margin-bottom: 5px;" href="/servers/pay/index/<?php echo $server['server_id'] ?>" class="btn btn-info"><span class="glyphicon glyphicon-usd"></span> Продлить</a>
                                                                
                                                             <?php endif; ?>
							</th>
							<th>Игра:</th>
							<td><?php echo $server['game_name'] ?></td>
						</tr>
						<?php if($query): ?> 
						<tr>
							<th>Название:</th>
							<td><?php echo $query['hostname'] ?></td>
						</tr>
						<tr>
							<th>Игроки:</th>
							<td><?php echo $query['players'] ?> из <?php echo $query['maxplayers'] ?></td>
						</tr>
						<tr>
							<th>Игровой режим:</th>
							<td><?php echo $query['gamemode'] ?></td>
						</tr>
						<tr>
							<th>Карта:</th>
							<td><?php echo $query['mapname'] ?></td>
						</tr>
						<?php if($server['game_query'] == 'samp'): ?>
						<tr>
							<th>Версия:</th>
							<?php if($server['version'] == 1): ?>
							<td>0.3z-R4</td>
							<?php elseif($server['version'] == 2): ?>
							<td>0.3e-R2</td>
							<?php elseif($server['version'] == 3): ?>
							<td>0.3x-R1</td>
							<?php endif; ?>
						</tr>
						<?php endif; ?>
						<?php elseif(!$query): ?> 
						<tr>
							<th>Название:</th>
							<td><span class="label label-info">Нет данных</span></td>
						</tr>
						<tr>
							<th>Игроки:</th>
							<td><span class="label label-info">Нет данных</span></td>
						</tr>
						<tr>
							<th>Игровой режим:</th>
							<td><span class="label label-info">Нет данных</span></td>
						</tr>
						<tr>
							<th>Карта:</th>
							<td><span class="label label-info">Нет данных</span></td>
						</tr>
						<?php endif; ?>
						<tr>
							<th>Локация:</th>
							<td><?php echo $server['location_name'] ?></td>
						</tr>
						<tr>
							<th>Адрес:</th>
							<td><?php echo $server['location_ip'] ?>:<?php echo $server['server_port'] ?></td>
						</tr>
						<tr>
							<th>Слоты:</th>
							<td><?php echo $server['server_slots'] ?></td>
						</tr>
						<tr>
							<th>Дата окончания оплаты:</th>
							<td><?php echo date("d.m.Y", strtotime($server['server_date_end'])) ?></td>
                                                        
						</tr>
						<tr>
							<th>Статус:</th>
							<td>
								<?php if($server['server_status'] == 0): ?> 
								<span class="label label-warning">Заблокирован</span>
								<?php elseif($server['server_status'] == 1): ?> 
								<span class="label label-danger">Выключен</span>
								<?php elseif($server['server_status'] == 2): ?> 
								<span class="label label-success">Включен</span>
								<?php elseif($server['server_status'] == 3): ?> 
								<span class="label label-warning">Установка</span>
								<?php endif; ?> 
							</td>
						</tr>
					</table>
				</div>
				</div>

				</div>

					<!-- F#2 -->
										

				<div class="tab-pane" id="s2">
					<!-- F#1 -->
<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>Статистика сервера
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
					<div class="panel-body">
                                          <div class="row">
							<div class="col-md-7">
								<div id="statsGraph" style="height: 220px; width:840px;"></div><div style="width:840px;"><hr></div>
								<b>CPU нагрузка</b>
								<div style="width:830px" class="progress progress-striped active">
									<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $server['server_cpu_load'] ?>%" <span=""></div>
								</div>
								<span class="label label-info"><?if($server['server_status'] != 2){?>Нет данных<?}else{echo $server['server_cpu_load']."%";}?></span><div style="width:840px;"><hr></div>
								<b>RAM нагрузка</b>
								<div style="width:830px" class="progress progress-striped active">
									<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $server['server_ram_load'] ?>%" <span=""></div>
								</div>
								<span class="label label-info"><?if($server['server_status'] != 2){?>Нет данных<?}else{echo $server['server_ram_load']."%";}?></span><div style="width:840px;"><hr></div>
								<b>Загруженность сервера</b>
								<div style="width:830px" class="progress progress-striped active">
								<?php $percent=$query['players']*100/$query['maxplayers'];?>
									<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent ?>%" <span=""></div>
								</div>
								<span class="label label-info"><?if($server['server_status'] != 2){?>Нет данных<?}else{echo $percent."%";}?></span>
							</div>
						</div>
					</div>
					</div>

				</div>
					<!-- F#2 -->

					
				</div>
				<div class="tab-pane" id="s3">
					<!-- F#1 -->
<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>Доступ FTP
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
		<table class="table table-striped" style="margin-bottom: 0px;">
						<tr>
							<th>Хост:</th>
							<td><?php echo $server['location_ip'] ?></td>
						</tr>
						<tr>
							<th>Логин:</th>
							<td>gs<?php echo $server['server_id'] ?></td>
						</tr>
						<tr>
							<th>Пароль:</th>
							<td><?php echo $server['server_password'] ?></td>
						</tr>
						<tr>
							<th>Скачать FTP Клиент:</th>
							<td><a href="http://filezilla.ru/download/FileZilla_3.8.0_win32-setup.exe">Скачать</a></td>
						</tr>
						</table>
					</div>
					</div>
					     <?php if($server['database'] == 1):?>
						<center><img src="http://icons.iconarchive.com/icons/graphics-vibe/developer/256/mysql-icon.png" width="100" height="100" alt="MySQL"></center>
<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>Доступ MySQL
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
		<table class="table table-striped" style="margin-bottom: 0px;">
      <tr>
       <th>Хост:</th>
       <td>localhost либо <?php echo $server['location_ip'] ?></td>
      </tr>
      <tr>
       <th>Логин:</th>
       <td>gs<?php echo $server['server_id'] ?></td>
      </tr>
      <tr>
       <th>Пароль:</th>
       <td><?php echo $server['server_password'] ?></td>
      </tr>
      <tr>
       <th>PhpMyAdmin:</th>
       <td><a href="/myadmin/index.php?pma_username=gs<?php echo $server['server_id'] ?>&pma_password=<?php echo $server['server_password'] ?>&db=gs<?php echo $server['server_id'] ?>">Войти</a></td>
      </tr>
     </table>
    </div>
	</div>
    <?php endif; ?> 
				
					<!-- F#2 -->
					

				</div>	

				<div class="tab-pane" id="s4">
					<!-- F#1 -->
<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>FTP Просмотр
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
					<form action="/ftp/index.php" style="display:none" method="POST" target="ftpdd" id="ftp2d">
    <input type="hidden" value="gs<?php echo $server['server_id'] ?>" name="username">
    <input type="hidden" name="password" value="<?php echo $server['server_password'] ?>">
    <input type="hidden" name="ftpserver" value="<?php echo $server['location_ip'] ?>" />
    <input type="hidden" name="ftpserverport" value="21" /><input type="hidden" name="directory" value="/" /><input type="hidden" name="state"     value="browse" />
    <input type="hidden" name="state2"    value="main" /> <input name="ftpmode" value="automatic" checked="checked" type="hidden" /></form>
<iframe onload="sizeFrame();" style="width:100%; border:0" id="ftpdd" name="ftpdd" ></iframe>
				</div>
					<!-- F#2 -->

					
				</div>
				</div>
				<div class="tab-pane" id="s5">
					<!-- F#1 -->
<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>RCON просмотр
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
					<table class="table table-bordered">
                                        
						<tbody><tr>
							<td><iframe src="ftp://gs<?php echo $server['server_id'] ?>:<?php echo $server['server_password'] ?>@<?php echo $server['location_ip'] ?>:21/<?php if($server['game_query'] == 'samp'): ?>server_log.txt<?php elseif($server['game_query'] == 'valve'): ?>screenlog.0<? endif; ?>" width="100%" height="500" style="border: 0px"></iframe></td>
                                                   </tr>
					</tbody></table>
				</div>
					<!-- F#2 -->

					
				</div>
				</div>
				<div class="tab-pane" id="s6">
					<!-- F#1 -->
<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>Редактирование
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">

				<form class="form-horizontal" action="#" id="editForm" method="POST">
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<div class="checkbox">
								<label><input type="checkbox" id="editpassword" name="editpassword" onChange="togglePassword()"> Изменить пароль</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Пароль:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="col-sm-3 control-label">Повтор пароля:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите пароль" disabled>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Сохранить</button>
						</div>
					</div>
				</form>
				<br>
				</div>
				</div>
				<?php if($server['game_query'] == 'samp'): ?>
				<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>Сменить версию сервера
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
				<br>
				<button style="width: 105px;margin-bottom: 5px;" type="button" class="btn btn-warning" onClick="sendAction(<?php echo $server['server_id'] ?>,'cvz')"><span class="glyphicon glyphicon-refresh"></span> SA:MP 0.3z</button>
                <button style="width: 105px;margin-bottom: 5px;" type="button" class="btn btn-info" onClick="sendAction(<?php echo $server['server_id'] ?>,'cvx')"><span class="glyphicon glyphicon-refresh"></span> SA:MP 0.3x</button>	
                <button style="width: 105px;margin-bottom: 5px;" type="button" class="btn btn-success" onClick="sendAction(<?php echo $server['server_id'] ?>,'cve')"><span class="glyphicon glyphicon-refresh"></span> SA:MP 0.3e</button>
                <button style="width: 175px;margin-bottom: 5px;" type="button" class="btn btn-primary" onClick="sendAction(<?php echo $server['server_id'] ?>,'cvz1000')"><span class="glyphicon glyphicon-refresh"></span> SA:MP 0.3z-R4-1000p</button>
				</div>
				</div>
				<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>Установить сборку сервера
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
				<br>

<!-- 1 -->
<div class="alert alert-info" onClick="open_close('spoiler1',this)"
style="background:#fffbef; border: 1px solid #4874a3; border-radius:5px;">
   <b><span class="label label-info">[DRIFT]</span> Russia-Drift [0.3z]</b> (Подробнее..)
</div><div id="spoiler1" style="display:none; background:#fff">
 
 <div id="owl-demo">
<div class="item"><p class="section_c_p" style="padding: 0;"><a class="grouped_elements" rel="group2" href="http://gnr-samp.ru/_ld/2/53385712.jpg"><img class="curved-hz-2" style="margin: 0 10px 0 0;" src="http://gnr-samp.ru/_ld/2/53385712.jpg" width="100" height="78" alt="RP" /></a></p></div>
</div>
<div class="alert alert-info">Игровой мод дрифт, для SA:MP 0.3z. Много развлекательных зон, телепортов, функций и домов.<br>
<br>
  <b>Q:</b>  Как сделать себя главным администратором?<br>
  <b>A:</b> 1. Нужно залогинится как РКОН администратор (/rcon login ваш<br>
              РКОН-пароль, если Вы <b>не меняли</b> РКОН-пароль сервера в файле<br>
              конфигурации, то: <span class="glyphicon glyphicon-exclamation-sign" style="color: #ff0000;"></span> <b>/rcon login firedhost777ru</b>)<br>
            2. Нужно написать команду активации Главного админа сервера<br>
        <b>/iadminset</b> , после этого Вы будете Главным админом (10лвл). 		<br>
		<br>
		<b>Q:</b>  Где мне взять pawno от этого мода?<br>
		<b>A:</b>  Мы, специально для вас, упокавали родное <b>pawno</b> от этого мода и положили его<br>
		в католог вашего сервера, <b>скачать его можно через FTP.</b>
		<p style="text-align: right;"> <button style="width: 125px;margin-bottom: 5px;" type="button" class="btn btn-success btn-lg" onClick="sendAction(<?php echo $server['server_id'] ?>,'driftz')">Установить</button></p>
  </div>
</div>
<!-- 2 -->
<div class="alert alert-info" onClick="open_close('spoiler2',this)"
style="background:#fffbef; border: 1px solid #4874a3; border-radius:5px;">
   <b><span class="label label-success">[RP]</span> Revelation Role Play [0.3z]</b> (Подробнее..)
</div><div id="spoiler2" style="display:none; background:#fff">
<!-- -->
<div id="owl-demo">
<div class="item"><p class="section_c_p" style="padding: 0;"><a class="grouped_elements" rel="group2" href="http://www.samp-rus.com/_ld/42/96409459.jpeg"><img class="curved-hz-2" style="margin: 0 10px 0 0;" src="http://www.samp-rus.com/_ld/42/96409459.jpeg" width="100" height="78" alt="RP" /></a></p></div>
<div class="item"><p class="section_c_p" style="padding: 0;"><a class="grouped_elements" rel="group2" href="http://s020.radikal.ru/i712/1304/f2/2632d85e385a.jpg"><img class="curved-hz-2" style="margin: 0 10px 0 0;" src="http://s020.radikal.ru/i712/1304/f2/2632d85e385a.jpg" width="100" height="78" alt="RP" /></a></p></div>
</div>
<!-- -->
<div class="alert alert-info"><b>Сборка Role-Play сервера.</b> Уникальный инвентарь.
Тир.
Отель.
Система Квестов.
работы для новичков - шахта , завод , Лесопилка.
подвальное помещение.
новые интерьеры домов.
уникальное AMMO
уникальная команда для МВД,FBI /find
и многое другое... Подробнее на скринах. Копия Advance-RP.
<br>
<br>
<b>Q:</b>  Как сделать себя главным администратором?<br>
  <b>A:</b> 1. Нужно залогинится как РКОН администратор (/rcon login ваш<br>
              РКОН-пароль, если Вы <b>не меняли</b> РКОН-пароль сервера в файле<br>
              конфигурации, то: <span class="glyphicon glyphicon-exclamation-sign" style="color: #ff0000;"></span> <b>/rcon login firedhost777ru</b>)<br>
            2. Нужно написать команду активации Главного админа сервера<br>
        <b>/makeadmin</b> , после этого Вы будете Главным админом (12лвл). 		<br>
		<br>
		<b>Q:</b>  Где мне взять pawno от этого мода?<br>
		<b>A:</b>  Мы, специально для вас, упокавали родное <b>pawno</b> от этого мода и положили его<br>
		в католог вашего сервера, <b>скачать его можно через FTP.</b>
<p style="text-align: right;"> <button style="width: 125px;margin-bottom: 5px;" type="button" class="btn btn-success btn-lg" onClick="sendAction(<?php echo $server['server_id'] ?>,'rpz')">Установить</button></p>
</div>
</div>
<?php if($server['database'] == 1):?>
<!-- 3 -->
<div class="alert alert-info" onClick="open_close('spoiler3',this)" 
style="background: #fffbef; border: 1px solid #4874a3; border-radius:5px;">
   <b><span class="label label-success">[RP]</span> BRILLIANT Role-Play [0.3z]</b> <span class="label label-warning">(MySQL)</span> (Подробнее..)
</div><div id="spoiler3" style="display:none; background:#fff">
<!-- -->
<div id="owl-demo">
<div class="item"><p class="section_c_p" style="padding: 0;"><a class="grouped_elements" rel="group2" href="http://i.imgur.com/XsJTocV.png"><img class="curved-hz-2" style="margin: 0 10px 0 0;" src="http://i.imgur.com/XsJTocV.png" width="100" height="78" alt="RP" /></a></p></div>
<div class="item"><p class="section_c_p" style="padding: 0;"><a class="grouped_elements" rel="group2" href="http://i.imgur.com/b49ncLx.png"><img class="curved-hz-2" style="margin: 0 10px 0 0;" src="http://i.imgur.com/b49ncLx.png" width="100" height="78" alt="RP" /></a></p></div>
</div>
<!-- -->
<div class="alert alert-info"><b>Сборка Role-Play сервера.</b> Предлагаем вам окунуться в захватывающий интересом и возможностями мир, ролевой игры на сервере <b>Brilliantrp Role Play</b>. Воплощая свои самые смелые идеи и мечты, вы не сможете остановиться перед открывающимися возможностями. Выбрать свою роль, пойти по стопам криминала или же наоборот. Хороший маппинг также очень красивые плагины которых нет на других серверах. <b>Есть много фракций.</b>
<br>
<br>
<b>Q:</b>  Как сделать себя главным администратором?<br>
  <b>A:</b> 1. Нужно залогинится как РКОН администратор (/rcon login ваш<br>
              РКОН-пароль, если Вы <b>не меняли</b> РКОН-пароль сервера в файле<br>
              конфигурации, то: <span class="glyphicon glyphicon-exclamation-sign" style="color: #ff0000;"></span> <b>/rcon login firedhost777ru</b>)<br>
            2. Нужно написать команду активации Главного админа сервера<br>
        <b>/makeadmin</b> , после этого Вы будете Главным админом (12лвл). 		<br>
		<br>
		<b>Q:</b>  Где мне взять pawno от этого мода?<br>
		<b>A:</b>  Мы, специально для вас, упокавали родное <b>pawno</b> от этого мода и положили его<br>
		в католог вашего сервера, <b>скачать его можно через FTP.</b>
<p style="text-align: right;"> <button style="width: 125px;margin-bottom: 5px;" type="button" class="btn btn-success btn-lg" onClick="sendAction(<?php echo $server['server_id'] ?>,'rppz')">Установить</button></p>
</div>
</div>
<?endif;?>
<!-- 4 -->
<div class="alert alert-info" onClick="open_close('spoiler4',this)" 
style="background: #fffbef; border: 1px solid #4874a3; border-radius:5px;">
   <b><span class="label label-primary">[TDM]</span> League T/CW v0.1.4i [0.3z]</b> (Подробнее..)
</div><div id="spoiler4" style="display:none; background:#fff">
<!-- -->

<!-- -->
<div class="alert alert-info"><b>Сборка TDM сервера.</b> В мод входит 100 баз и 215 арен при желании можно изменять их, <br>
так же есть три дм зоны (две на про оружие третья на ламо).<br>
Множество изменений в моде можно делать через настройки в папке <b>File</b>, так же изменять количество патрон. <br>
В моде так же есть статистика игроков и сохраняется она. При нажатие NUM4 в чат выводится сообщение о противнике и при нажатие NUM6 вводится команда <b>/sync</b>. 
Полный список команд можно увидеть в /help и /acmd.
<br>
<br>
<b>Q:</b>  Как сделать себя главным администратором?<br>
  <b>A:</b> 1. Нужно залогинится как РКОН администратор (/rcon login ваш<br>
              РКОН-пароль, если Вы <b>не меняли</b> РКОН-пароль сервера в файле<br>
              конфигурации, то: <span class="glyphicon glyphicon-exclamation-sign" style="color: #ff0000;"></span> <b>/rcon login firedhost777ru</b>)<br>
            2. Теперь вы главный администратор, Вам доступна команда <b>/acmd</b><br>
<p style="text-align: right;"> <button style="width: 125px;margin-bottom: 5px;" type="button" class="btn btn-success btn-lg" onClick="sendAction(<?php echo $server['server_id'] ?>,'cwl')">Установить</button></p>
</div>
</div>
<!-- 5 -->
<div class="alert alert-info" onClick="open_close('spoiler5',this)" 
style="background: #fffbef; border: 1px solid #4874a3; border-radius:5px;">
   <b><span class="label label-primary">[TDM]</span> Attack-Defend v2.6(r) [0.3z]</b> (Подробнее..)
</div><div id="spoiler5" style="display:none; background:#fff">
<!-- -->
<div id="owl-demo">
<div class="item"><p class="section_c_p" style="padding: 0;"><a class="grouped_elements" rel="group2" href="http://gtat.dracoblue.net/media/9781a62500d87a10561f0866b85b1f18.png"><img class="curved-hz-2" style="margin: 0 10px 0 0;" src="http://gtat.dracoblue.net/media/9781a62500d87a10561f0866b85b1f18.png" width="100" height="78" alt="RP" /></a></p></div>
<div class="item"><p class="section_c_p" style="padding: 0;"><a class="grouped_elements" rel="group2" href="http://savepic.org/3209930.jpg"><img class="curved-hz-2" style="margin: 0 10px 0 0;" src="http://savepic.org/3209930.jpg" width="100" height="78" alt="RP" /></a></p></div>
<div class="item"><p class="section_c_p" style="padding: 0;"><a class="grouped_elements" rel="group2" href="http://savepic.org/3197642.jpg"><img class="curved-hz-2" style="margin: 0 10px 0 0;" src="http://savepic.org/3197642.jpg" width="100" height="78" alt="RP" /></a></p></div>
</div>
<!-- -->
<div class="alert alert-info"><b>Сборка TDM сервера.</b> Мод тренировочного режима. Приятный интерфейс и простота мода вполне может заинтриговать владельцев серверов.<br>
В моде так же встроен <b>United Anticheat</b>. <br>
В моде очень много баз.  <br>
В моде так же есть статистика игроков и сохраняется она. При нажатие N в чат выводится сообщение о противнике и при нажатие L.Shift + PKM вводится команда <b>/sync</b>. 
Полный список команд можно увидеть в /help и /ahelp, присутствует система регистрации и авторизации в диалоговои окне. Остальное на скринах.
<br>
<br>
<b>Q:</b>  Как сделать себя главным администратором?<br>
  <b>A:</b> 1. Нужно залогинится как РКОН администратор (/rcon login ваш<br>
              РКОН-пароль, если Вы <b>не меняли</b> РКОН-пароль сервера в файле<br>
              конфигурации, то: <span class="glyphicon glyphicon-exclamation-sign" style="color: #ff0000;"></span> <b>/rcon login firedhost777ru</b>)<br>
            2. Дальше вводим команду /setlevel [id] 5 -- Пятый уровень самый большой.<br>
			   Теперь вы админ! Все ваши команды в <b>/ahelp </b>
<p style="text-align: right;"> <button style="width: 125px;margin-bottom: 5px;" type="button" class="btn btn-success btn-lg" onClick="sendAction(<?php echo $server['server_id'] ?>,'cwa')">Установить</button></p>
</div>
</div>
<br>
				</div>
				</div>
				<?php elseif($server['game_query'] == 'valve'): ?>
				<div class="panel-heading">Установка плагинов</div>
				<br>
				<button style="width: 125px;margin-bottom: 5px;" type="button" class="btn btn-success" onClick="sendAction(<?php echo $server['server_id'] ?>,'csz')"><span class="glyphicon glyphicon-refresh"></span> AmxMod (Beta)</button>
				<?php endif; ?> 

				<!-- F#2 -->

				
				</div>

			</div>
		</div>
	</div>
				</div>

				<script>
					var serverStats = [
						<?php foreach($stats as $item): ?> 
						[<?php echo strtotime($item['server_stats_date'])*1000 ?>, <?php echo $item['server_stats_players'] ?>],
						<?php endforeach; ?> 
					];
					$.plot($("#statsGraph"), [serverStats], {
						xaxis: {
							mode: "time",
							timeformat: "%H:%M"
						},
						yaxis: {
							min: 0,
							max: <?php echo $server['server_slots'] ?>
						},
						series: {
							lines: {
								show: true,
								fill: true
							},
							points: {
								show: true
							}
						},
						grid: {
							borderWidth: 0
						},
						colors: [ "#428BCA" ]
					});
					$('#editForm').ajaxForm({ 
						url: '/servers/control/ajax/<?php echo $server['server_id'] ?>',
						dataType: 'text',
						success: function(data) {
							console.log(data);
							data = $.parseJSON(data);
							switch(data.status) {
								case 'error':
									showError(data.error);
									$('button[type=submit]').prop('disabled', false);
									break;
								case 'success':
									showSuccess(data.success);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
					
					function sendAction(serverid, action) {
						switch(action) {
							case "reinstall":
							{
								if(!confirm("Вы уверенны в том, что хотите переустановить сервер? Все данные будут удалены.")) return;
								break;
							}
						}
						$.ajax({ 
							url: '/servers/control/action/'+serverid+'/'+action,
							dataType: 'text',
							success: function(data) {
								console.log(data);
								data = $.parseJSON(data);
								switch(data.status) {
									case 'error':
										showError(data.error);
										$('#controlBtns button').prop('disabled', false);
										break;
									case 'success':
										showSuccess(data.success);
										setTimeout("reload()", 1500);
										break;
								}
							},
							beforeSend: function(arr, options) {
								if(action == "reinstall") showWarning("Сервер будет переустановлен в течении 2 минут!");
								$('#controlBtns button').prop('disabled', true);
							}
						});
					}
					
					function togglePassword() {
						var status = $('#editpassword').is(':checked');
						if(status) {
							$('#password').prop('disabled', false);
							$('#password2').prop('disabled', false);
						} else {
							$('#password').prop('disabled', true);
							$('#password2').prop('disabled', true);
						}
					}
		/**/
		function open_close(id_spol,id_up_spol) {
 var obj = "";
 if (document.getElementById) obj = document.getElementById(id_spol).style;
 else if (document.all) obj = document.all[id_spol];
 else if (document.layers) obj = document.layers[id_spol];
 else return 1;
 
 if (obj.display == "") obj.display = "none";
 else if (obj.display != "none") {
     obj.display = "none";
     
 }
 else {
     obj.display = "block";

 }
 }
    </script>
				    <script>
    var cfg_load = null;
        $(document).ready(function(){
    $('#ftp2d').submit();
            cfg_load= $('#cfg_load').css({'box-shadow' : '0px 0px 0px #444', '-moz-box-shadow' : '0px 0px 0px #444', '-webkit-box-shadow' : '0px 0px 0px #444'}).dialog({minHeight: 285, autoOpen:false, minWidth: 485, title: 'Импорт конфигурации'});
            $('#cfg_load_opt').css({'border' : '0px double black','box-shadow' : '0px 0px 0px #444', '-moz-box-shadow' : '0px 0px 0px #444', '-webkit-box-shadow' : '0px 0px 0px #444'}).tabs();
        });
    </script>
   <script type="text/javascript">

    function sizeFrame() {
    var F = document.getElementById("ftpdd");
    if(F.contentDocument) {F.height = F.contentDocument.documentElement.scrollHeight+30;} else {F.height = F.contentWindow.document.body.scrollHeight+30;}}

    window.onload=sizeFrame; 

</script>
<script type="text/javascript">
<!--
$(document).ready(function() {

  $("#owl-demo").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 6,
      itemsDesktop : [1199,6],
      itemsDesktopSmall : [979,6]
      
   });
   </script>

<?php echo $footer ?>