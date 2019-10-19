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
<link href="/application/public/css/style83.css" rel="stylesheet" type="text/css" />
				    						<section class="content-header no-margin">
                    <h1 class="text-center">
                        Редактирование профиля
                    </h1>
                </section>
				<section class="content">
								    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Редактировать</span>
</div></div>
				<div class="panel panel-default"style="border-radius:10px;">
				<div class="panel-heading"style="border-radius:10px;">Редактирования профиля</div>
				<br>
				<form class="form-horizontal" action="#" id="editForm" method="POST">
					<div class="form-group">
						<label for="firstname" class="col-sm-3 control-label">Имя:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Введите свое имя" value="<?php echo $user['firstname'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-sm-3 control-label">Фамилия:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Введите свою фамилию" value="<?php echo $user['lastname'] ?>">
						</div>
					</div>
						<div class="form-group">
						<label for="user_email" class="col-sm-3 control-label">E-mail:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="user_email" name="user_email" placeholder="Введите свой E-mail" value="<?php echo $user['user_email'] ?>">
						</div>
					</div>
											<div class="form-group">
						<label for="user_img" class="col-sm-3 control-label">Аватар:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="user_img" name="user_img" placeholder="URL на фото, размером 210x160" value="<?echo $users['user_img']?>">
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
							<input type="password" class="form-control" id="password" name="password" placeholder="Пароль" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="col-sm-3 control-label">Повторите пароль:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите пароль" disabled>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Изменить</button>
						</div>
					</div>
				</form>
				<script>
					$('#editForm').ajaxForm({ 
						url: '/account/edit/ajax',
						dataType: 'text',
						success: function(data) {
							console.log(data);
							data = $.parseJSON(data);
							switch(data.status) {
								case 'error':
									showError(data.error);
									break;
								case 'success':
									showSuccess(data.success);
									break;
							}
							$('button[type=submit]').prop('disabled', false);
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
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
				</script>
<?php echo $footer ?>
