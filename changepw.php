<?php
session_start();
include 'db_conn.php';
?>
  <?php
  $user=$_SESSION["user_name"];
  $sql="select * from users where user_name='$user'";
  $result= mysqli_query($conn,$sql);
   while($data=mysqli_fetch_assoc($result)){
   $password=$data["password"];
   }

  ?>
<html>
 <head>
	
	<link rel="stylesheet" type="text/css" href="changepw.css">
 </head>
 <body>

 </table>
  <?php include 'dashboard.php'; ?>
	<form action="changepw.php" method="post" onsubmit="return myfunction()">
		<h2><center>CHANGE PASSWORD</center></h2>
		
		<label>Current password</label>
		<input type="password" name="cpass" placeholder="Enter your current password"><br>
		
		<label>New Password</label>
		<input type="password" name="npass" id="Uname" placeholder="Enter your new password" >
		<span id="message" style="color:red"></span><br>
		<label>Re-enter new Password</label>
		<input type="password" name="rnpass" placeholder="Re-enter your new password" ><br>
		<button type="submit" name="apply">Save Changes</button>
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
		$cpass=$_POST['cpass'];
		$npass=$_POST['npass'];
		$rnpass=$_POST['rnpass'];
		  $user=$_SESSION["user_name"];
	   if(empty($cpass))
	   {
		   echo ("<script>
					window.alert('Please Enter your Current Password');
					window.location.href='changepw.php';
					</script>");
	   }
	  else if(empty($npass))
	  {
		  echo ("<script>
					window.alert('Enter Your New Password');
					window.location.href='changepw.php';
					</script>");
	  }
	  else if(empty($rnpass))
	  {
		  echo ("<script>
					window.alert('Please Re-enter your password');
					window.location.href='changepw.php';
					</script>");
	  }
	  
		if($cpass==$password)
		{
			
			if($npass==$rnpass)
			{
				if($npass==$cpass)
				{
					echo ("<script>
					window.alert('New password and Old password cannot be same ');
					window.location.href='changepw.php';
					</script>");
				}
				else{
					$sql_pw="update users set password='$npass' where user_name='$user'";
					$result=mysqli_query($conn,$sql_pw);
					
					if($result>0)
					{
					echo ("<script>
					window.alert('Password is Changed  Successfully');
					window.location.href='homepage.php';
					</script>");
					}
					else{
						echo ("<script>
					window.alert('failed to change password');
					window.location.href='changepw.php';
					</script>");
					}
				
				}
			}
			else{
				echo ("<script>
					window.alert('New Password and re-entered password doesnot match!!');
					window.location.href='changepw.php';
					</script>");
			}
		}
		else{
			echo ("<script>
					window.alert('Current Password is incorrect');
					window.location.href='changepw.php';
					</script>");
		}
	}
	

?>