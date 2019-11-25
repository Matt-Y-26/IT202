<?php
session_start();
?>
<html>
<head>
</head>
<body>
Hello, <?php echo $_SESSION['user'];?>
<br></br>
<a href="addsub.php">Add or take out money</a>
<br></br>
<a href="calc.php">Monthly interest calculator for savings</a>
<br></br>
Your id is <?php echo $_SESSION['id'];?>
<br></br>
You have <?php echo $_SESSION['money'];?> dollars
</body>
</html>
