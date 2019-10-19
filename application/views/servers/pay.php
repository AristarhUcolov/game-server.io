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
                        Оплата
                    </h1>
                </section>
				<section class="content">
				<div class="panel panel-default"style="border-radius:10px;">
				<div class="panel-heading"style="border-radius:10px;">Оплата сервера</div>
				<br>
				<form class="form-horizontal" action="#" id="payForm" method="POST">
					<div class="form-group">
						<label for="months" class="col-sm-3 control-label">Период оплаты:</label>
						<div class="col-sm-3">
							<select class="form-control" id="months" onChange="updatePrice()">
								<option value="1">1 месяц</option>
								<option value="3">3 месяца (-5%)</option>
								<option value="6">6 месяцев (-10%)</option>
								<option value="12">12 месяцев (-15%)</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-sm-3 control-label">Итого:</label>
						<div class="col-sm-5">
							<p class="lead" id="price">0.00 руб.</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Заказать</button>
						</div>
					</div>
				</form>
				<script>
					$('#payForm').ajaxForm({ 
						url: '/servers/pay/ajax/<?php echo $server['server_id'] ?>',
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
					
					$(document).ready(function() {
						updatePrice();
					});
					
					function updatePrice() {
						var price = <?php echo $server['game_price'] ?> * <?php echo $server['server_slots'] ?>;
						var months = $("#months option:selected").val();
						switch(months) {
							case "3":
								price = 3 * price * 0.95;
								break;
							case "6":
								price = 6 * price * 0.90;
								break;
							case "12":
								price = 12 * price * 0.85;
								break;
						}
						$('#price').text(price.toFixed(2) + ' руб.');
					}
				</script>
<?php echo $footer ?>
