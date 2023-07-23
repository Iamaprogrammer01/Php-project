<?php
	include 'db_conn.php';
	
 

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">   
	<link href="css/main.css" rel="stylesheet">
	<link href="css/search.css" rel="stylesheet">
</head>
<body>
		
		<div class="login">  
        <form method="post" action="newpassword.php" onsubmit="return myfunction()">  
		<label><b><center>FILL UP THE FORM</b></center></label><br><br>
		<label><b>Enter Password  </b>   
        <br>    
        </label>
		<div>		
        <input type="password" required name="npass" id="Uname" placeholder="Enter new password"> 
		<span id="message" style="color:red"></span>
		</div>
        <br>  
        <label><b> Re-enter password </b>    
        <br>    
        </label>    
        <input type="Password" required name="rnpass" id="Pass" placeholder="Re-enter new password">  
				
        <br><br>    
        <button type="submit" name="apply" id="log" value="apply"> Apply</button>  
        <button class="backbutton"><a href="index.php">Back</a></button>	
        <br><br>  
			</div>
			</form>
			<script type="text/javascript">
	
	function myfunction()
	{
		var a = document.getElementById("Uname").value;
		
		if(a.length<8)
		{
			document.getElementById("message").innerHTML="..Password should be more than 8 digits";
			return false;
		}
	}
	</script>
	</body>
	</html>
<?php

if(isset($_POST['apply']))
{
	$npass=$_POST['npass'];
	$rnpass=$_POST['rnpass'];
	if($npass==$rnpass)
	{
		echo"hello";
		session_start();
	    $email=$_SESSION["email"];
		$sql="update users set password='$npass' where email='$email'";
		mysqli_query($conn,$sql);
		echo ("<script>
					window.alert('Password is reset successfully.');
					window.location.href='index.php';
					</script>");
	}
	else
	{
		echo ("<script>
					window.alert('New password and Reentered password doesnot match.');
					window.location.href='newpassword.php';
					</script>");
	}
}

?>
