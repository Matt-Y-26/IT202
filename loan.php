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
<a href="landingpg.php">Back to dashboard</a>
</html>

<?php
	$owe=$_SESSION['loanamt'];
	$owe=$owe+($owe *.05);
	echo "You owe: " . $owe;
	if(isset($_POST["button"]))
	{
		require("config.php");
		$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
		$db = new PDO($conn_string, $username, $password);
			
		$idnum=$_SESSION['id'];
		if($_POST["button"]=="Takeout Loan")
		{//takeout loan, require loanamt
		
			if(isset($_POST["loanamt"]))
			{
				//add money to loan session AND db, add to loanamt AND db
				$_SESSION['loanmoney']+=$_POST["loanamt"];
				$_SESSION['loanamt']+=$_POST["loanamt"];
				echo "You now have " . $_SESSION["loanmoney"] . " in loan money";
				echo "<br></br>";
				echo "You now have " . $_SESSION["loanamt"] . " in loan debt/taken";
				//update db
		
	$stmt = $db->prepare("UPDATE `ProjUsers` SET `loanmoney` =:loanmoney WHERE ID =:id");
		$result = $stmt->execute(
		array(":loanmoney"=>$_SESSION['loanmoney'],
			":id"=>$idnum
			)
		);
		     $stmt = $db->prepare("UPDATE `ProjUsers` SET `loanamt`=:loanamt WHERE ID =:id");
                $result = $stmt->execute(
                array( ":loanamt"=>$_SESSION['loanamt'],
                        ":id"=>$idnum
                        )
                );
			
		}
			else
			{
				echo "Please input an amount";
			}

		}
		else
		{ //repay loan, require loanamt
			//subtract loanamt from savings and update to database, set loanamt 0 and update db
			
			if($_SESSION['money']>$owe);
			{
				$_SESSION['money']-=$owe;
				$owe=0;
				$_SESSION['loanamt']=0;
		$stmt = $db->prepare("UPDATE `ProjUsers` SET `loanamt`=:loanamt WHERE ID =:id");
                $result = $stmt->execute(
                array( ":loanamt"=>$_SESSION['loanamt'],
                        ":id"=>$idnum
                        )
                );
  		$stmt = $db->prepare("UPDATE `ProjUsers` SET `money`=:money WHERE ID =:id");
                $result = $stmt->execute(
                array( ":money"=>$_SESSION['money'],
                        ":id"=>$idnum
                        )
                );
			echo "You have successfully paid off your loans";				
			}
			else
			{
				echo "You don't have enough in your savings to pay the loan off";
			}
		}
	}
?>
