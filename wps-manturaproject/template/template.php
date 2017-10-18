<link rel="stylesheet" href="<?php echo plugins_url( 'src/style.css', dirname(__FILE__) ); ?>">
<script type="text/javascript" src="<?php echo plugins_url( 'src/custom.js', dirname(__FILE__) ); ?>"></script>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap">
<?php if(isset($_SESSION['wps_success']) && $_SESSION['wps_success']) { ?>
<div class="updated"><p><?php echo $_SESSION['wps_success']; ?></p></div>
<?php } ?>
<?php if(isset($_SESSION['wps_error']) && $_SESSION['wps_error']) { ?>
<div class="error"><p><?php echo $_SESSION['wps_error']; ?></p></div>
<?php } ?>
<?php include_once plugin_dir_path( __FILE__ ).$aParams['template'].".php"; ?>
<?php 
if(isset($_SESSION['wps_success']) && $_SESSION['wps_success']) { unset($_SESSION['wps_success']); }
if(isset($_SESSION['wps_error']) && $_SESSION['wps_error']) { unset($_SESSION['wps_error']); }
 ?>
</div>

