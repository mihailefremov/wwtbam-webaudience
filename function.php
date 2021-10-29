<?php 
  include_once('readfromfile.php'); 
  $typeScript = "function-" . readFromFile(dirname(__FILE__)."\database-type.config") . ".php";
  include_once($typeScript);
?>