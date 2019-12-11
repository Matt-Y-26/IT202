<?php
session_start();
?>

<html>
<head>
</head>
<body>

<div style="margin-left: 35%; margin-right:35%;">
<p> Please login with your username and password </p>

<form method="POST">
	<input type="text" name="username" placeholder="Enter username"/>
	<input type="password" name="password" placeholder="Enter password"/>
	<!-- <input type="password" name="confirm" placeholder="Confirm password"/> -->
	
	<input type="submit" value="Login"/>
</form>
</body>
</html>
<?php
	
	 $user = $_POST["username"];
         $pass = $_POST['password'];
	
	//just some tests above
	if($user != ""){
		//good
		if( $pass != "")
		{
			
			//echo "Works";
			//echo "<br>";
			echo '<a href="https://web.njit.edu/~my286/IT202/register.php">Click here to go to register</a>';
			echo "<br>";
			
			
			require('config.php');
			//echo"gets here before conn string";
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			try {
				$db = new PDO($conn_string, $username, $password);
			
				//echo 'hello';
				$select_query = "SELECT `username` FROM `ProjUsers` WHERE username =:username LIMIT 1";
				//echo 'helO?';
				//echo $select_query;
				$stmt = $db->prepare($select_query);
				$r = $stmt->execute(array(":username"=>$user));
				$results = $stmt->fetch(PDO::FETCH_ASSOC);
				$getdbuser = $results['username'];
				//echo $getdbuser; //delete this later
				//echo $getdbuser;
				//echo "hello?";
				if($user == $getdbuser)
				{
					//it matches
					//in the future hold the position of this
					//do new select query
					$select_query = "SELECT `password` FROM `ProjUsers` WHERE username =:username";
					$stmt = $db->prepare($select_query);
					$r = $stmt->execute(array(":username"=>$user));
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					$getdbpass = $results['password'];
					//echo "before dbpass";
					//echo $getdbpass; //eh delete this later
					$hash = password_hash($pass, PASSWORD_BCRYPT);
					//echo $hash;
					//echo $getdbpass;
					if(password_verify($pass,$getdbpass)) //took me too long but pass instead of hash
					{
						//password matches youre good
						echo "Success! You have logged in as: " . $user . "<br>";
						$_SESSION['user']=$user;
						$select_query = "SELECT `id` FROM `ProjUsers` WHERE username =:username";
                                        	$stmt = $db->prepare($select_query);
                                        	$r = $stmt->execute(array(":username"=>$user));
                                        	$results = $stmt->fetch(PDO::FETCH_ASSOC);
						$id = $results['id'];
						$_SESSION['id']=$id;
						$select_query = "SELECT `money` FROM `ProjUsers` WHERE username =:username";
                                                $stmt = $db->prepare($select_query);
                                                $r = $stmt->execute(array(":username"=>$user));
                                                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $money = $results['money'];
                                                $_SESSION['money']=$money;
						
			$select_query = "SELECT `loanmoney` FROM `ProjUsers` WHERE username =:username";
                                                $stmt = $db->prepare($select_query);
                                                $r = $stmt->execute(array(":username"=>$user));
                                                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $loanmoney = $results['loanmoney'];
                                                $_SESSION['loanmoney']=$loanmoney;
						//header("Location: landingpg.php");
			$select_query = "SELECT `loanamt` FROM `ProjUsers` WHERE username =:username";
                                                $stmt = $db->prepare($select_query);
                                                $r = $stmt->execute(array(":username"=>$user));
                                                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $loanamt = $results['loanamt'];
                                                $_SESSION['loanamt']=$loanamt;
                                                header("Location: landingpg.php");
					
					}
					else
					{
						echo "Passwords is invalid for user, please try again";
						//passwords dont match...
					}
				}
				else
				{
					echo "Username does not match any in database, please enter again";
				}
				//in the future, hold array position of username match for this its
				//not needed for this assignment but in the future you would see if the 
				//array position is matched to the password
				
				
				//echo "gets here";
			}
			catch(Exception $e){
				echo "ERROR: Failed to connect to database";
			}
		}
		else
		{	
			//password wasn't set
			echo "No password given <br>";
			echo '<a href="https://web.njit.edu/~my286/IT202/register.php">Click here to register</a>';
		}
	}
	else
	{
		//no username was given
		echo "No username given <br>";
                echo '<a href="https://web.njit.edu/~my286/IT202/register.php">Click here to register</a>';
	}
	//$user = $_POST['username'];
	//$pass = $_POST['password'];
?>
