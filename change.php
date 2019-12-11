<?php
session_start();
?>
<html>
<head>
<script>
	function checkempty(form){
	var curuser = form.curuser.value;
	var newuser = form.newuser.value;
	var curpas = form.curpas.value;
	var newpas = form.newpas.value;
	//youre gonna have to do checks in the server
	if(newuser=="")
	{
	return false;
	}
	if(newpas=="")
	{
	return false;
	}	
	if(newuser!="")
	{
	if(curuser=="")
	{
	alert("Fill out current user");
	return false;
	}
	}
	
	if(newpas!="")
	{
	if(curpas=="")
	{
	alert("Fill out current password");
	return false; 
	}
	}
	var checkbox = document.getElementById("mycheck");
	if(checkbox.checked==false)
	{
		alert("You forgot to check the checkmark");
		return false;
	}
	return true;
	
	}
</script>
</head>
<div style="margin-left: 35%; margin-right: 35%;">
<article>
<h1>Account details</h1>
<p> Here are you can change your account details </p>
<a href="landingpg.php">Back to dashboard</a>
<br></br>
<p>
Here you can change your account details, you must provide your current and old username/password in order 
for any change to occur. If you wish only to change your username, input your current password twice in 
enter current password and enter new password </p>
<form method="POST" onsubmit="return checkempty(this);">
	<input type="text" name="curuser" placeholder="Enter current username"/>
	<input type="text" name="newuser" placeholder="Enter new username"/>
	<input type="password" name="curpas" placeholder="Enter current password"/>
	<input type="password" name="newpas" placeholder="Enter new password"/>
	<br></br>
	<input type="checkbox" id="mycheck">
	Selecting this checkmark I confirm the information above is correct
	<br></br>
	Delete account?
	<select name="option">
		<option value="no">no</option>
		<option value="yes">yes</option>
	</select>

	<p>Selecting 'yes' will delete your account, note you must have 0 dollars in your savings and 
checkings account</p>
	<br></br>
	<input type = "submit" value="Submit"/>
</form>
</html>

<?php

	$curuser= $_POST["curuser"];
       $newuser= $_POST["newuser"];
       $curpas= $_POST["curpas"];
       $newpas= $_POST["newpas"];
	$sesuser= $_SESSION['user'];
	$opt = $_POST['option'];
	echo "Hello?";
	require('config.php');
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	
	$select_query = "SELECT `password` FROM `ProjUsers` WHERE username =:username";
	//echo "DOesnt work below";
	$db = new PDO($conn_string, $username, $password);
	$stmt = $db->prepare($select_query);
	//echo "yes it does";
	$r = $stmt->execute(array(":username"=>$curuser));
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	//echo "hello";
	$getdbpass = $results['password'];
	$hash = password_hash($curpas, PASSWORD_BCRYPT);
	//echo "Here?";
	if(password_verify($curpas,$getdbpass))
	{
		//success 
		//echo "del later passwords match";
		//if opt is no or yes
		//if no continue on as normal
		//if($
		echo "Success";
		if($opt == "no")
		{
			//update database with new name and password
			require("config.php");
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";				
			$idnum=$_SESSION['id'];
			$stmt = $db->prepare("UPDATE `ProjUsers` SET `username` =:newuser WHERE ID = :id");
			$result = $stmt->execute(
			array(":newuser"=>$newuser,
				":id"=>$idnum
				)
			);
			
			$stmt = $db->prepare("UPDATE `ProjUsers` SET `password` =:newpas WHERE ID = :id");
			$result = $stmt->execute(
			array(":newpas"=>$hash,
				":id"=>$idnum
				)
			);
			//above should of updated
			//update the session name as well
			$_SESSION['user']=$newuser;
			echo "Success!";
			
		
		}
		else
		{
			//prepare to delete (Actually might just change all values to 0
			//THEN redirect to homepage
			
		}
		
	}
	else
	{
		echo "Password invalid";
	}


?>
