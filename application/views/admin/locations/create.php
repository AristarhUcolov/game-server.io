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
					<h1>Создание локации</h1>
				</div>
				<form class="form-horizontal" action="#" id="createForm" method="POST">
					<h3>Основная информация</h3>
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Название:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="name" name="name" placeholder="Введите название">
						</div>
					</div>
					<div class="form-group">
						<label for="ip2" class="col-sm-3 control-label">IP(Который видит пользователь):</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="ip2" name="ip2" placeholder="Введите IP">
						</div>
					</div>
					<div class="form-group">
						<label for="ip" class="col-sm-3 control-label">IP(По которому подключаются):</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="ip" name="ip" placeholder="Введите IP">
						</div>
					</div>
					<div class="form-group">
						<label for="user" class="col-sm-3 control-label">Имя пользователя:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="user" name="user" placeholder="Введите имя пользователя">
						</div>
					</div>
					<h3>Пароль</h3>
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Пароль:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="col-sm-3 control-label">Повторите пароль:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите пароль">
						</div>
					</div>
					<h3>Дополнительная информация</h3>
					<div class="form-group">
						<label for="status" class="col-sm-3 control-label">Статус:</label>
						<div class="col-sm-3">
							<select class="form-control" id="status" name="status">
								<option value="0">Выключена</option>
								<option value="1">Включена</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Создать</button>
						</div>
					</div>
				</form>
				<script>
					$('#createForm').ajaxForm({ 
						url: '/admin/locations/create/ajax',
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
									setTimeout("redirect('/admin/locations')", 1500);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
				</script>
<?php echo $footer ?>
