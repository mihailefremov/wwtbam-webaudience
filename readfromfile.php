<?php 

	function readFromFile($filePath){
		//echo "filePathreadFromFilePHP" . $filePath. "<br>";
		//echo "readFromFilePHP".dirname(__FILE__) . "<br>";
		
		$myfile = fopen($filePath, "r") or die("Unable to open file!");
		$contentFromFile = fgets($myfile);
		fclose($myfile);
	
		return $contentFromFile;
	
	}
	
?>