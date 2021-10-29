<?php 
  include_once('..\readfromfile.php');// path to admin/
	
	$this_dir = dirname(__FILE__);
	$parent_dir = realpath($this_dir . '/..'); 
	$typeScript = "savetheresponse-" . readFromFile($parent_dir . "\database-type.config") . ".php";
	
	include_once($typeScript);
?>