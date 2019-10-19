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
                        Мои запросы
                    </h1>
                </section>
				<section class="content">
																    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Мои запросы</span>
</div></div>
<div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                       
                                             <div class="col-md-3 col-sm-4"><!-- BOXES are complex enough to move the .box-header around.
                                                 This is an example of having the box header within the box body -->
                                            <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title">Функции</h3>
                                            </div>
                                            <!-- compose message btn -->
                                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Создать тикет</a>
                                            <!-- Navigation - folders-->
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header"></li>
                                                    <li class="active"><a href="#"><i class="fa fa-inbox"></i> Тикеты</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                            <div class="row pad">
                                                <div class="col-sm-6">

                                                    <!-- Action button -->
                                                </div>
                                                <div class="col-sm-6 search-form">
                                                    <form action="#" class="text-right">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-sm" placeholder="Найти...">
                                                            <div class="input-group-btn">
                                                                <button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.row -->

                                            <div class="col-sm-16 table-responsive">
                                                <!-- THE MESSAGES -->
                                                <table class="table table-mailbox">
                                                    <tbody><?php foreach($tickets as $item): ?> 
						<tr>
                                                      <td class="small-col"><i class="fa fa-star"></i></td>
                                                        <td class="name"><?php if($item['ticket_status'] == 0): ?> 
								<span class="label label-primary">Закрыт</span>
								<?php elseif($item['ticket_status'] == 1): ?> 
								<span class="label label-warning">Ответ от клиента</span>
								<?php elseif($item['ticket_status'] == 2): ?> 
								<span class="label label-success">Ответ от поддержки</span>
								<?php endif; ?> </td>
                                                        <td class="subject"><a href="/tickets/view/index/<?php echo $item['ticket_id'] ?>"><?php echo $item['ticket_name'] ?></a></td>
                                                        <td class="time"><?php echo date("d.m.Y в H:i", strtotime($item['ticket_date_add'])) ?></td>
                                                    </tr>
													<?php endforeach; ?> 
													<?php if(empty($tickets)): ?>
																			<tr>
							<td colspan="4" style="text-align: center;">На данный момент у вас нет запросов.</td>
						<tr>
						<?php endif; ?> 
                                                </tbody></table>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <div class="pull-right">
                                  <?php echo $pagination ?>
                                    </div>
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
					<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"><!-- COMPOSE MESSAGE MODAL -->
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Новый запрос в службу поддержки</h4>
                    </div>
                    <form id="createForm" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Тема:</span>
									<input type="text" class="form-control" id="name" name="name" placeholder="Введите тему">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="text" id="text" class="form-control" placeholder="Сообщение..." style="height: 120px;"></textarea>
                            </div>
<p class="help-block">Макс. 300 символов</p>
                        </div>
                        <div class="modal-footer clearfix">

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Отмена</button>

                            <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Создать</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>
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
