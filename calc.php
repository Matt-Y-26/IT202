<?php
session_start();
?>

<html>
<head>
<script>
function checkempty(form){
	var i = form.intr.value;
	var m = form.mon.value;
	if(i<=0)
	{
		alert("Invalid interest given");
		return false;
	}
	if(i>100)
	{
		alert("Please reduce the interest from between 1-100);
		return false;
	}
	if(m<=0)
	{
		alert("Invalid months given"); return false;
	}

	return true;
}
</script>
</head>
<body>
<div style="margin-left: 35%; margin-right:35%;">
<article>
	<h1>Welcome to monthly interest savings calculator!</h1>
	<p>Based off of<p> <a href="http://www.webmath.com/simpinterest.html">This calculator</a>
	<p>To do the calculation please input your simple interest percentage and how many months you want to see how 
much you will earn</p>
</article>
<a href="landingpg.php">Back to dashboard</a>
<br></br>
<?php echo "You have " . $_SESSION['money'] . " dollars"; ?>
<form method="POST" onsubmit="return checkempty(this);"/>
	<input type="number" name="intr" placeholder="Interest"/>
	<input type="number" name="mon" placeholder="Month"/>
	<input type="submit" value="Calculate"/>
</form>

</body>
<?php
	$intr = $_POST['intr'];
	$mon = $_POST['mon'];
	$cash = $_SESSION['money'];
	if($mon>=1)
	{
		if($intr>=1)
		{
			//valid do calculations
			echo "The result is : ";
			//its a simple interest so its just a multi formula
			if($intr>=10)
			{ 
			$intr="." . $intr; //convert interest to decimal
			}
			else   //single digit
			{
			$intr=".0" . $intr;
			}
			echo $intr * $mon * $cash;
		}
	}
?>

