<?php

session_start();
include 'db_conn.php';
include'dashboard.php';
 ?>
 <?php
 $user=$_SESSION["user_name"];
 $query="select * from users where user_name='$user'";
 $result=mysqli_query($conn,$query);
 while($data=mysqli_fetch_assoc($result)){
			$name=$data["name"];
			$uname=$data["user_name"];
			$email=$data["email"];
			$num=$data["Phone_no"];
			$gender=$data["Gender"];
		}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="profile.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
	
		<div class="container">
			<div class="img">
		<?php 
		 $users=$_SESSION["user_name"];
		$query1="select * from users where user_name='$users'";
		$result1=mysqli_query($conn,$query1);
		while($data1=mysqli_fetch_assoc($result1)){
		echo"
		<table align=center>
		<tr>
		
		<td>
		<img src='".$data1['image']."' height='130' width='150'/></td>
		</tr>
		</table>";
		}?>
		</div>
		<div class="title">Profile Details</div>
	
		<form class="form" method="post"  enctype="multipart/form-data" onsubmit="return myfunction()">
		
		<div class="user-details">
		
		<div class="input-box">
			<span class="details">Full Name:<input class="name"type="text" value="<?php echo $name;?>" readonly ></span>
			
		</div>
		
		<div class="input-box">
			<span class="details">Username:<input class="uname" type="text" value="<?php echo $uname;?>" readonly ></span>
			
		</div>
		<div class="input-box">
			<span class="details">Email:<input class="email" type="text" value="<?php echo $email;?>" readonly ></span>
			
		</div>
		<div class="input-box">
			<span class="details">Phone No:<input type="text" value="<?php echo $num;?>" readonly ></span>
			
		</div>
		<div class="input-box">
			<span class="details">Gender:<input class="gender"type="text" value="<?php echo $gender;?>" readonly ></span>
			
		</div>
		
		
		</div>
		</div>
		
	
		</form>
		
	</body>
	</html>
 
 