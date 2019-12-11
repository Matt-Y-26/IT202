<?php
session_start();
?>

<html>
<head>
<script>
function empt(form)
{
return true;
}
</script>
</head>



<article>
<h3> Welcome to loan management </h3>
<p>You have <?php echo $_SESSION['loanmoney'] ?> in loan money </p>
<p>You owe <?php echo $_SESSION['loanamt'] ?> in loans at a 5% interest rate, meaning when you repay
you have to pay an additional 5% of what was taken out </p>
</article>
<form method="POST" onsubmit="return empt(this);">
	<input type="number" name="loanamt" step=".01" placeholder="Enter amount you want to take out"/>
	<input type="submit" value="Takeout Loan" name="button">
	<input type="submit" value="Repay Loan" name="button">
</form>
</html>

<?php
	if(isset($_POST["button"]))
	{
		require("config.php");
		//$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
		//$db = new PDO($conn_string, $username, $password);
			
		$idnum=$_SESSION['id'];
		if($_POST["button"]=="Takeout Loan")
		{//takeout loan, require loanamt
		
			if(isset($_POST["loanamt"))
			{
				//add money to loan session AND db, add to loanamt AND db
				$_SESSION['loanmoney']+=$_POST["loanamt"];
				$_SESSION['loanamt']+=$_POST["loanamt"];
				//update db
		
	//$stmt = $db->prepare("UPDATE `ProjUsers` SET `loan` =:loan `loanamt`=:loanamt WHERE ID =:id");
		//$result = $smt->execute(
		//array(":loan"=>$_SESSION['loanmoney'],
		//	":loanamt"=>$SESSION['loanamt'],
		//	":id"=>$idnum
		//	)
		//);
			
		}
		
			else
			{
				echo "Please input an amount";
			}

		}
		else
		{ //repay loan, require loanamt
			//subtract loanamt from savings and update to database, set loanamt 0 and update db
			
		}
	}


?>
