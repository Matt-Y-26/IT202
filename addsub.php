<?php
session_start();
?>

<html>
<head>
<script>
function checkempty(form){
	//this function does two things: checks if amount is empty and if checkbox was checked
	var amt = form.amount.value;
	//var chk = form.
	
	//alert(check);
	if(amt=="")
	{
		alert("Amount empty, please input amount");
		return false;
	}
	else if(amt<=0)
	{
		alert("Invalid amount");
		return false;
	}
	
	var checkbox = document.getElementById("mycheck");
	if(checkbox.checked==false)
	{
		alert("You did not check the checkbox");
		return false;
	}
	//alert("helo?");
	/*
	if(document.getElementById('check').checked)
	{
		alert("checked");
	}
	*/
	//alert(check.checked);
	//alert(check);
	//alert("hello?");
	
	return true;
}
</script>
</head>
<div style="margin-left: 35%; margin-right:35%;">
<article>
<h1>Welcome to the add and take out money page!</h1>
<br></br>
<p>Here you can add or take money, just input the amount you want to add or take out and check the box to confirm</p>
</article>
<a href="landingpg.php">Back to dashboard</a>
<br></br>

<form method="POST" onsubmit="return checkempty(this);">
	<input type="number" name="amount" step=".01" placeholder="Enter the amount you want to deal with"/>
	<br></br><select name="option">
		<option value="add">Add</option>
		<option value="takeout">Take out</option>
	</select>
	<br></br>
	<input type="checkbox" id="mycheck">
	Selecting yes in this box I confirm that the information above is correct
	<br></br><input type="submit" value="Submit"/>
</form>
</body>
</html>

<?php
	$amt = $_POST['amount'];
	$opt = $_POST['option'];
	$curmon=$_SESSION['money'];
	error_reporting(-1);
	//echo "You have " . $curmon . " dollars";	

	if($amt != "")
	{
		if($opt == "add")
		{
			//add the amount to bank
			$curmon=$curmon+$amt;
			
		}
		else //no need for if only two options
		{
			if($curmon<$amt)
			{
				echo "You're trying to take out more than you have";
				return 0;
			}
			$curmon=$curmon-$amt;
			//take out amt
		}
		
		try
		{
			$idnum=$_SESSION['id'];
			require("config.php");
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
			$stmt = $db->prepare("UPDATE `ProjUsers` SET `money` = :curmon WHERE ID = :id");
			$result = $stmt->execute(
				array(":curmon"=>$curmon,
					":id"=>$idnum
				)
			);
			//print_r($stmt->errorInfo());
			//echo var_export($result,true);
			//echo $curmon;
			//set the new session money to new curmon
			$_SESSION['money']=$curmon;
			//header("Location: landingpg.php");
		}
		catch(Exception $e)
		{
			echo "Error with database";
		}
		
	
	echo "You now have " . $curmon . " dollars";
	}
?>
