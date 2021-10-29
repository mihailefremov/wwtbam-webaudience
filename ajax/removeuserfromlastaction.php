<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php 

	$this_dir = dirname(__FILE__);
	$parent_dir = realpath($this_dir . '/..'); 
	include_once($parent_dir . '\function.php');
	include_once($parent_dir . '\datalayer.php'); 
	
	try {
		include_once($parent_dir . '\datalayer.php');
		validateloginstatus();
		deletelastactionbyparameter($_REQUEST["username"]);
		
		echo "OK";				
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		
	}  
?>