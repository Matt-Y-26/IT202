<?php
session_start();
?>
<html>
<head>
</head>
<body>
Hello, <?php echo $_SESSION['user'];?>
<br></br>
Your id is <?php echo $_SESSION['id'];?>
<br></br>
You have <?php echo $_SESSION['money'];?> dollars
</body>
</html>
