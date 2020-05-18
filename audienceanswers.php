<?php if(!isset($_SESSION)) { session_start(); } /**/?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WWTBAM-Audience</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
	
	<link href="css/grid.css" rel="stylesheet">

  </head>

  <body>
  
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="index.php">Audience Voting</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Manual</a>
          </li>
		  <?php 
			try 
			{
				if(isset($_SESSION["Usertype_wwtbam-audiencevote"])){
					if ($_SESSION["Usertype_wwtbam-audiencevote"]=='admin') {
						echo "<li class='nav-item'>
							<a class='nav-link' href='availableseats.php'>Available Seats <span class='sr-only'>(current)</span></a>
						  </li>";
					} else{
						header("location:index.php");
					}
				}					
			}
			catch (Exception $e) 
			{
				#echo $e->getMessage();
			} 
		  ?>
		  <?php 
			try 
			{
				if(isset($_SESSION["Usertype_wwtbam-audiencevote"])){
					if ($_SESSION["Usertype_wwtbam-audiencevote"]=='admin') {
						echo "<li class='nav-item active'>
							<a class='nav-link' href='audienceanswers.php'>Audience Answers</a>
						  </li>";
					} else{
						header("location:index.php");
					}
				}					
			}
			catch (Exception $e) 
			{
				#echo $e->getMessage();
			} 
		  ?>
          <li class="nav-item dropdown" >
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
				<a class="dropdown-item" href="#">Settings</a>
				<a class="dropdown-item" href="logout.php">Log Out 
				<?php 
				try 
				{
					if(isset($_SESSION["Username_wwtbam-audiencevote"])){
						echo $_SESSION["Username_wwtbam-audiencevote"];
					}					
				}
				catch (Exception $e) 
				{
					#echo $e->getMessage();
				} 
				?></a>
            </div>
          </li>
        </ul>
    
  </div>
    </nav>
	<?php
	/*
	include_once('datalayer.php');
	if (($_SESSION["loginstatus_wwtbam-audiencevote"]=="") or (getlastaction()<date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')))))
	{
		header("location:loginform.php");
	} #2019-09-29 > 2019-09-26*/
	?>
	
	<main role="main" class="container">
	   <div class="starter-template text-center">
	   

	   
	   
	   <?php
	   include_once('datalayer.php');
	   
	   $total = countaudienceseats();
	   $index = 0;
	   $result = getaudienceanswers();

		echo "
		<table class='table'>
		  <thead class='thead-light'>
			<tr>
			  <th scope='col'>Position</th>
			  <th scope='col'>Answer</th>
			</tr>
		  </thead>
		  <tbody>";

	   echo $result;

		echo "
		  </tbody>
		</table>";		
		?>
	   
	   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				...
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			  </div>
			</div>
		  </div>
		</div>
	   
	   <!--
		  <div class="row mb-12">
			 <div class="col-md-1"></div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >1</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >2</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >3</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >4</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >5</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >6</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >7</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >8</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block">
				   <h1 style='font-size:1.0em' id="ans1set" >9</h1>
				</button>
			 </div>
			 <div class="col-md-1">
				<button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block" align="center">
				   <h1 style='font-size:1.0em' align="center" id="ans1set" >10</h1>
				</button>
			 </div>
			 <div class="col-md-1"></div>
		  </div>
	   </div>-->
	</main>
<!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

<script>
	updateQA();
	function updateQA(){
		// $('#questionset').load("ajax/getquestion.php");
		// $('#ans1set').load("ajax/getanswer1.php");
		// $('#ans2set').load("ajax/getanswer2.php");
		// $('#ans3set').load("ajax/getanswer3.php");
		// $('#ans4set').load("ajax/getanswer4.php");
	}
	setInterval("updateQA()",1500);
	
	function resetResponse(){
		document.getElementById("resultXmlHover").innerHTML = "";
	}
	
	function resetLastActions(username){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// // Typical action to be performed when the document is ready:
			document.getElementById("resultXmlHover").innerHTML = xhttp.responseText; // "Successful buzzing ✓"; 
			if (xhttp.responseText.includes("Response saved")){
				document.getElementById("resultXmlHover").style.color="green";
				setTimeout(resetResponse,3000);
			} else{
				document.getElementById("resultXmlHover").style.color="red";
				setTimeout(resetResponse,6000);
			}
		};
		}	
		xhttp.open("POST", "ajax/removeuserfromlastaction.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");		
		xhttp.send("username=ag"+username+"&param=p");
	}
	</script>
  </body>
</html>
