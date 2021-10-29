<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php 
	$this_dir = dirname(__FILE__);
	$parent_dir = realpath($this_dir . '/..'); 
	include_once($parent_dir . '\function.php');
	include_once($parent_dir . '\datalayer.php'); 
	validateloginstatus();
 ?>
  <?php
	try {

		$conn=makeconnection();
		$sql="insert into audiencevotes(Username,GivenAnswer) 
			  values('" . strtolower($_SESSION["Username_wwtbam-audiencevote"]) ."','" . $_REQUEST["answer"] ."')";
		
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		

		$str ="Success insert";
		if( $stmt === false ) {
			$str="";
			$mssqliQueryErrorSuccess=sqlsrv_errors();
			$array=$mssqliQueryErrorSuccess;
			$str = implode(' ', $array[0]);
		}			
		$mssqliQueryErrorSuccess = $str;
		
		
		sqlsrv_close($conn);
		
		if (strpos($mssqliQueryErrorSuccess, 'Success insert') !== false) {
			echo 'Response saved ✓';
		} elseif (strpos(strtolower($mssqliQueryErrorSuccess), 'duplicate') !== false) {
			echo 'You already responded to the question. ';
		} else {
			echo $mssqliQueryErrorSuccess;
		}
				
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		
	}  
?>