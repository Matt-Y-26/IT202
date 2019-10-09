<?php
//helper
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
/*
function getName(){

	
	$str1 = $_POST['password'];
	$str2 = $_POST['passwordconfirm'];

		
	//echo "<p> pass and passcnf are, " . $str3 . " and " . $str4 . "</p>";
	if($str1 == $str2)
	{
		echo "<p>Theyre the same youre good</p>";
	}
	else
	{
		echo "<p>Theyre not the same, try again</p>";
	}
	
}
*/
?>
<html>
<head>
<script>
	function validate(){
		var form = document.forms[0];
		var password = form.password.value;
		var passwordconfirm = form.passwordconfirm.value;
		//console.log(password);
		//console.log(conf);
		let pv = document.getElementById("validation.password");
		let succeeded=true;
		if(password == passwordconfirm){
			pv.style.display = "none";
			//return true;
		}
		else
		{
			pv.style.display = "block";
			pv.innerText = "Passwords don't match";
			//alert ("Passwords don't match");
			succeeded=false;
		}
		var email = form.email.value;
		var ev = document.getElementById("validation.email");
		if(email.indexOf('@') > -1){
			ev.style.display = "none";
		}
		else{
			ev.style.display = "block";
			ev.innerText = "Please enter a valid email address";
			succeeded = false;
		}
		var gender = form.gender.value;
		var gv = document.getElementById("validation.gender");
		var cmp = gender.localeCompare("default");
		console.log(gender);
		console.log("default");
		if(gender=="default")
		{
			gv.style.display = "block";
			gv.innerText= "Please select a valid gender";
			succeeded=false;	
		}
		else
		{
			gv.style.display = "none";
		}
		return succeeded;
	
	}
</script>
</head>
<body>
	<div style="margin-left: 50%; margin-right:50%;">
	<form method="POST" action="#" onsubmit="return validate();"> 
		<input name = "username" type="text" placeholder="Enter your username"/>
		<input name = "email" type "email" placeholder="name@example.com"/>
		<span id="validation.email" style="display:none;"></span>
		
		<input name = "password" type="password" placeholder="Enter a FAKE password"/>		
		<input name = "passwordconfirm" type="password" placeholder="Reenter your password"/>
		<span style "display:none;" id="validation.password"></span>
		<select name="gender">
			<option value="default">Select One</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
			<option value="other">Other</option>
		</select>
		<span style "display:none;" id="validation.gender"></span>
		
		<input type="submit" value="Enter"/>
		
	
	</form>
</body>
</html>

<?php
if(isset($_GET)){
	echo "<br><pre>" . var_export($_POST, true) . "</pre><br>"; 
	} 
?>

