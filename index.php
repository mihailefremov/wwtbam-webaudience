<?php if(!isset($_SESSION)) { session_start(); }?>
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
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
							<a class='nav-link' href='availableseats.php'>Available Seats</a>
						  </li>";
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
						echo "<li class='nav-item'>
							<a class='nav-link' href='audienceanswers.php'>Audience Answers</a>
						  </li>";
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
				<a class="dropdown-item" href="logout.php">Log Out <?php try {echo $_SESSION["Username_wwtbam-audiencevote"];}catch (Exception $e) {} ?></a>
            </div>
          </li>
        </ul>
    
  </div>
    </nav>
	<?php
	include_once('datalayer.php');
	if (validateloginstatus()==-1){
		header("location:loginform.php");
	} elseif (validateloginstatus()==-2){
		header("location:logout.php");
	} elseif (validateloginstatus()==1){
		//nothing
	}
#2019-09-29 > 2019-09-26
	?>

	
    <main role="main" class="container">

      <div class="starter-template">
        <div class="row">
			<!-- <div class="col-sm-12" id="questionPlace"><h5 id="questionset">Buzz by pressing the button bellow</h5></div>
		--></div>
        <div class="row">
			<div class="col-sm-12"><button onclick="writeData(1)" type="submit" name="sbmt" value="1" id="ansButton" class="btn btn-lg btn-block"><h1 style='font-size:2.4em' id="ans1set" >A</h1></button></div>
		</div>
		<div class="row">
			<div class="col-sm-12"><button onclick="writeData(2)" type="submit" name="sbmt" value="2" id="ansButton" class="btn btn-lg btn-block"><h1 style='font-size:2.4em' id="ans1set" >B</h1></button></div>
		</div>
        <div class="row">
			<div class="col-sm-12"><button onclick="writeData(3)" type="submit" name="sbmt" value="3" id="ansButton" class="btn btn-lg btn-block"><h1 style='font-size:2.4em' id="ans1set" >C</h1></button></div>
		</div>
		<div class="row">
			<div class="col-sm-12"><button onclick="writeData(4)" type="submit" name="sbmt" value="4" id="ansButton" class="btn btn-lg btn-block"><h1 style='font-size:2.4em' id="ans1set" >D</h1></button></div>
		</div>
		<div class="row" >
			<div class="col-sm-12" id="resultXmldiv">
				<h3 id="resultXmlHover" style="margin-top:0.1em; padding-top:0px" ></h3>
			</div>
		</div>
      </div>

    </main><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
	<script src="js/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

	<script src="jquery/jquery-3.2.1.min.js"></script>
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
	
	function writeData(answer){		
		var xhttp = new XMLHttpRequest();
		document.getElementById("resultXmlHover").innerHTML = "You pressed the button. ☝";
		//xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// Typical action to be performed when the document is ready:
			document.getElementById("resultXmlHover").innerHTML = xhttp.responseText; // "Successful buzzing ✓"; 
			if (xhttp.responseText.includes("Response saved")){
				document.getElementById("resultXmlHover").style.color="green";
				setTimeout(resetResponse,4000);
			} else{
				document.getElementById("resultXmlHover").style.color="red";
				setTimeout(resetResponse,6000);
			}
		};
		}	
		xhttp.open("POST", "ajax/savetheresponse.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("answer="+answer+"&lor=ip");
		//xhttp.send();
	}
	</script>
  </body>
</html>