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
				<section class="content-header no-margin">
                    <h1 class="text-center">
                        Запрос в службу поддержки №<?php echo $ticket['ticket_id'] ?>
                    </h1>
                </section>
				<section class="content">
																    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Запрос #<?php echo $ticket['ticket_id'] ?></span>
</div></div>
    			<div class="panel panel-success">
					<div class="panel-heading">Информация о запросе</div>
					<table class="table table-bordered">
						<tr>
							<th width="200px" rowspan="10">
								<div align="Center"><img src="/application/public/image/avatar/user3.jpg" style="width:200px; margin-bottom:10px;"></div>
							</th>
							<th>ID Запроса:</th>
							<td>№<?php echo $ticket['ticket_id'] ?></td>
						</tr>
						<tr>
							<th>Тема:</th>
							<td><?php echo $ticket['ticket_name'] ?></td>
						</tr>
						<tr>
							<th>Дата создания:</th>
							<td><?php echo date("d.m.Y в H:i", strtotime($ticket['ticket_date_add'])) ?></td>
						</tr>
						<tr>
							<th>Статус:</th>
							<td>
								<?php if($ticket['ticket_status'] == 0): ?> 
								<span class="label label-primary">Закрыт</span>
								<?php elseif($ticket['ticket_status'] == 1): ?> 
								<span class="label label-warning">Ответ от клиента</span>
								<?php elseif($ticket['ticket_status'] == 2): ?> 
								<span class="label label-success">Ответ от поддержки</span>
								<?php endif; ?> 
							</td>
						</tr>
					</table>
				</div>
				<?php foreach($messages as $item): ?> 
				<div class="panel panel-default">
					<div class="panel-body"><?php echo nl2br($item['ticket_message']) ?></div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-6 text-muted text-left">
								<span class="glyphicon glyphicon-calendar"></span> <?php echo date("d.m.Y в H:i", strtotime($item['ticket_message_date_add'])) ?> 
							</div>
							<div class="col-md-6 text-muted text-right">
								<span class="glyphicon glyphicon-user"></span> <?php echo $item['user_firstname'] ?> <?php echo $item['user_lastname'] ?> 
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?> 
				<?php if($ticket['ticket_status'] != 0): ?> 
				<h2>Отправить сообщение</h2>
				<form class="form-horizontal" id="sendForm" action="#" method="POST">
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Текст:</label>
						<div class="col-sm-7">
							<textarea class="form-control" id="text" name="text" rows="3" placeholder="Введите текст сообщения"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<div class="checkbox">
								<label><input type="checkbox" id="closeticket" name="closeticket" onChange="toggleText()"> Закрыть запрос</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Отправить</button>
						</div>
					</div>
				</form>
				<script>
					$('#sendForm').ajaxForm({ 
						url: '/tickets/view/ajax/<?php echo $ticket['ticket_id'] ?>',
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
									$('#text').val('');
									setTimeout("reload()", 1500);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
					function toggleText() {
						var status = $('#closeticket').is(':checked');
						if(status) {
							$('#text').prop('disabled', true);
						} else {
							$('#text').prop('disabled', false);
						}
					}
				</script>
				<?php endif; ?>
<?php echo $footer ?>
