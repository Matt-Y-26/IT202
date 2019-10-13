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
		
		//let uv = document.getElementById("validation.username");
		let sev = document.getElementById("validation.sameemail");
		var emailconfirm = form.emailconfirm.value;
		if(password == "" || passwordconfirm == "")
		{
			pv.style.display = "block";
			pv.innerText = "One of the password fields is empty";
			succeeded = false;
		}
		else {
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
		}


		var email = form.email.value;
		var ev = document.getElementById("validation.email");
		var confirmemail = form.emailconfirm.value;	
	
		if(email=="" || confirmemail == "")
		{
			ev.style.display = "block";
			ev.innerText = "One or more of the email inputs are empty please input email";
			succeeded = false;
		}
		else {
		ev.style.display = "none";
		if(email==confirmemail)
		{
		sev.style.display = "none";
		if(email.indexOf('@') > -1){
			//ev.style.display = "none";
		}
		else{
			ev.style.display = "block";
			ev.innerText = "Please enter a valid email address";
			succeeded = false;
		}
		if(confirmemail.indexOf('@') > -1){
			//sev.style.display = "none";
		}
		else
		{
			sev.style.display = "block";
			sev.innerText = "Please enter a valid email address";
			succeeded = false;
		}
		}
		else
		{
			sev.innerText= "Emails are not the same";
			succeeded = false;
		}
		
	
		}
		var username = form.username.value;
		var uv = document.getElementById("validation.username");
		uv.style.display = "none";
		if(username == "")
		{
			uv.style.display = "block";
			uv.innerText = "Username is empty";
			succeeded = false;
		}
		return succeeded;
	
	}
</script>
</head>
<body>
	<div style="margin-left: 50%; margin-right:50%;">
	<form method="POST" action="#" onsubmit="return validate();"> 
		
		<input name = "email" type "email" placeholder="name@example.com"/>
		<span id="validation.email" style="display:none;"></span>
		<input name = "emailconfirm" type "email" placeholder="reenter email"/>
		<span style "display:none;" id="validation.sameemail"></span>

		<input name = "password" type="password" placeholder="Enter a FAKE password"/>		
		<input name = "passwordconfirm" type="password" placeholder="Reenter your password"/>
		<span style "display:none;" id="validation.password"></span>

		<input name= "username" type="text" placeholder="Enter your username"/>
		<span style "display:none;" id="validation.username"></span>
		
		<input type="submit" value="Enter"/>
	
	</form>
</body>
</html>

<?php
if(isset($_GET)){
	echo "<br><pre>" . var_export($_POST, true) . "</pre><br>"; 
	} 
?>

