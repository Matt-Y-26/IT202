<?php
 //frag ip headers cause packet can hold more data than a frame
 //ipv4 offset 0 and mf =1 
 //difference frag in ipv4 and ipv6, ipv6 packets only frag at source ipv4 can frag at source or router
 //ipv6 frag info is in extenstion
 //ARP give ip -> mac
 //DHCP auto assigns ips for a lim amt of time
 //NAT permits many hosts share few pub IP trans pub and pri ip
 //ICMP error detection and network mangement
 session_start();
?>

<html>
<head>
<script>
function empty(form){
	//check if values are empty and if the SESSION money > give money
	var amt = form.amt.value;
	//var sess_amt = $_SESSION['money'];		
	var id = form.id.value;
	if(amt=="")
	{
		alert("Please fill in amount");
		return false;
	}
	else if (amt<=0)
	{
		alert("Invalid amount");
		return false;
	}
	/*   DO SERVER END
	else if(amt>sess_amt)
	{
		alert("You do not have enough money to give");
		return false;
	}
	*/
	if(id=="")
	{
		alert("ID is empty please input a valid ID");
		return false;
	}
	var checkbox= document.getElementById("mycheck");
	if(checkbox.checked==false)
	{
		alert("You did not check the checkbox");
		return false;
	}

	return true;	
}
</script>
<div style="margin-left: 35%; margin-right: 35%;">
<article>
<h1>Give money to other users</h1>
<p>Keep in mind you can only give what you have from your main account</p>
<p>Also, you need to know the id of the other account you wish to transfer to</p>
<br></br>
</article>

<a href="landingpg.php">Back to dashboard</a>

<form method="POST" onsubmit="return empty(this);">
	<input type="number" name="amt" step=".01" placeholder="Enter amount to give"/>
	<br></br>
	<input type="number" name="id" step="1" placeholder="Enter ID of recipient"/>
	<br></br><input type="checkbox" id="mycheck">
	<br></br>
        Selecting yes, I confirm that the information above is correct 
	<br></br>
	<input type="submit" value="Submit"/>
</form>
</body>
</html>

<?php
	//do transfer here
	//check if sub from data and 
	echo "flag";
	echo $_POST['amt'];
?>
