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
				<div class="page-header">
					<h1>Управление сервером</h1>
				</div>
				<div class="panel panel-success">
					<div class="panel-heading">Информация о сервере</div>
					<table class="table table-bordered">
						<tr>
							<th width="200px" rowspan="20">
								<div align="Center"><img src="<?php echo $server['image_url']?>" style="width:160px; margin-bottom:5px;"></div>
								<?php if($server['server_status'] == 0): ?> 
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-success" onClick="sendAction(<?php echo $server['server_id'] ?>,'unblock')"><span class="glyphicon glyphicon-off"></span> Разблокировать</button>
								<?php elseif($server['server_status'] == 1): ?> 
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-success" onClick="sendAction(<?php echo $server['server_id'] ?>,'start')"><span class="glyphicon glyphicon-off"></span> Включить</button>
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-warning" onClick="sendAction(<?php echo $server['server_id'] ?>,'reinstall')"><span class="glyphicon glyphicon-refresh"></span> Переустановить</button>
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-danger" onClick="sendAction(<?php echo $server['server_id'] ?>,'block')"><span class="glyphicon glyphicon-remove"></span> Заблокировать</button>
								<button style="width: 100%;margin-bottom: 5px;" type="button" class="btn btn-danger" onClick="sendAction(<?php echo $server['server_id'] ?>,'delete')"><span class="glyphicon glyphicon-remove"></span> Удалить</button>
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
							<th>Владелец:</th>
							<td><a href="/admin/users/edit/index/<?php echo $server['user_id'] ?>"><?php echo $server['user_firstname'] ?> <?php echo $server['user_lastname'] ?></a></td>
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
				<div class="panel panel-primary">
								<?php if($server['game_query'] == 'samp'): ?>
				<div class="panel-heading">Сменить версию сервера</div>
				<br>
				<button style="width: 105px;margin-bottom: 5px;" type="button" class="btn btn-warning" onClick="sendAction(<?php echo $server['server_id'] ?>,'cvz')"><span class="glyphicon glyphicon-refresh"></span> SA:MP 0.3z</button>
                <button style="width: 105px;margin-bottom: 5px;" type="button" class="btn btn-info" onClick="sendAction(<?php echo $server['server_id'] ?>,'cvx')"><span class="glyphicon glyphicon-refresh"></span> SA:MP 0.3x</button>	
                <button style="width: 105px;margin-bottom: 5px;" type="button" class="btn btn-success" onClick="sendAction(<?php echo $server['server_id'] ?>,'cve')"><span class="glyphicon glyphicon-refresh"></span> SA:MP 0.3e</button>
                <button style="width: 175px;margin-bottom: 5px;" type="button" class="btn btn-primary" onClick="sendAction(<?php echo $server['server_id'] ?>,'cvz1000')"><span class="glyphicon glyphicon-refresh"></span> SA:MP 0.3z-R4-1000p</button>
</div>
				<?endif;?>
				<div class="panel panel-primary">
					<div class="panel-heading">Статистика сервера</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-7">
								<div id="statsGraph" style="height: 220px; width:666px;"></div><div style="width:666px;"><hr></div>
								<b>CPU нагрузка</b>
								<div style="width:666px" class="progress progress-striped active">
									<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $server['server_cpu_load'] ?>%" <span=""></div>
								</div>
								<span class="label label-info"><?if($server['server_status'] != 2){?>Нет данных<?}else{echo $server['server_cpu_load']."%";}?></span><div style="width:666px;"><hr></div>
								<b>RAM нагрузка</b>
								<div style="width:666px" class="progress progress-striped active">
									<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $server['server_ram_load'] ?>%" <span=""></div>
								</div>
								<span class="label label-info"><?if($server['server_status'] != 2){?>Нет данных<?}else{echo $server['server_ram_load']."%";}?></span><div style="width:666px;"><hr></div>
								<b>Загруженность сервера</b>
								<div style="width:666px" class="progress progress-striped active">
								<?php $percent=$query['players']*100/$query['maxplayers'];?>
									<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent ?>%" <span=""></div>
								</div>
								<span class="label label-info"><?if($server['server_status'] != 2){?>Нет данных<?}else{echo $percent."%";}?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Доступ</div>
					<table class="table table-bordered">
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
							<th>База Данных:</th>
							<td><?php if($server['database'] == 1){echo 'Активна';}else{echo 'Неактивна';} ?></td>
						</tr>
						<tr>
							<th>Скачать FTP Клиент:</th>
							<td><a href="http://filezilla.ru/download/FileZilla_3.8.0_win32-setup.exe">Скачать</a></td>
						</tr>
					</table>
				</div>
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
				<div class="panel panel-default">
					<div class="panel-heading">FTP просмотр</div>
<form action="/ftp/index.php" style="display:none" method="POST" target="ftpdd" id="ftp2d">
    <input type="hidden" value="gs<?php echo $server['server_id'] ?>" name="username">
    <input type="hidden" name="password" value="<?php echo $server['server_password'] ?>">
    <input type="hidden" name="ftpserver" value="<?php echo $server['location_ip'] ?>" />
    <input type="hidden" name="ftpserverport" value="21" /><input type="hidden" name="directory" value="/home/gs<?php echo $server['server_id'] ?>" /><input type="hidden" name="state"     value="browse" />
    <input type="hidden" name="state2"    value="main" />	<input name="ftpmode" value="automatic" checked="checked" type="hidden" /></form>
<iframe onload="sizeFrame();" style="width:100%; border:0" id="ftpdd" name="ftpdd" ></iframe>
					
				</div>
				<h2>Редактирование</h2>
				<form class="form-horizontal" action="#" id="editForm" method="POST">
					<div class="form-group">
						<label for="slots" class="col-sm-3 control-label">Количество слотов:</label>
						<div class="col-sm-2">
							<div class="input-group">
								<span class="input-group-btn"><button class="btn btn-default" type="button" onClick="minusSlots()">-</button></span>
								<input type="text" class="form-control" id="slots" name="slots" value="<?php echo $server['server_slots'] ?>">
								<span class="input-group-btn"><button class="btn btn-default" type="button" onClick="plusSlots()">+</button></span>
							</div>
						</div>
					</div>
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
				<script>
					var serverStats = [
						<?php foreach($stats as $item): ?> 
						[<?php echo strtotime($item['server_stats_date']) * 1000 ?>, <?php echo $item['server_stats_players'] ?>],
						<?php endforeach; ?> 
					];
					$.plot($("#statsGraph"), [serverStats], {
						xaxis: {
							mode: "time",
							timeformat: "%H:%M"
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
						colors: [ "#49AFCD" ]
					});
					$('#editForm').ajaxForm({ 
						url: '/admin/servers/control/ajax/<?php echo $server['server_id'] ?>',
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
							case "delete":
							{
								if(!confirm("Вы уверенны в том, что хотите удалить сервер? Все данные будут удалены.")) return;
								break;
							}
							case "reinstall":
							{
								if(!confirm("Вы уверенны в том, что хотите переустановить сервер? Все данные будут удалены.")) return;
								break;
							}
						}
						$.ajax({ 
							url: '/admin/servers/control/action/'+serverid+'/'+action,
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
								if(action == "reinstall") showWarning("Сервер будет переустановлен в течении 10 минут!");
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
					
					function plusSlots() {
						value = parseInt($('#slots').val());
						$('#slots').val(value+1);
						updateForm();
					}
					function minusSlots() {
						value = parseInt($('#slots').val());
						$('#slots').val(value-1);
						updateForm();
					}
				</script>
<?php echo $footer ?>
