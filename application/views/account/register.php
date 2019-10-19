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
<?php echo $loginheader ?>
		<form class="form-signin" id="registerForm" action="#" method="POST">
			<h2 class="form-signin-heading">Регистрация</h2>
			<div class="form-group-vertical">
				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Имя">
				<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Фамилия">
			</div>
			<input type="text" class="form-control" id="email" name="email" placeholder="E-Mail">
			<div class="form-group-vertical">
				<input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
				<input type="password" class="form-control" id="password2" name="password2" placeholder="Повтор пароля">
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
			<div class="other-link"><a href="/account/login">Уже зарегистрированы?</a></div>
		</form>
		<script>
			$('#registerForm').ajaxForm({ 
				url: '/account/register/ajax',
				dataType: 'text',
				success: function(data) {
					console.log(data);
					data = $.parseJSON(data);
					switch(data.status) {
						case 'error':
							showError(data.error);
							reloadImage('#captchaimage');
							$('button[type=submit]').prop('disabled', false);
							break;
						case 'success':
							showSuccess(data.success);
							setTimeout("redirect('/')", 1500);
							break;
					}
				},
				beforeSubmit: function(arr, $form, options) {
					$('button[type=submit]').prop('disabled', true);
				}
			});
			$('.captcha img').click(function() {
				reloadImage(this);
			});
		</script>
<?php echo $loginfooter ?>
