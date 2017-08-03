jQuery('#myTabs a').click(function(e) {
	e.preventDefault()
	jQuery(this).tab('show')
});

jQuery(document).ready(function($) {
	//twitter bootstrap script
	$("button#SaveFormBtn").click(function(e) {
		e.preventDefault();
		var data = {
	            action: 'ajaxDataSubmit',
	            old_prefix: $("#old_cdprefix").val(),
		 		new_prefix: $("#new_cdprefix").val()
	        };
	        $.ajax({         
	            type:"POST",
	             url: ajaxurl, // our PHP handler file
	            data: data,
	            beforeSend: function() {
	                    //loadin image or text beforeload ajax code           
	            },
	            success:function(output){ 
	            	var objectArr = $.parseJSON(output);
		    		var resultArr = objectArr.result;
	                // do something with returned data
	            	$("#old_cdprefix").val(resultArr.Prefix);
	            	$("#new_cdprefix").val('');
	            	$('#message').html(resultArr.message);
					dismiss_alert();
	            }
	        });
	});
});
//timing the alert box to close after 5 seconds
function dismiss_alert(){
	window.setTimeout(function() {
		jQuery(".alert").fadeTo(1500, 0).slideUp(500, function(){
			jQuery(this).remove();
		});
	}, 5000);
}