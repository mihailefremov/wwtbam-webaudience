<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php include_once('../function.php');
	include_once('../datalayer.php'); 
	validateloginstatus();
 ?>
  <?php
	try {
		$cn=makeconnection();
		$s="insert into audiencevotes(Username,GivenAnswer) values('" . strtolower($_SESSION["Username_wwtbam-audiencevote"]) ."','" . $_REQUEST["answer"] ."')";

		$mysqliQueryErrorSuccess='';
		
		if (mysqli_query($cn,$s)) {
			$mysqliQueryErrorSuccess = "Success insert";
		} else {
			$mysqliQueryErrorSuccess = "Error: " . $s . "<br>" . mysqli_error($cn);
		}
		//mysqli_query($cn,$s); //sega go staviv da se povikuva gore vo if-ot, za da znam dali e uspesen insertot
		mysqli_close($cn);
		
		if (strpos($mysqliQueryErrorSuccess, 'Success insert') !== false) {
			echo 'Response saved ✓';
		} elseif (strpos(strtolower($mysqliQueryErrorSuccess), 'duplicate') !== false) {
			echo 'You already responded to the question. ';
		} else {
			echo $mysqliQueryErrorSuccess;
		}
				
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		
	}  
?>