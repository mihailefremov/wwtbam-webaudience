
 <?php if(!isset($_SESSION)) { session_start(); }
	//echo session_id();
 ?>
 
 <?php include_once('function.php');
	include_once('datalayer.php'); 

	if (validateloginstatus()==-1){
		echo "Unauthorized access";
		return;
	} elseif (validateloginstatus()==-2){
		echo "Unauthorized access. User not logged in past two days";
		return;
		//
	} elseif (validateloginstatus()==1){
		//echo "1";
	}
	
 ?>
 
  <?php
	try {
		$AudienceSeat = $_REQUEST["Seat"];
		$AudienceAnswer = $_REQUEST["Answer"];
		
		if(!is_numeric($AudienceAnswer)){
			echo "Bad Audience Answer!";
			return;
		}
		
		if(!is_numeric(str_replace("ag","",$AudienceSeat))){
			echo "Bad Audience Seat!";
			return;
		}
		
		
		$cn=makeconnection();
		$s="insert into audiencevotes(Username,GivenAnswer) values('" . strtolower($AudienceSeat) ."','" . $AudienceAnswer ."')";

		$mysqliQueryErrorSuccess='';
		
		if (mysqli_query($cn,$s)) {
			$mysqliQueryErrorSuccess = "Success insert";
		} else {
			$mysqliQueryErrorSuccess = "Error: " . $s . "<br>" . mysqli_error($cn);
		}
		//mysqli_query($cn,$s); //sega go staviv da se povikuva gore vo if-ot, za da znam dali e uspesen insertot
		mysqli_close($cn);
		
		if (strpos($mysqliQueryErrorSuccess, 'Success insert') !== false) {
			echo 'Response saved';
		} elseif (strpos(strtolower($mysqliQueryErrorSuccess), 'duplicate') !== false) {
			echo 'You already responded to the question';
		} else {
			echo $mysqliQueryErrorSuccess;
		}
				
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		
	}  
?>