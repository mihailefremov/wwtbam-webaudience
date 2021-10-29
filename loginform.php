<?php 
  include_once('readfromfile.php'); 
  $typeScript = "loginform-" . readFromFile("database-type.config") . ".php";
  include_once($typeScript);
?>