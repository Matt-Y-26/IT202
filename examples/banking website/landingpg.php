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
<!-- <a href="give.php">Give money to another user</a> -->
Your id is <?php echo $_SESSION['id'];?>
<br></br>
You have <?php echo $_SESSION['money'];?> dollars
<br></br>
You have <?php echo $_SESSION['loanmoney'];?> in loan
<br> </br>
<a href="move.php">Move money around your savings and checkings</a>
<br></br>
<a href="loan.php">Manage loan</a>
<br></br><br></br>
<a href="change.php">Change account details</a>

</body>
</html>
