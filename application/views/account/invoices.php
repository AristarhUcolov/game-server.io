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
                        Счета
                    </h1>
                </section>
				<section class="content">
				<div class="panel panel-default"style="border-radius:10px;">
				<div class="panel-heading"style="border-radius:10px;">Мои счета</div>
				<br>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Сумма</th>
							<th>Дата создания</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($invoices as $item): ?> 
						<tr class="<?php if($item['invoice_status'] == 0){echo 'warning';} elseif($item['user_status'] == 1){echo 'success';} ?>">
							<td>#<?php echo $item['invoice_id'] ?></td>
							<td>
								<?php if($item['invoice_status'] == 0): ?> 
								<span class="label label-warning">Не оплачен</span>
								<?php elseif($item['invoice_status'] == 1): ?> 
								<span class="label label-success">Оплачен</span>
								<?php endif; ?> 
							</td>
							<td><?php echo $item['invoice_ammount'] ?> руб.</td>
							<td><?php echo date("d.m.Y в H:i", strtotime($item['invoice_date_add'])) ?></td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($invoices)): ?> 
						<tr>
							<td colspan="4" style="text-align: center;">На данный момент у вас нет счетов.</td>
						<tr>
						<?php endif; ?> 
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
