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
<?echo $header?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/application/public/css/style83.css" rel="stylesheet">
	<title><?if($server['game_query'] == 'samp' or $server['game_query'] == 'mtasa'){ $str2 = iconv ('windows-1251', 'utf-8', $query['hostname']); echo $str2;}else{ echo $query['hostname']; }?></title>

</head>

<body background="/application/public/image/bgk.jpg">

		<?$aServerRules = $queryq->getRules();?>		
				
				<section id="main_content">
            <div id="content-base">    						<section class="content-header no-margin">
                    <h1 class="text-center">
                        <?if($server['game_query'] == 'samp' or $server['game_query'] == 'mtasa'){ $str2 = iconv ('windows-1251', 'utf-8', $query['hostname']); echo $str2;}else{ echo $query['hostname']; }?>
                    </h1>
                </section>
				<section class="content">
				<div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
<a href="/monitor">Мониторинг</a> 
 <span><?php echo $server['location_ip'] ?>:<?php echo $server['server_port'] ?></span>
</div></div><div class="block_border full_block no-top-radius">
	<div class="block_content">
		<div class="left server_opt">
			<div class="game_photo left" style="position:relative;"><img src="/application/public/img/games.png"></div>
			<div class="right g_server">
				<ul>
				  <li><b><?if($server['game_query'] == 'samp' or $server['game_query'] == 'mtasa'){ $str2 = iconv ('windows-1251', 'utf-8', $query['hostname']); echo $str2;}else{ echo $query['hostname']; }?></b></li>
				  <li><?if($server['game_query'] == 'samp'):?><img src="/application/public/img/samp.png">GTA: San Andreas
				      <?elseif($server['game_query'] == 'valve'):?><img src="/application/public/img/cs.png">Counter-Strike
				      <?elseif($server['game_query'] == 'mine'):?><img src="/application/public/img/mc.png">Minecraft
				      <?elseif($server['game_query'] == 'mta'):?><img src="/application/public/img/130128629563.jpg">GTA: Multi Theft Auto<?endif;?></li>
				   <li class="add_ress">Игровой мод: <span><? $str5 = iconv ('windows-1251', 'utf-8', $query['gamemode']); echo $str5; ?></span></li>
				   <li class="add_ress">Карта: <span><?$str3 = iconv ('windows-1251', 'utf-8', $aServerRules['mapname']); echo $str3; ?></span></li>
				   <li class="add_ress">Адрес: <span><?php echo $server['location_ip'] ?>:<?php echo $server['server_port'] ?></span></li>
				   <li class="add_ress">Версия: <span><?php echo $aServerRules['version'] ?></span></li>
				   <li class="add_ress">Время на сервере: <span><?php echo $aServerRules['worldtime'] ?></span></li>
				   <li class="add_ress">Сайт сервера: <span><?php echo $aServerRules['weburl'] ?></span></li>
				</ul>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
		<div class="right server_pay" style="width: 327px;">
			<ul class="left">
				<li>Локация: <span><?php echo $server['location_name'] ?></span></li>
				<li>Оплачен до: <span><?php echo date("d.m.Y", strtotime($server['server_date_end'])) ?></span></li>
			</ul>
			<div class="clr"></div>
				<div style="position: relative;">
					<div class="progress" style="margin-bottom: 0px;">
					  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $query['players']*100/$query['maxplayers'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $query['players']*100/$query['maxplayers'] ?>%"></div>
					  <div style="position: absolute;width: 100%;margin-top:6px;"><center><?php echo $query['players']?>/<? echo $query['maxplayers'] ?></center></div>
					</div>
				</div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
				
		<div class="panel_grafik">
			<div class="grafik_title">График загруженности сервера:</div>
            <div id="statsGraph" style="height: 220px; width:100%;"></div><div style="width:100%;"><hr></div>
				<div class="grafik_full">Игроков на сервере: <b><?php echo $query['players']?>/<?echo $query['maxplayers'] ?></b></div>
				<div class="grafik_full brd-right">Сервер: <b><span><?php echo $server['location_ip'] ?>:<?php echo $server['server_port'] ?></b></div>
				<div class="clr"></div>
			</div>
		</div>
		
		<div class="clr"></div>
	</div>
</div>
	
<?php

	if($queryq->isOnline())
{
?>
 
	<br />
		<b>Игроки онлайн</b>
	
	<?php
	
	$aPlayers = $queryq->getDetailedPlayers();
	
	if(!is_array($aPlayers) || count($aPlayers) == 0)
	{
		echo '		<div class="lh_table" style="margin-top: 5px;">
		<div class="panel panel-default">
		<table class="table table-bordered">
		<tbody>
			<tr class="alert-info">
				<td><b><center>Игроки</b></td>
			</tr>
			</tbody>
					</div>
	</div><i><tr><td><center>На сервере игроков нет.</tr></i>';
	}
	else
	{
		?>		
		<div class="lh_table" style="margin-top: 5px;">
		<div class="panel panel-default">
		<table class="table table-bordered">
		<tbody>
			<tr class="alert-info">
				<td><b>Player ID</b></td>
				<td><b>Ник</b></td>
				<td><b>Очки</b></td>
				<td><b>Пинг</b></td>
			</tr>
			</tbody>
					</div>
	</div>
		<?php
		foreach($aPlayers as $sValue)
		{
			?>
			<tr>
				<td><?= $sValue['playerid'] ?></td>
				<td><?= htmlentities($sValue['nickname']) ?></td>
				<td><?= $sValue['score'] ?></td>
				<td><?= $sValue['ping'] ?></td>
			</tr>
			<?php
		}
	
		echo '</table>';
	}
}
?>
            
            <div class="clr"></div>
 </section>
	
		<script>
							var serverStats = [
						<?php foreach($stats as $item): ?> 
						[<?php echo strtotime($item['server_stats_date'])*1000 ?>, <?php echo $item['server_stats_players'] ?>],
						<?php endforeach; ?> 
					];
					$.plot($("#statsGraph"), [serverStats], {
						xaxis: {
							mode: "time",
							timeformat: "%H:%M"
						},
						yaxis: {
							min: 0,
							max: <?php echo $server['server_slots'] ?>
						},
						series: {
							lines: {
								show: true,
								fill: true
							},
							points: {
								show: true
							}
						},
						grid: {
							borderWidth: 0
						},
						colors: [ "#428BCA" ]
					});
					</script>