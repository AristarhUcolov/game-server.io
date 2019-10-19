<?php echo $header?>
				<style>
   .word { 

    word-break: break-all;
   }
				</style>
										<div class="panel panel-primary">											 
<section class="content">

                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                                <!-- timeline time label -->
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                        <span class="time"><i class="fa fa-clock-o"></i>
                                        <h3 class="timeline-header"><?php echo $tickets['news_title'] ?></h3>
                                        <div class="timeline-body"><p class="word">
										<?									
echo $item['news_text']
?>
</p>
                                        </div>
                                        <!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

<script type="text/javascript">
  VK.init({apiId: 5326352, onlyWidgets: true});
</script>

<!-- Put this div tag to the place, where the Comments block will be -->
<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 5, width: "800", attach: "*"});
</script>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </section>
										
				<?php echo $pagination ?> 
				
<?php echo $footer?>