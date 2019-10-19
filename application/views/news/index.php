<?php
/*
* @LitePanel
* @Version: 1.0.1
* @Date: 29.12.2012
* @Developed by QuickDevel
*/
?>
<?php echo $header?>
<link href="/application/public/css/style83.css" rel="stylesheet" type="text/css" />
				<style>
   .word { 

    word-break: break-all;
   }
				</style>
								    <div class="block_border full_block block_speedbar">
<div class="speed_bar">
    <a href="/">Главная</a>
	<span>Новости</span>
</div></div>
										 
<section class="content">

                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-red">
                                        2016
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
								<?php foreach($tickets as $item): ?> 	
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i><?php echo date("d.m.Y в H:i", strtotime($item['news_date_add'])) ?></span>
                                        <h3 class="timeline-header"><?php echo $item['news_title'] ?></h3>
                                        <div class="timeline-body"><p class="word">
										<?										
echo $item['news_text']
?>
</p>
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs" href="/news/comm/index/<?php echo $item['news_id'] ?>">Коментарии</a>
                                        </div>
                                    </div>
                                </li>
								<?php endforeach; ?> 
                                <!-- END timeline item -->
                                <!-- timeline item -->
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </section>
										
				<?php echo $pagination ?> 
				
<?php echo $footer?>
