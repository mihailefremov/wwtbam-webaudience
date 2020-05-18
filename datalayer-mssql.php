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
		$conn=makeconnection();
		$sql="SELECT Timestamp FROM userslastactions WHERE username='" . $username . "'";
		
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
					
		$row_count = sqlsrv_num_rows( $stmt );
		
		if ($row_count === false)
			echo "Error in retrieveing row count.";
		//return;
		//else
		//echo $row_count;			
		
		if( $stmt === false) {
			die( print_r( sqlsrv_errors(), true) );
		}
		
		// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
			// //
			// $usertype_Db=$row[0];
			// $password_Db=$row[1];
			// //echo $row[0].", ".$row[1]."<br />";
		// }
		
		sqlsrv_close($conn);
		
		if($row_count>0)
		{
			return true;
		}
		return false;
	}

	function getaudienceanswers(){

		$conn=makeconnection();
		$sql="SELECT Username, GivenAnswer FROM audiencevotes order by Username ASC";
		
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );

		if( $stmt === false) {
			die( print_r( sqlsrv_errors(), true) );
		}
		
		$app="";
	    while($data= sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) )
      	 {
		
		   $app .= "
		   <tr>
		     <th scope='row'>$data[0]</th>
		     <td>$data[1]</td>
		   </tr>
		   ";
      	 }		
		 
		sqlsrv_close($conn);
		return $app;
	}		
	
	function insertlastaction(){
		
		try {

			$conn=makeconnection();
			
			$username = $_SESSION["Username_wwtbam-audiencevote"];
			
			$datei = date('Y-m-d');
			
			$sql="insert into userslastactions(Username,LastAction,Timestamp)
				  values('" . $username ."','User LogIn', '" . $datei . "')";
			
			//echo $sql;
			//return;
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt = sqlsrv_query( $conn, $sql , $params, $options );		

			$str ="Success insert";
			if( $stmt === false ) {
				$mssqliQueryErrorSuccess=sqlsrv_errors();
				$array=$mssqliQueryErrorSuccess;
				$str = implode(',', $array[0]);
			}			
			$mssqliQueryErrorSuccess = $str;
			
			sqlsrv_close($conn);
			
			if (strpos($mssqliQueryErrorSuccess, 'Success insert') !== false) {
				//do nothing
			} elseif (strpos(strtolower($mssqliQueryErrorSuccess), 'duplicate') !== false) {
				deletelastaction();
			} else {
				echo $mssqliQueryErrorSuccess;
			}
					
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			
		}  		

	}

	function deletelastaction(){
		try {
			$conn=makeconnection();
			$username = $_SESSION["Username_wwtbam-audiencevote"];
			$sql="delete from userslastactions where username = '" . $username ."' ";

			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt = sqlsrv_query( $conn, $sql , $params, $options );		

			$mysqliQueryErrorSuccess='';
			
			$str ="Success delete";
			if( $stmt === false ) {
				$mssqliQueryErrorSuccess=sqlsrv_errors();
				$array=$mssqliQueryErrorSuccess;
				$str = implode(',', $array[0]);
			}			
			$mssqliQueryErrorSuccess = $str;
			
			sqlsrv_close($conn);
			
			if (strpos($mssqliQueryErrorSuccess, 'Success delete') !== false) {
				//echo 'Deleted ✓';
			} else {
				//echo $mssqliQueryErrorSuccess;
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
			
			if (sqlsrv_query($cn,$s)) {
				$mysqliQueryErrorSuccess = "Success delete";
			} else {
				$mysqliQueryErrorSuccess = "Error: " . $s . "<br>" . sqlsrv_error($cn);
			}
			sqlsrv_close($cn);
			
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
		
		$q=sqlsrv_query($cn,$s);
		$r=sqlsrv_num_rows($q);
		$data=sqlsrv_fetch_array($q);
		sqlsrv_close($cn);
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