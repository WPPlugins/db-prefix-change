<?php global $wpdb;?>
<div>
	<div class="alert alert-danger">
		<?php _e(ALERT_MSG , PLUGIN_SLUG); ?>
	</div>
	<div class="clearfix"></div>
	<div id="message"></div>
	<div class="clearfix"></div>
	<form id="<?php echo PLUGIN_FORM;?>" name="<?php echo PLUGIN_FORM;?>" method="post" action="" class="form-horizontal">
		<div class="form-group">
			<label for="old_cdprefix" class="col-sm-2 control-label"><?php _e("Existing Prefix: " , PLUGIN_SLUG); ?></label>
			 <div class="col-sm-6">
					<input type="old_cdprefix" class="form-control" id="old_cdprefix" value="<?php echo $wpdb->prefix; ?>">
			</div>
			<div class="col-sm-2"><?php _e(" ex:wp_" , PLUGIN_SLUG); ?></div>
  		</div>
		<div class="form-group">
			<label for="new_cdprefix"  class="col-sm-2 control-label"> <?php _e("New Prefix: " , PLUGIN_SLUG); ?></label>
			<div class="col-sm-6">
				<input type="new_cdprefix" class="form-control" id="new_cdprefix" value=""> 			
			</div>
			<div class="col-sm-2"><?php _e(" ex: uniquekey_" , PLUGIN_SLUG); ?></div>
			<div class="col-sm-2">
			</div>
		</div>
		<div class="form-group">
			<label for=""  class="col-sm-2 control-label"></label>
			<div class="col-sm-6"> 
    		<p class="col-sm-12">
				<?php _e(RESTRICT_MSG , PLUGIN_SLUG); ?>
			</p>
			</div>
		</div>
		<button type="submit" class="btn btn-success" id="SaveFormBtn" name="submitButton"><?php _e('Save Changes', PLUGIN_SLUG ) ?></button>
	</form>
</div>