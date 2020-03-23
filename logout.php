<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
//$_SESSION["username"]="";
//$_SESSION["usertype"]="";
//$_SESSION["loginstatus"]="";
   // unset($_SESSION["username"]);
   // unset($_SESSION["password"]);
   // unset($_SESSION["usertype"]);
   // unset($_SESSION["loginstatus"]);
   include_once('datalayer.php');
   deletelastaction();
   
   session_unset();
   session_destroy();

header("location:loginform.php");
?>
</body>
</html>