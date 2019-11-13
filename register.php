<?php
session_start();
?>

<html>
<head>
<script>
function checkpassuser(form){
	var passcheck = form.password.value == form.confirm.value;
	var usercheck = form.username.value;
	//alert(passcheck);
	if(usercheck=="")
	{
		alert("Username is not set, please set username");
		usercheck=false;
	}
	if(!passcheck) {
		alert("Passwords do not match, please change your password and confirm password are correct");
	}
	passcheck = usercheck && passcheck;
	//I think it works alert(passcheck);
	return passcheck;
}
</script>
</head>
<div style="margin-left: 35%; margin-right:35%;">
<p> Please register with a username and password and make sure to confirm the password </p>
<body>
	<form method="POST" onsubmit="return checkpassuser(this);"/>
		<input type="test" name="username" placeholder="Enter Username"/>
		<input type="password" name="password" placeholder="Enter Password"/>
		<input type="password" name="confirm" placeholder="Re-Enter Password"/>
		<input type="submit" value="Register"/>
	</form>
</body>
</html>

<?php
	//check insert do all the good stuff needed
	$user = $_POST['username'];
        $passwd = $_POST['password'];
        $confirm = $_POST['confirm'];

	if($user != ""){
	if($passwd != ""){
	//no point in checking two, since you check if theyre equal
		//get vars

		//$user = $_POST['username'];
		//$passwd = $_POST['password'];
		//$confirm = $_POST['confirm'];
		
		if($passwd != $confirm)
		{
			echo "Password and confirm password do not match";
			//return 0; //uh should I do exit or die here instead???
			exit();
		}

		try{
			$hash= password_hash($passwd, PASSWORD_BCRYPT);
			require("config.php");

			$conn_string= "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
			$stmt = $db->prepare("INSERT into `ProjUsers` (`username`,`password`) VALUES(:username, 
:password)");
			
			$result = $stmt->execute(
				array(":username"=>$user,
					":password"=>$hash
				)
			);
			print_r($stmt->errorInfo());

			echo var_export($result,true);

		}
		catch(Exception $e)
		{
			echo "There seems to be a problem with the database";
		}

		}
	
	}

?>
