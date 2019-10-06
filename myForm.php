<?php
//helper
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
?>
<html>
<head></head>
<body>
<?php getName();?>
	<form mode="POST" action="#" method="post"> 
		<input name = "username" type="text" placeholder="Enter your username"/>
	
		<input name = "password" type="password" placeholder="Enter a FAKE password"/>
		
		<input name = "passwordconfirm" type="password" placeholder="Reenter your password"/>
		<input type="submit" value="Enter"/>
		
	
	</form>
</body>
</html>

<?php
if(isset($_GET)){
	echo "<br><pre>" . var_export($_POST, true) . "</pre><br>"; 
	} 
?>

