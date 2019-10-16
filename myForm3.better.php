<html>
<head>
<script>
function myValidation(inputEle, inputName){
	if(inputName.length>0){
		let other = document.forms[0][inputName];
		let v1 = inputEle.value;
		let v2 = other.value;
		if(v1 == null && v1.length == 0){
			//do error empty
		}
		if(v2 == null && v2.length == 0){
			//do error empty
		}
		if(v1 != v2){
			//do error
			console.log("Value 1 and val 2 dont match");
		}
		if(inputEle.type == "email" && v1.indexOf('@')== -1)
		{
	
		}
		if(other.type == "email" && v2.indexOf('@') == -1){
			//do error email confirm not valid email
		}
	}
	else{
		let v = inputEle.value;
		if(v == null || v.length == 0){

		}
		if(inputEle.type == "email" && v.indexOf('@')){
		
		}
	}
}
</script>
</head>

<body>
<form onsubmit="return false;">
	<input type ="email" name="email" placeholder="Email" onchange="myValidation(this, '');">
	<input type ="email name="confirmemail" placeholder="Confirm Email" 
onchange="myValidation(this,'email');">
	<input type ="password" name="password" onchange="myValidation(this, '');">
	<input type ="password" name="confirmpassword" onchange="myValidation(this,'password');">
	<input type ="text" name="username" placeholder="Username" onchange="myValidation(this, '');">
	<input type="submit" value="try it">
	</form
	</body>
</html>


