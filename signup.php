<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="stylea.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	.backbutton{
		background: linear-gradient(-135deg, #71b7e6, #9b59b6);
		width:60%;
		height:80%;
		margin-left:20%;
		font-size: 18px;
		border-radius:20px;
		text-color:white;
		border:none;
		cursor:pointer;
	}
	</style>
	</head>
	
	<body>
	
		<div class="container">
		<div class="title">Registration</div>
		<form class="form" method="post"  enctype="multipart/form-data" onsubmit="return myfunction()">
		<div class="user-details">
		<div class="input-box">
			<span class="details">Full Name</span>
			<input type="text" id="name" name="name" Placeholder="Enter your name"	onkeyup="fullname(this)">
			<span id="messagea" style="color:red"></span>
		</div>
		<div class="input-box">
			<span class="details">Username</span>
			<input type="text" id="uname" name="uname" Placeholder="Enter your username" onkeyup="characteronly(this)" >
			
		</div>
		<div class="input-box">
			<span class="details">Email</span>
			<input type="email" id="email" name="email" Placeholder="Enter your email" >
		</div>
		<div class="input-box">
			<span class="details">Phone Number</span>
			<input type="text" id="phone" name="phone" Placeholder="Enter your number" onkeyup ="numberonly(this)" >
			<span id="messages" style="color:red"></span>
		</div>
		<div class="input-box">
			<span class="details">Password</span>
			<input type="text" id="pass" name="pass" Placeholder="Enter your password"  >
			<span id="message" style="color:red"></span>
		</div>
		<div class="input-box">
			<span class="details">Confirm Password</span>
			<input type="text" id="cpass" name="cpass" Placeholder="Confirm your password"  >
		</div>
		
		</div>
		<div class="gender-details">
			<input type="radio" name="gender" value="Male" id="dot-1">
			<input type="radio" name="gender" value="Female" id="dot-2">
			<span class="gender-title">Gender</span>
			<div class="category">
			 <label for="dot-1">
				<span class="dot one"></span>
				<span class="gender">Male</span>
			</label>
			<label for="dot-2">
				<span class="dot two"></span>
				<span class="gender">Female</span>
			</label>
		</div>
		</div>
	<div class="img">
      <span class="deta">Choose Image</span>
	  <input type="file" name="img">
	</div>
		<div class="button">
		<input type="submit" name="submit" value="Register">
		</div>
		<p>
            Already having an account?
            <a href="index.php">
                Login Here!
            </a>
        </p>
		
		</div>
		
		</div>
	
		</form>
		</div>
	<script type="text/javascript">
	function fullname(input)
	{
		var name=/[^a-zA-Z\s(-)]/gi;
		
		input.value=input.value.replace(name,"");
		
		
	}
	function characteronly(input)
	{
		var cha= /[^a-z]/gi;
		input.value=input.value.replace(cha,"");
	}
	function numberonly(input)
	{
		var num = /[^0-9]/gi;
		input.value = input.value.replace(num,"");
	}
	
	
	function myfunction()
	{
		var a = document.getElementById("phone").value;
		var b=document.getElementById("pass").value;
		if(a.length<10)
		{
			document.getElementById("messages").innerHTML="..mobile number must be 10 digits";
			return false;
		}
		else if(a.length>10)
		{
			document.getElementById("messages").innerHTML="..mobile number must be 10 digits";
			return false;
		}
		if(a.charAt(0)!=9)
		{
			document.getElementById("messages").innerHTML="..mobile number must be start with 9";
			return false;
		}
		if(b.length<8)
		{
			document.getElementById("message").innerHTML="..Password should be more than 8 digits";
			return false;
		}
	}
</script>
	</body>
	</html>
	<?php
	include 'db_conn.php';
	if(isset($_POST['submit']))
	{
		$success=0;
		$name=$_POST["name"];
		$uname=$_POST["uname"];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$pass=$_POST["pass"];
		$cpass=$_POST["cpass"];
		$gender=$_POST["gender"];
		$files=$_FILES['img'];
		
		$filename=$files['name'];
		$fileerror=$files['error'];
		$filetmp=$files['tmp_name'];
		
		$fileext=explode('.',$filename);
		$filecheck=strtolower(end($fileext));
		
		$fileextstored= array('png','jpg','jpeg');
		
		if(empty($name))
		{
			echo ("<script>
					window.alert('Please enter name!!!');
					window.location.href='signup.php';
					</script>");
		}
		else if(empty($uname))
		{
			echo ("<script>
					window.alert('Please enter username!!!');
					window.location.href='signup.php';
					</script>");
		}
		else if(empty($email))
		{
			echo ("<script>
					window.alert('Please Enter email!!!');
					window.location.href='signup.php';
					</script>");
		}
		else if(empty($phone))
		{
			echo ("<script>
					window.alert('Please Enter mobile Number!!!');
					window.location.href='signup.php';
					</script>");
		}
		else if(empty($pass))
		{
			echo ("<script>
					window.alert('Please Enter Your Password!!!');
					window.location.href='signup.php';
					</script>");
		}
		else if(empty($cpass))
		{
			echo ("<script>
					window.alert('Please Enter Your Password Again!!!');
					window.location.href='signup.php';
					</script>");
		}
		else if(empty($gender))
		{
			echo ("<script>
					window.alert('Please Choose Gender!!!');
					window.location.href='signup.php';
					</script>");
		}
		else if($pass!=$cpass)
		
		{
				
					echo ("<script>
					window.alert('Your password and conform passsword doesnot match!!!');
					window.location.href='signup.php';
					</script>");
				
		}
	
		$query = "Select * from users";
		$result1 = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result1)){
			$success=1;
			 if($row['user_name']==$uname){
                    $success=0;
					echo("<script>
					window.alert('Username Already Exist!!!');
					window.location.href='signup.php';
					</script>");
					
				}
				
				elseif($row['email']==$email)
				{
					$success=0;
					echo ("<script>
					window.alert('This Email is already Exist!!!');
					window.location.href='signup.php';
					</script>");
					
				}
				elseif($row['Phone_no']==$phone)
				{
					$success=0;
					echo ("<script>
					window.alert('This mobile no is already Exist!!!');
					window.location.href='signup.php';
					</script>");
					
				}
				else{
					$success=1;
				}
				}
			
				if($success=1){
								
							if(in_array($filecheck,$fileextstored))
							{
							$destinationfile="images/".$filename;
							
							}
							$sql_signup= "INSERT INTO users (user_name, password,name,email,Phone_no,Gender,image) VALUES ('$uname','$pass','$name','$email','$phone','$gender','$destinationfile')";
							$result= mysqli_query($conn,$sql_signup);
							
				}
						
		if($result>0){
		move_uploaded_file($filetmp,$destinationfile);			
		echo ("<script>
					window.alert('New User is added successfully');
					window.location.href='index.php';
					</script>");
		}
				
		else{
			echo ("<script>
					window.alert('Failed to create new user');
					window.location.href='index.php';
					</script>");
			
		}
	}
	

?>