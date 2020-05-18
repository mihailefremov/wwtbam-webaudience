<?php
function makeconnection()
{
	$cn=mysqli_connect("localhost","root","P@ssw0rd","wwtbam");
	mysqli_set_charset($cn,"utf8mb4");

	if(mysqli_connect_errno())
	{
		echo "failed to connect to mysqli:".mysqli_connect_error();
	}
	return $cn;
}

?>