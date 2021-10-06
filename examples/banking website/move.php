<?php
session_start();
?>

<html>
<head>
<script>
	function empty(form){
		var amt = form.amount.value;
		if(amt=="")
		{	
			alert("Amount is empty");
			return false;
		}		
		else if(amt<=0)
		{
			alert("Please input a positive number");
			return false;
		}
		return true;
		}
</script
</head>

<body>

<div style="margin-left: 35%; margin-right:35%;">
<article>
<h2>Move money from checkings to savings </h2>
<br></br>
<form method="POST" onsubmit="return empty(this);">
	<input type="number" name="amount" step=".01" placeholder="Enter amount you want to transfer"/>
	<br></br>
	Move to:
	<select name="option">
		<option value="tocheck">checkings</option>
		<option value="tosaving">savings</option>
	</select>
	<br></br>
	<input type="submit" value="Submit"/>
</form>
<a href="landingpg.php">Back to dashboard</a>
<br></br>
</body>
</html>

<?php
	$sav = $_SESSION['money'];
	$che = $_SESSION['loanmoney'];
	$opt = $_POST['option'];
	$amt = $_POST['amount'];
	echo "You have " . $sav . " in savings";
	echo " <br> ";
	echo "You have " . $che . " in checkings <br>";	
	//echo $opt;
	if($sav !=0)
	{
		
		if($opt=="tocheck")
		{
			//add amt+che sav-amt, UDPATE loanmoney and money with che and sav then session
			
			if($amt>$sav)
			{
				echo "Not enough money in savings!";
			}
			else
			{
			//echo"hello";
			$che+=$amt;
			$sav-=$amt;
			$_SESSION['loanmoney']=$che;
			$_SESSION['money']=$sav;
			$idnum=$_SESSION['id'];
			require("config.php");
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
		$stmt = $db->prepare("UPDATE `ProjUsers` SET `money` =:sav WHERE ID = :id");
			$result = $stmt->execute(
				array(":sav"=>$sav,
					":id"=>$idnum
				)
			);
	  $stmt = $db->prepare("UPDATE `ProjUsers` SET `loanmoney` =:che WHERE ID = :id");
                        $result = $stmt->execute(
                                array(":che"=>$che,
                                        ":id"=>$idnum
                                )
                        );

			echo "SUCCESS";
			echo "<br> Checkings is now " . $che . " and savings is now " . $sav . "";;
			//$idnum=$_SESSION['id'];
//			require("config.php");
//			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
//			$db = new PDO($conn_string, $username, $password);
//			$stmt = $db->prepare("UPDATE `ProjUsers` SET `money` = :curmon WHERE ID = :id");
//			$result = $stmt->execute(
//				array(":curmon"=>$curmon,
//					":id"=>$idnum
//				)
//			);
			}
		}
		else if($opt=="tosaving")
		{
			if($amt>$che)
                        {
                                echo "Not enough money in checkings!";
                        }
                        else
                        {
                        //echo"hello";
                        $che-=$amt;
                        $sav+=$amt;
                        $_SESSION['loanmoney']=$che;
                        $_SESSION['money']=$sav;
                        $idnum=$_SESSION['id'];
                        require("config.php");
                        $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
                        $db = new PDO($conn_string, $username, $password);
                $stmt = $db->prepare("UPDATE `ProjUsers` SET `money` =:sav WHERE ID = :id");
                        $result = $stmt->execute(
                                array(":sav"=>$sav,
                                        ":id"=>$idnum
                                )
                        );
			 $stmt = $db->prepare("UPDATE `ProjUsers` SET `loanmoney` =:che WHERE ID = :id");
                        $result = $stmt->execute(
                                array(":che"=>$che,
                                        ":id"=>$idnum
                                )
                        );

                        echo "SUCCESS";
                        echo "<br> Checkings is now " . $che . " and savings is now " . $sav . "";
		}

		}
		else
		{
			echo "Error";
		}
	
	}
	else
	{
	}
?>
