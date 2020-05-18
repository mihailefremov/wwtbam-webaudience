<?php
function makeconnection()
{
	$cn=sqlsrv_connect("localhost","root","P@ssw0rd","wwtbam");
	sqlsrv_set_charset($cn,"utf8mb4");

	if(sqlsrv_connect_errno())
	{
		echo "failed to connect to mysqli:".sqlsrv_connect_error();
	}
	return $cn;
}

?>