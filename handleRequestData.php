<?php
	echo "<pre>" . var_dump($_GET, true) . "</pre>";
	
	if(isset($_GET['name'])){
		echo "<br>Hello, " . $_GET['name'] . "<br>";
	}
	if(isset($_GET['word1'])){
	if(isset($_GET['word2'])){
	echo "<br>Hello, again concatenate is " . $_GET['word1'] . "" . $_GET['word2'] . "<br>";
	}
	}
	
	if(isset($_GET['int1'])){
	if(isset($_GET['int2'])){
		echo "<br>" . $_GET['int1'] . " " . $_GET['int2'] . " should be ints";
		$int1 = $_GET['int1'];
		$int2 = $_GET['int2'];
		if(is_numeric($int1))
		{
		echo "<br>int1 is a num ";
		if(is_numeric($int2))
		{
		echo "<br>int2 is a num";
		$sum=$int1+$int2;
		echo "<br> The value of the ints is ". $sum;
		
		}
		else
		{
			echo"<br>int2 is a not a num";
		}
		}
		else
		{
			echo"<br>int1 is not a num";
		}
	}
	}
?>
