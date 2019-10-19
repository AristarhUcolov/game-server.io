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
				<br><br>
				<div class="panel panel-default"style="border-radius:10px;">
				<div class="panel-heading"style="border-radius:10px;">Создать тикет</div>
				<br>
				<form class="form-horizontal" action="#" id="createForm" method="POST">
					
					<div class="form-group">
						<label for="text" class="col-sm-3 control-label">Тема:</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="name" name="name" placeholder="Введите тему">
						</div>
					</div>
					<div class="form-group">
						<label for="text" class="col-sm-3 control-label">Сообщение:</label>
						<div class="col-sm-7">
							<textarea class="form-control" id="text" name="text" rows="5"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary"style="border-radius:10px;">Создать</button>
						</div>
					</div>
				</form>
				<script>
					$('#createForm').ajaxForm({ 
						url: '/tickets/create/ajax',
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
									setTimeout("redirect('/tickets/view/index/" + data.id + "')", 1500);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
				</script>
<?php echo $footer ?>
