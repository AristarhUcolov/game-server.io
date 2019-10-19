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
                        Заказ сервера
                    </h1>
                </section>
				<section class="content">
												    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Заказ сервера</span>
</div></div>

<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe"></i>Оформление заказа
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
		<table class="table table-striped" style="margin-bottom: 0px;">
				<br>
				<ul class="list-group">
<div class="alert alert-info">Уважаемые клиенты! В панели игровым сервером можно сменить версию сервера SA:MP.<br>
  Предоставляемые версии: 0.3z-R4, 0.3x-R1, 0.3e-R2. Так же, услуга вкладки Hosted Tab составляет 100 рублей - 31 день.<br>
  <span class="glyphicon glyphicon-exclamation-sign" style="color: #ff0000;"></span> База данных MySQL - бесплатна.
  <span class="glyphicon glyphicon-gift " style="color: #ff66ff;"></span><b> Так же, в панели управления сервером, вы можете установить сборку игрового сервера на выбор, совершенно бесплатно!</b>
  </div>
</ul>


				
				
				<!-- -->
				<div class="block_border full_block no-top-radius">
	<div class="block_content">
		<form action="#" method="post" id="orderForm" name="buy-game" class="form_0" style="padding:0px; margin:0px;">
			<div class="row">
				<div class="col-xs-5 buy_form">
					<div class="input-group">
						<span class="input-group-addon">Тип сервера:</span>
						<select class="form-control" id="gameid" name="gameid" onChange="updateForm()">
<?php foreach($games as $item): ?> 
        <option value="<?php echo $item['game_id'] ?>"><?php echo $item['game_name'] ?></option>
        <?php endforeach; ?> 
</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Расположение:</span>
<select class="form-control" id="locationid" name="locationid">
        <?php foreach($locations as $item): ?> 
        <option value="<?php echo $item['location_id'] ?>"><?php echo $item['location_name'] ?></option>
        <?php endforeach; ?> 
       </select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Кол-во слотов:</span>

<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-btn"><button class="btn btn-danger" type="button" onclick="minusSlots()">-</button></span>
								<input type="text" class="form-control" id="slots" name="slots">
								<span class="input-group-btn"><button class="btn btn-primary" type="button" onclick="plusSlots()">+</button></span>
							</div>
						</div>
						</div>
					<div class="input-group">
						<span class="input-group-addon">Период оплаты:</span>
<select class="form-control" id="months" name="months" onChange="updateForm()">
        <option value="1">1 месяц</option>
        <option value="3">3 месяца (-5%)</option>
        <option value="6">6 месяцев (-10%)</option>
        <option value="12">12 месяцев (-15%)</option>
       </select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Нужен MySQL?:</span>
<select class="form-control" id="mysql" name="mysql" onChange="updateForm()">
        <option value="1">Да</option>
        <option value="0">Нет</option>
       </select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Пароль:</span>
       <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
     </div>
	<div class="input-group">
	<span class="input-group-addon">Еще раз:</span>
       <input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите пароль">
     </div>
					<div class="input-group">
						<span class="input-group-addon">Промокод:</span>
<input type="promo" class="form-control" onChange="promoCode()" id="promo" name="promo" placeholder="Введите код на скидку">
					</div>
				</div>
				<div class="col-xs-7" style="margin-top: 75px;">
					<div class="big_arrow left"></div>
					<div class="pay_box right">
						<div class="left left_cel">
							<span class="dr_sans pay_header">К оплате на данный момент:</span>
							<b class="dr_sans" id="sum_all"><p class="lead" id="price">0.00 руб.</p></b>
						</div>
						<input type="submit" value="Оплатить" class="helv_roman">
						<div class="clr"></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- --> 
				
				
				
				
				<script>
					var gameData = {
					<?php foreach($games as $item): ?> 
						<?php echo $item['game_id'] ?>: {
							'minslots': <?php echo $item['game_min_slots'] ?>,
							'maxslots': <?php echo $item['game_max_slots'] ?>,
							'price': <?php echo $item['game_price'] ?>
						},
					<?php endforeach; ?> 
					};
					
					$('#orderForm').ajaxForm({ 
						url: '/servers/order/ajax',
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
									setTimeout("redirect('/servers/control/index/" + data.id + "')", 1500);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
							showWarning("Идет просмотр настроек сервера. И подготовка к установке.");
						}
					});
					
					$(document).ready(function() {
						updateForm();
					});
					
					function promoCode(){
						var promo = $("#promo").val();
						$.post("/servers/order/promo",{code: promo},function(data){
							data = $.parseJSON(data);
							switch(data.status) {
								case 'error':
									showError(data.error);
									updateForm();
									break;
								case 'success':
									showSuccess(data.success);
									updateForm(data.skidka);
									break;
							}
						});
						
					}
					
					function updateForm(promo) {
					    //var test_server = $("#test_server").val();
						var gameID = $("#gameid option:selected").val();
						var slots = $("#slots").val();
						//if(test_server == 0){
						if(slots < gameData[gameID]['minslots']) {
							slots = gameData[gameID]['minslots'];
							$("#slots").val(slots);
						}
						if(slots > gameData[gameID]['maxslots']) {
							slots = gameData[gameID]['maxslots'];
							$("#slots").val(slots);
						}				
						var price = gameData[gameID]['price'] * slots;
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
						
						/*} else {
                        var mysql = $("#mysql").val();						
						var price = gameData[gameID]['price'] * slots;
						mysql = 0;						
						price = 0.00;
						slots = 20;
						$("#slots").val(slots);
						$("#mysql").val(mysql);
						$("#price").val(price);
						}*/
						if(promo != null){price = price * promo;}
						$('#price').text(price.toFixed(2) + ' руб.');
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
