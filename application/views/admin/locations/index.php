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
				<div class="page-header">
					<h1>Все локации</h1>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Название</th>
							<th>IP</th>
							<th>Пользователь</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($locations as $item): ?> 
						<tr class="<?php if($item['location_status'] == 0){echo 'danger';} elseif($item['location_status'] == 1){echo 'success';} ?>" onClick="redirect('/admin/locations/edit/index/<?php echo $item['location_id'] ?>')">
							<td>#<?php echo $item['location_id'] ?></td>
							<td>
								<?php if($item['location_status'] == 0): ?> 
								<span class="label label-danger">Выключена</span>
								<?php elseif($item['location_status'] == 1): ?> 
								<span class="label label-success">Включена</span>
								<?php endif; ?> 
							</td>
							<td><?php echo $item['location_name'] ?></td>
							<td><?php echo $item['location_ip'] ?></td>
							<td><?php echo $item['location_user'] ?></td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($locations)): ?> 
						<tr>
							<td colspan="5" class="text-center">На данный момент нет локаций.</td>
						<tr>
						<?php endif; ?> 
						<tr>
							<td colspan="5" class="text-center"><a href="/admin/locations/create" class="btn btn-default">Создать локацию</a></td>
						<tr>
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
