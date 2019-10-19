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
                        Сервера
                    </h1>
                </section>
				<section class="content">
												    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Мои сервера</span>
</div></div>

				<div class="block_border full_block no-top-radius">
	<div class="block_content">
<div class="portlet box green-jungle">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa-check-circle"></i>Мои сервера
		</div>
	</div>
	<div class="portlet-body" style="display: block; padding: 0px;">
		<table class="table table-striped" style="margin-bottom: 0px;">

					<thead>
						<tr class="alert-info">
							<th>ID</th>
							<th>Статус</th>
							<th>Игра</th>
							<th>Локация</th>
							<th>IP</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($servers as $item): ?> 
						<tr class="<?php if($item['server_status'] == 0){echo 'warning';}elseif($item['server_status'] == 1){echo 'danger';}elseif($item['server_status'] == 2){echo 'success';}elseif($item['server_status'] == 3){echo 'warning';}?>" onClick="redirect('/servers/control/index/<?php echo $item['server_id'] ?>')" style="border-radius:10px;">
							<td><span class="label label-primary" style="border-radius:10px;">№<?php echo $item['server_id'] ?></span></td>
							<td>
							<?php if($item['server_status'] == 0): ?> 
								<span class="label label-warning" style="border-radius:10px;">Заблокирован</span>
							<?php elseif($item['server_status'] == 1): ?> 
								<span class="label label-danger" style="border-radius:10px;">Выключен</span>
							<?php elseif($item['server_status'] == 2): ?> 
								<span class="label label-success" style="border-radius:10px;">Включен</span>
							<?php elseif($item['server_status'] == 3): ?> 
								<span class="label label-warning" style="border-radius:10px;">Установка</span>
							<?php endif; ?> 
							</td>
							<td><?if($item['game_query'] == 'samp'):?><img src="http://bw-fun-team.ucoz.ru/samp.png" alt="" /><?elseif($item['game_query'] == 'mtasa'): ?> <img src="http://gnat-fun.do.am/_ld/0/95903979.png" width="40" height="20" alt="" /><? elseif($item['game_query'] == 'valve'):?> <img src="http://ps-master.ucoz.org/_fr/0/6220759.png" width="16" height="16" alt="" /><?endif;?><?php echo $item['game_name'] ?></td>
							<td><?php echo $item['location_name'] ?></td>
							<td><?php echo $item['location_ip2'] ?>:<?php echo $item['server_port'] ?></td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($servers)): ?> 
						<tr>
							<td colspan="5" style="text-align: center;">На данный момент у вас нет серверов.</td>
						<tr>
						<?php endif; ?> 
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
