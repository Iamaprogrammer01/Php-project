<?php
	include 'db_conn.php';
?>
<html>
<head>
	<script type="text/javascript" src="jquery-3.6.0.min.js">
	</script>
	<body>
	<div>
		<form method="post" name="newadmin">
		<h2><center>New Admin</center></h2>
	
		<label>Enter Full Name</label>
		<input type="text" name="fname" placeholder="Enter your Full name" ><br>
		
		<label>Enter Username</label>
		<input type="text" name="uname" placeholder="Enter Username" ><br>
		<label>New Password</label>
		<input type="password" name="upass" placeholder="Enter your password" ><br>
		<label>Re-enter Password</label>
		<input type="password" name="rnpass" placeholder="Re-enter your password" ><br>
		<button class="backbutton"><a href="dashboard.html">Back</a></button>	
		<button type="submit" name="apply">Save</button>
	</form>
	</div>
	</body>
</html>
<?php
	if(isset($_POST['apply']))
	{
		$fname=$_POST['fname'];
		$uname=$_POST['uname'];
		$pass=$_POST['upass'];
		$rnpass=$_POST['rnpass'];
			
			if($pass==$rnpass)
			{
				$sql="insert into users(user_name,password,Fullname)values('$uname','$pass','$fname')";
				$result= mysqli_query($conn,$sql);
					if($result>0)
					{
					echo ("<script>
					window.alert('Admin added Successfully.');
					window.location.href='dashboard.html';
					</script>");
					}
		
	}
		else
		{
			echo ("<script>
					window.alert('Password and Confirm password doesnot match.');
					window.location.href='newadmin.php';
					</script>");
		}
}

?>