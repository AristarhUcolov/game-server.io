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
				<h1>Создание игры</h1>	
				<form class="form-horizontal" action="#" id="createForm" method="POST">
					<fieldset>
						<div id="legend">
							<legend>Основные параметры</legend>
						</div>
						<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Название:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="name" name="name" placeholder="Введите название">
						</div>
						</div>
						<div class="form-group">
							<!-- Код -->
							<label class="col-sm-3 control-label" for="code">Код</label>
							<div class="col-sm-4">
								<input type="text" id="code" name="code" class="form-control" placeholder="Код игры">
							</div>
						</div>
						<div class="form-group">
							<!-- game_url -->
							<label class="col-sm-3 control-label" for="game_url">URL к картинки(На странице сервера)</label>
							<div class="col-sm-4">
								<input type="text" id="game_url" name="game_url" class="form-control" placeholder="URL к картинки">
							</div>
						</div>
						<div class="form-group">
							<!-- Query -->
							<label class="col-sm-3 control-label" for="query">Query-драйвер</label>
							<div class="col-sm-4">
								<input type="text" id="query" name="query" class="form-control" placeholder="Драйвер игры">
							</div>
						</div>
						<div id="legend">
							<legend>Прочее</legend>
						</div>
						<div class="form-group">
						<label for="minslots" class="col-sm-3 control-label">Слоты:</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">от</span>
								<input type="text" class="form-control" id="minslots" name="minslots">
								<span class="input-group-addon">до</span>
								<input type="text" class="form-control" id="maxslots" name="maxslots">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="minport" class="col-sm-3 control-label">Порты:</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">от</span>
								<input type="text" class="form-control" id="minport" name="minport">
								<span class="input-group-addon">до</span>
								<input type="text" class="form-control" id="maxport" name="maxport">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-sm-3 control-label">Стоимость:</label>
						<div class="col-sm-3">
							<div class="input-group">
								<input type="text" class="form-control" id="price" name="price">
								<span class="input-group-addon">руб.</span>
							</div>
						</div>
					</div>
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
						url: '/admin/games/create/ajax',
						dataType: 'json',
						success: function(data) {
							switch(data.status) {
								case 'error':
									showError(data.error);
									$('button[type=submit]').prop('disabled', false);
									break;
								case 'success':
									showSuccess(data.success);
									setTimeout("redirect('/admin/games')", 1500);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
				</script>
<?php echo $footer ?>
