<?php echo $header ?>
<link href="/application/public/css/style83.css" rel="stylesheet" type="text/css" />
    						<section class="content-header no-margin">
                    <h1 class="text-center">
                       Мониторинг
                    </h1>
                </section>
				<section class="content">
				    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Мониторинг</span>
</div></div>
<div class="thumbnail">

		
  
<div class="docs-example visible-desktop" alt="Мониторинг" style="font-size:12px; margin-top:0px;">
    <table class="table table-bordered">
        <thead>
           <th width="400" style="text-align: center;">Название сервера</th>
          <th width="180"><center>Игра</center></th>    
                <th width="110" style="text-align: center;">Карта</th>
                <th width="150"> <center><span class="glyphicon glyphicon-user"</span></center></th>
                <th width="150"><center>Адрес</center></th>
            </tr>
        </thead>
       <tbody>

       <?php foreach($servers as $item): ?> 

<? if (!($item['server_status'] == 2)) { // пропуск нечетных чисел
                        continue;
                        }?>
      <tr>

       <?php if($item['server_status'] == 2) {
         $queryLib = new queryLibrary($item['game_query']);
         $queryLib->connect($item['location_ip'], $item['server_port']);
         $q = $queryLib->getInfo();
         $queryLib->disconnect();
        } ?>              
		<?if($q):?>
                                                        <td><a href="/monitor/view/index/<?echo $item['server_id']?>"><?if($item['game_query'] == 'samp' or $item['game_query'] == 'mtasa'){ $str2 = iconv ('windows-1251', 'utf-8', $q['hostname']); echo $str2;}else{ echo $q['hostname']; }?></a></td>
                                                        <td><?php echo $item['game_name']; if($item['user_id'] == 1){echo '';}?></td>
                                                        <td><?php echo $q['mapname'] ?></td>
       <td> <div style="position: relative;"> <div class="progress progress-striped" style="margin-bottom: 0px;"> <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $q['players']*100/$q['maxplayers'] ?>%"></div> <div style="position: absolute;width: 100%;"><center><?php echo $q['players'] ?>/<?php echo $q['maxplayers'] ?></center></div> </div></div> </center></td>
       <td><center><span class="label label-success"><?php echo $item['location_ip'] ?>:<?php echo $item['server_port'] ?></span></td>       
      </tr>
	  <?endif;?>
      <?php endforeach; ?>
     </tbody>
    </table>
</div>

 <?php echo $pagination ?> 
<?php echo $footer ?>