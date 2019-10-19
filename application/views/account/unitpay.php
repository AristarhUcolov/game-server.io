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
                        Пополнение баланса
                    </h1>
                </section>
				<section class="content">
				<div class="thumbnail">
					<div class="alert alert-success" align="center"><b>Ув. клиенты!</b> Для пополнения своего счета через WebMoney, напишите в тех. поддержку!<br></div>
					<form class="form-horizontal" action="#" id="unitpayForm" method="POST">
						<div class="form-group">
							<label for="ammount" class="col-sm-3 control-label">Сумма:</label>
							<div class="col-sm-3">
								<div class="input-group">
									<input type="text" class="form-control" id="ammount" name="ammount" placeholder="Сумма">
									<span class="input-group-addon">руб.</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-primary">Продолжить</button>
							</div>
						</div>
					</form>
				</div>
				<script>
					$('#unitpayForm').ajaxForm({ 
						url: '/account/unitpay/ajax',
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
