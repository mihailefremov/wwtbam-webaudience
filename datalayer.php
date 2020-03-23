<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php include_once('function.php'); ?>
  <?php
	// function getlastaction(){
		// $cn=makeconnection();
		// $username = $_SESSION["Username_wwtbam-audiencevote"];
		// $s="SELECT Timestamp FROM `userslastactions` WHERE username='" . $username . "' limit 1";
		
		// $q=mysqli_query($cn,$s);
		// $r=mysqli_num_rows($q);
		// $data=mysqli_fetch_array($q);
		// mysqli_close($cn);
		// if($r>0)
		// {
			// return $data[0];				
		// }
		// else
		// {
			// return '2000-01-01 00:00:00.00';
		
		// }
	// }

	function validateloginstatus(){
		if(isset($_SESSION) and isset($_SESSION["loginstatus_wwtbam-audiencevote"]))	
		{
			if (($_SESSION["loginstatus_wwtbam-audiencevote"]=="")) 
			{ 
				return -1;
				//header("location:loginform.php");
			} elseif (checkifuseractive($_SESSION["Username_wwtbam-audiencevote"],2,1)==false and ($_SESSION["Usertype_wwtbam-audiencevote"]!='admin')) { 
				//ne naprail nisto posledni dva dena
				return -2;
				header("location:logout.php");
			}
			
			return 1;
		}
		else 
		{
			return -1;
			header("location:loginform.php");
		}
	}
	
	function checkifuseractive($username,$lastactive,$dayshoursminutes){
		//days=1 hours=2 minutes=3
		if ($dayshoursminutes=1) {
			$dayshoursminutes="DAY";
		} elseif ($dayshoursminutes=2) {
			$dayshoursminutes="HOUR";
		} elseif ($dayshoursminutes=2) {
			$dayshoursminutes="MINUTE";
		}
		$cn=makeconnection();
		$s="SELECT Timestamp FROM `userslastactions` WHERE username='" . $username . "' 
		and `userslastactions`.Timestamp>=NOW()- INTERVAL " . $lastactive . " " . $dayshoursminutes . " ";
		
		$q=mysqli_query($cn,$s);
		$r=mysqli_num_rows($q);
		$data=mysqli_fetch_array($q);
		mysqli_close($cn);
		if($r>0)
		{
			return true;				
		}
		else
		{
			return false;
		
		}
	}

	function getaudienceanswers(){

		$cn=makeconnection();
		$s="SELECT Username, GivenAnswer FROM `audiencevotes` order by Username ASC";
		
		$q=mysqli_query($cn,$s);
		$r=mysqli_num_rows($q);
		mysqli_close($cn);
		return $q;
	}		
	
	function insertlastaction(){
		try {
			$cn=makeconnection();
			$username = $_SESSION["Username_wwtbam-audiencevote"];
			$s="insert into `userslastactions` values('" . $username ."','User LogIn',CURRENT_TIMESTAMP)
			on duplicate key update 
			`userslastactions`.LastAction='User LogIn', 
			`userslastactions`.Timestamp = CURRENT_TIMESTAMP
			";
			$mysqliQueryErrorSuccess='';
			
			if (mysqli_query($cn,$s)) {
				$mysqliQueryErrorSuccess = "Success insert";
			} else {
				$mysqliQueryErrorSuccess = "Error: " . $s . "<br>" . mysqli_error($cn);
			}
			#echo $mysqliQueryErrorSuccess;
			#mysqli_query($cn,$s); //sega go staviv da se povikuva gore vo if-ot, za da znam dali e uspesen insertot
			mysqli_close($cn);
			
			if (strpos($mysqliQueryErrorSuccess, 'Success insert') !== false) {
				return 'Success insert log';
			} elseif (strpos(strtolower($mysqliQueryErrorSuccess), 'duplicate') !== false) {
				return 'Duplicate insert log';
			} else {
				return 'Error';
			}
					
		} catch (Exception $e) {
			return 'Error';
			
		} 
	}

	function deletelastaction(){
		try {
			$cn=makeconnection();
			$username = $_SESSION["Username_wwtbam-audiencevote"];
			$s="delete from `userslastactions` where `userslastactions`.username = '" . $username ."' ";
			$mysqliQueryErrorSuccess='';
			
			if (mysqli_query($cn,$s)) {
				$mysqliQueryErrorSuccess = "Success delete";
			} else {
				$mysqliQueryErrorSuccess = "Error: " . $s . "<br>" . mysqli_error($cn);
			}
			mysqli_close($cn);
			
			if (strpos($mysqliQueryErrorSuccess, 'Success delete') !== false) {
				return 'Success delete log';
			} elseif (strpos(strtolower($mysqliQueryErrorSuccess), 'duplicate') !== false) {
				return 'Duplicate insert log';
			} else {
				return 'Error';
			}
					
		} catch (Exception $e) {
			return 'Error';
			
		} 
	}
	
	function deletelastactionbyparameter($username){
		try {
			$cn=makeconnection();
			$s="delete from `userslastactions` where `userslastactions`.username like '" . $username ."' ";
			$mysqliQueryErrorSuccess='';
			
			if (mysqli_query($cn,$s)) {
				$mysqliQueryErrorSuccess = "Success delete";
			} else {
				$mysqliQueryErrorSuccess = "Error: " . $s . "<br>" . mysqli_error($cn);
			}
			mysqli_close($cn);
			
			if (strpos($mysqliQueryErrorSuccess, 'Success delete') !== false) {
				return 'Success delete log';
			} elseif (strpos(strtolower($mysqliQueryErrorSuccess), 'duplicate') !== false) {
				return 'Duplicate insert log';
			} else {
				return 'Error';
			}
					
		} catch (Exception $e) {
			return 'Error';
			
		} 
	}
	
	function countaudienceseats(){
		$cn=makeconnection();
		$s="SELECT Count(users.Username) as 'AudienceSeats' FROM users where users.Username like 'ag%'";
		
		$q=mysqli_query($cn,$s);
		$r=mysqli_num_rows($q);
		$data=mysqli_fetch_array($q);
		mysqli_close($cn);
		if($r>0)
		{
			return $data[0];				
		}
		else
		{
			return 0;
		
		}
	}		
?>