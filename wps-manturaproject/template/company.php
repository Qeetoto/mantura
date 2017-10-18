<?php
if ( ! defined( 'ABSPATH' ) ) {
	die("You can't access this file directly"); // disable direct access
}

$aTypes = get_terms( 'company_type', array('hide_empty' => false));


$args = array(
	'posts_per_page' => -1,
	'offset'           => 0,	
	'order'            => 'ASC',
	'post_type' => 'wps_mantura_company',
	'post_status'      => 'publish',
);

$aCompanies = get_posts( $args );

?>

<div class="wps_mantura_wrapper">
<a href="javascript:void(0);" onclick="wpsOpenModalPopup('wpsManturaCompany');" class="wps_mantura_add_link wps_floatr">Promot Your Company</a>
<div class="wps_mantura_clear">&nbsp;</div>
<div class="wps_mantura_clear">&nbsp;</div>
<?php
if($aCompanies)
{
?>
<table>
<tbody>
<tr>
<td style="width:10%;"><strong>#</strong></td>
<td style="width:20%;"><strong>Title</strong></td>
<td><strong>Summary</strong></td>
<td style="width:15%;"><strong>Type</strong></td>
</tr>
<?php
foreach($aCompanies as $aKey => $aCompany)
{
	$post_id = $aCompany->ID;
	$aTypeArray = wp_get_post_terms( $post_id, 'company_type');

?>
<tr>
<td><?php echo $aKey+1; ?></td>
<td><?php echo $aCompany->post_title; ?></td>
<td><?php echo $aCompany->post_content; ?></td>
<td><?php echo $aTypeArray[0]->name; ?></td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php
}
else
{
	echo "No company registered yet";
}
?>
</div>








<div id="wpsManturaCompany" class="wps-mantura-inline-modal">
<div class="wps-mantura-inline-modal-content">  	
<div class="wps-mantura-inline-modal-header">
<span class="wps-mantura-inline-modal-close" onclick="wpsCloseModalPopup('wpsManturaCompany');">&times;</span>
<h4 class="wps-mantura-inline-modal-title">Promot Your Company</h4>
</div>	
<div class="wps-mantura-inline-modal-body">
<form method="post" enctype="multipart/form-data" onsubmit="return wpsPostAjaxFrm('wpsFrmCompany');" id="wpsFrmCompany">
<input type="hidden" name="action"  id="wpsPostAction" value="wps_mantura_company_ajax"/>
<input type="hidden" name="wpsPostUrl" id="wpsPostUrl" value="<?php echo admin_url( 'admin-ajax.php' ) ?>" />
<table class="wps-mantura-inline-modal-table">
<tr><th>Title</th></tr>
<tr><td><input type="text" required name="wpsval[title]" /></td></tr>

<tr><th>Company Type</th></tr>
<tr><td>
<select name="wpsval[type]" required>
<option value="">Select</option>
<?php if($aTypes) { 
foreach($aTypes as $aType) { ?>
<option value="<?php echo $aType->name; ?>"><?php echo $aType->name; ?></option>
<?php }} ?>
</select>
</td></tr>

<tr><th>Description</th></tr>
<tr><td><textarea required name="wpsval[description]"></textarea></td></tr>

<tr><td><input type="submit" value="Submit Details" /></td></tr>
</table>
</form>

</div>	
</div>
</div>


