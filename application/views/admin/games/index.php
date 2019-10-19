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
					<h1>Все игры</h1>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Название</th>
							<th>Код</th>
							<th>Слоты</th>
							<th>Порты</th>
							<th>Стоимость</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($games as $item): ?> 
						<tr class="<?php if($item['game_status'] == 0){echo 'danger';} elseif($item['game_status'] == 1){echo 'success';} ?>" onClick="redirect('/admin/games/edit/index/<?php echo $item['game_id'] ?>')" >
							<td>#<?php echo $item['game_id'] ?></td>
							<td>
								<?php if($item['game_status'] == 0): ?> 
								<span class="label label-danger">Выключена</span>
								<?php elseif($item['game_status'] == 1): ?> 
								<span class="label label-success">Включена</span>
								<?php endif; ?>
							</td>
							<td><?php echo $item['game_name'] ?></td>
							<td><?php echo $item['game_code'] ?></td>
							<td><?php echo $item['game_min_slots'] ?> - <?php echo $item['game_max_slots'] ?></td>
							<td><?php echo $item['game_min_port'] ?> - <?php echo $item['game_max_port'] ?></td>
							<td><?php echo $item['game_price'] ?> руб.</td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($games)): ?> 
						<tr>
							<td colspan="7" class="text-center">На данный момент нет игр.</td>
						<tr>
						<?php endif; ?> 
						<tr>
							<td colspan="7" class="text-center"><a href="/admin/games/create" class="btn btn-default">Создать игру</a></td>
						</tr>
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
