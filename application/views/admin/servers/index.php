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
					<h1>Все сервера</h1>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Игра</th>
							<th>Локация</th>
							<th>IP</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($servers as $item): ?> 
						<tr class="<?php if($item['server_status'] == 0){echo 'warning';}elseif($item['server_status'] == 1){echo 'danger';}elseif($item['server_status'] == 2){echo 'success';}elseif($item['server_status'] == 3){echo 'warning';}?>" onClick="redirect('/admin/servers/control/index/<?php echo $item['server_id'] ?>')">
							<td>#<?php echo $item['server_id'] ?></td>
							<td>
							<?php if($item['server_status'] == 0): ?> 
								<span class="label label-warning">Заблокирован</span>
							<?php elseif($item['server_status'] == 1): ?> 
								<span class="label label-danger">Выключен</span>
							<?php elseif($item['server_status'] == 2): ?> 
								<span class="label label-success">Включен</span>
							<?php elseif($item['server_status'] == 3): ?> 
								<span class="label label-warning">Установка</span>
							<?php endif; ?> 
							</td>
							<td><?if($item['game_query'] == 'samp'):?><img src="/application/public/image/icons/samp.png" alt="" /><?elseif($item['game_query'] == 'mtasa'): ?> <img src="/application/public/image/icons/mta.png" width="40" height="20" alt="" /><? elseif($item['game_query'] == 'valve'):?> <img src="/application/public/image/icons/cs16.png" width="16" height="16" alt="" /><?endif;?><?php echo $item['game_name'] ?></td>
							<td><?php echo $item['location_name'] ?></td>
							<td><?php echo $item['location_ip'] ?>:<?php echo $item['server_port'] ?></td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($servers)): ?> 
						<tr>
							<td colspan="5" class="text-center">На данный момент нет серверов.</td>
						<tr>
						<?php endif; ?> 
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
