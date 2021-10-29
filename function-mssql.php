<?php
function makeconnection()
{
	$serverName = "IDEA-PC\\SQLEXPRESS01"; 
	
	$connectionInfo = array( "Database"=>"wwtbam");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
	if( $conn ) {
		 //echo "Connection established.<br />";
	}else{
		 echo "Connection could not be established.<br />";
		 die( print_r( sqlsrv_errors(), true));
	}
	return $conn;
}

?>