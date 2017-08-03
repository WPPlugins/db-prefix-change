<div class="wrap">
	<div class="container">
		<div class="row">
			<div class="col-sm-7">
				<div class="cards">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#<?php echo TAB_CHANGE_PREFIX;?>" aria-controls="<?php echo TAB_CHANGE_PREFIX;?>" role="tab" data-toggle="tab"><?php echo PLUGIN_TEXT;?></a></li>
						<li role="presentation"><a href="#howtouse" aria-controls="howtouse" role="tab" data-toggle="tab">How to use</a></li>
						<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Plugin Support</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="<?php echo TAB_CHANGE_PREFIX;?>"><?php include('tab-change-prefix.php')?></div>
						<div role="tabpanel" class="tab-pane" id="howtouse"><?php include('tab-how-to-use.php');?></div>
						<div role="tabpanel" class="tab-pane" id="messages">...</div>
						<div role="tabpanel" class="tab-pane" id="settings"><?php include('tab-support-plugin.php');?></div>
					</div>
				</div>
                </div>
                <div class="col-sm-3">
                <a href="https://www.webwatchdog.io/?ref=Creativedev" title="Web Watchdog"><img src="<?php echo IMAGES_PATH;?>wwd-300x250-ver1.jpg" alt="Web Watchdog" /></a>
               </div>
                <a href="https://www.webwatchdog.io/?ref=Creativedev" title="Web Watchdog"><img src="<?php echo IMAGES_PATH;?>wwd-728x90-ver1.jpg" alt="Web Watchdog" /></a>
		</div>
	</div>
</div>