<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

	
	<?php include_once('function.php'); ?>
		<?php
		//$_SESSION["loginstatus"]="";
		if(isset($_POST["sbmt"]))
		{
			//echo "is post";
			$conn=makeconnection();

			$sql = "select typeofuser,pwd from users where Username='" . $_POST["Username_wwtbam-audiencevote"] . "' and Pwd='" . $_POST["Password_wwtbam-audiencevote"] ."'";
			//echo $sql;
		
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt = sqlsrv_query( $conn, $sql , $params, $options );
						
			$row_count = sqlsrv_num_rows( $stmt );
			
		
			if ($row_count === false) {
			   echo "Error in retrieveing row count.";		
			}			   			

			if( $stmt === false) {
				die( print_r( sqlsrv_errors(), true) );
			}

			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
				//
				$usertype_Db=$row[0];
				$password_Db=$row[1];				
				//echo $row[0].", ".$row[1]."<br />";
			}
				//return;		
			sqlsrv_close($conn);
			if($row_count>0)
			{
				
				$_SESSION["Username_wwtbam-audiencevote"]=$_POST["Username_wwtbam-audiencevote"];
				$_SESSION["Usertype_wwtbam-audiencevote"]=strtolower($usertype_Db);
				$_SESSION["Password_wwtbam-audiencevote"]=$password_Db;
				$_SESSION["loginstatus_wwtbam-audiencevote"]="yes";
				
				include_once('datalayer.php');
							
				if ($_SESSION["Usertype_wwtbam-audiencevote"]!='admin') {
					// if (checkifuseractive($_SESSION["Username_wwtbam-audiencevote"],2,1)){
						// echo '<div class="alert alert-danger">  <strong>Error!</strong> User already logged in. Choose a different user.</div>';
					// } else{
						insertlastaction();		
						echo '<div class="alert alert-success"><strong>Success!</strong> Indicates a successful or positive action. </div>';			
						header("location:index.php");		
					//}					
				} else {
					header("location:index.php");	
				}			

			}
			else
			{
				echo '<div class="alert alert-danger">  <strong>Error!</strong> Wrong username or password!</div>';
				$_POST["sbmt"]="";

			}
		} else{
			//echo "not post";
		}
		?>
	
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="Username_wwtbam-audiencevote" class="sr-only">Email address</label>
        <input type="Username_wwtbam-audiencevote" name="Username_wwtbam-audiencevote" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
        <label for="Password_wwtbam-audiencevote" class="sr-only">Password</label>
        <input type="Password" name="Password_wwtbam-audiencevote" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Log In" name="sbmt">
      </form>

    </div> <!-- /container -->
  </body>
</html>
