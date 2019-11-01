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
			echo '<a href="https://web.njit.edu/~my286/IT202/project/login.html">Click here to go back</a>';
			echo "<br>";
			
			
			require('config.php');
			//echo"gets here before conn string";
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			try {
				$db = new PDO($conn_string, $username, $password);
			
				
				$select_query = "SELECT `Username` FROM `ProjUsr_Passwd` WHERE 1";
				//echo $select_query;
				$stmt = $db->prepare($select_query);
				$r = $stmt->execute(array());
				$results = $stmt->fetch(PDO::FETCH_ASSOC);
				$getdbuser = $results['Username'];
				//echo $getdbuser; //delete this later
				if($user == $getdbuser)
				{
					//it matches
					//in the future hold the position of this
					//do new select query
					$select_query = "SELECT `Password` FROM `ProjUsr_Passwd` WHERE 1";
					$stmt = $db->prepare($select_query);
					$r = $stmt->execute(array());
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					$getdbpass = $results['Password'];
					//echo "before dbpass";
					//echo $getdbpass; //eh delete this later
					if($pass == $getdbpass)
					{
						//password matches youre good
						echo "Success! You have logged in as: " . $user . "<br>";
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
			echo '<a href="https://web.njit.edu/~my286/IT202/project/login.html">Click here to go back</a>';
		}
	}
	else
	{
		//no username was given
		echo "No username given <br>";
                echo '<a href="https://web.njit.edu/~my286/IT202/project/login.html">Click here to go back</a>';

	}
	//$user = $_POST['username'];
	//$pass = $_POST['password'];
?>
