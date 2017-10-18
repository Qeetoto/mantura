function wpsOpenModalPopup(popup)
{
	jQuery('#'+popup).show();
}

function wpsCloseModalPopup(popup)
{
	jQuery('#'+popup).hide();
}

function wpsPostAjaxFrm(frmId)
{
	jQuery("#"+frmId).find("input[type=submit]").attr('disabled','disabled');
        var url = jQuery("#"+frmId).find("#wpsPostUrl").val();
	var data = jQuery("#"+frmId).serialize();
	jQuery.post(url, data, function(response) {
	if(response)
	{
		 jQuery("#"+frmId)[0].reset();
		 location.reload(); 
	}
	});
	
	return false;
}