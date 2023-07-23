<?php
	include 'db_conn.php';
?>
<html>
<head>

</head>
	<script type="text/javascript" src="jquery-3.6.0.min.js">
	</script>
	<body>
	<div>
		<table align="center">
			<form method="post" name="forgot_password"  >
			<tr>
				<td>Enter User Name:</td>
				<td> <input type="text" id="uname" name="uname"> </td>
			</tr>
			<tr>
				<td>Enter New Password</td>
				<td> <input type="text" id="npass" name="npass"> </td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" name="submit">Save</td>
				<td><button class="backbutton"><a href="dashboard.html">Back</a></button></td>
			</tr>
			</form>
		</table>
	</div>
</body>
</html>
<?php
$sql="SELECT * FROM users";
	$result=mysqli_query($conn,$sql);
	
		while($results=mysqli_fetch_assoc($result))
		{
			
			$user=$results['user_name'];
		}
	
if(isset($_POST['submit']))
{
	$uname=$_POST['uname'];
	$pass=$_POST['npass'];
	if ($uname==$user)
	{
			$s="update users set user_name='$uname', password='$pass'";
			mysqli_query($conn,$s);
			echo ("<script>
					window.alert('New Password reset successfully!!!');
					window.location.href='index.php';
					</script>");
	}
	else
	{
		echo ("<script>
					window.alert('Username doesnot match!!!');
					window.location.href='index.php';
					</script>");
	}
}
	
?>