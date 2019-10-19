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
					<section class="wrapper" style="min-height: 616px;">
<div class="col-sm-12 col-md-12 col-lg-12">
    <div class="well">
        <div class="row">
		<div class="col-md-6">
		<h2>ROBOKASSA</h2>
		<form action="#" id="payForm" method="POST">
		<input class="form-control input-lg-b" id="ammount" name="ammount" placeholder="Сумма">
		<br>
		<button class="btn btn-default btn-lg btn-block" type="submit">Пополнить </button>
		<br>
		</form>
		</div>
		<div class="col-md-6 visible-lg visible-md">
        <h2>Инструкция</h2><h2>
		</h2><h5>1. Введите сумму на которую вы хотите пополнить свой счет.</h5>
		<h5>2. Нажмите кнопку "пополнить".</h5>
		<h5>3. На странице оплаты выберете удобный для Вас способ оплаты.</h5>
		<h5>4. После подтверждения оплаты, на Ваш счет будут зачислены деньги.</h5>
		</div>
		</div>
		<div class="row">
                            <h4 class="text-center"><i class="fa fa-question-circle"></i> Проблемы с оплатой?</h4>
                            <p class="text-center">Обратитесь в <a href="/tickets/create"> Поддержку Пользователей</a></p>
                        </div>
		</div>
</div>
</section>
					</form>
				</div>
				<script>
					$('#payForm').ajaxForm({ 
						url: '/account/pay/ajax',
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
									redirect(data.url);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
				</script>
<?php echo $footer ?>
