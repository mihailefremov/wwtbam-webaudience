<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php include_once('../function.php'); ?>
  <?php
	try {
		include_once('../datalayer.php'); 
		validateloginstatus();
		deletelastactionbyparameter($_REQUEST["username"]);
		
		echo "OK";				
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		
	}  
?>