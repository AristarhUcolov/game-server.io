<?php
/*
* @LitePanel
* @Version: 1.0.1
* @Date: 12.02.2014
* @Developed by RossyBAN
*/
?>
<?php echo $header ?>
<link href="/application/public/css/style83.css" rel="stylesheet" type="text/css" />
								    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Новости</span>
</div></div>
<section class="wrapper" style="min-height: 1000px;">
<div class="col-sm-12 col-md-12 col-lg-12">
	    <div class="well">
        <div class="row">
		<div class="col-md-6">
				<h1>Создание новости</h1>
				<form class="form-horizontal" action="#" id="createForm" method="POST">
					<fieldset>
						<div id="legend">
							<legend>Общая информация</legend>
						</div>
						<div class="control-group">
							<!-- Период оплаты -->
							<label class="control-label" for="months">Заголовок</label>
							<div class="controls">
								<input type="text" id="name" name="name" class="form-control">
							</div>
						</div>
						<div class="control-group">
							<!-- Стоимость -->
							<label class="control-label" for="text">Текст</label>
							<div class="controls">
								<textarea id="text" name="text" class="form-control" rows="5"></textarea>
							</div>
						</div>
						<div class="control-group">
							<!-- Кнопка -->
							<div class="controls">
								<button type="submit" class="btn btn-success"><i class="icon-ok"></i> Создать</button>
							</div>
						</div>
					</fieldset>
				</form>
				<script>
					$('#createForm').ajaxForm({ 
						url: '/news/create/ajax',
						dataType: 'json',
						success: function(data) {
							switch(data.status) {
								case 'error':
									showError(data.error);
									$('button[type=submit]').prop('disabled', false);
									break;
								case 'success':
									showSuccess(data.success);
									setTimeout("redirect('/news/)", 1500);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
				</script>
<?php echo $footer ?>
