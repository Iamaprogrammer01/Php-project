<?php
	include 'db_conn.php';
	
?>
<html>  
<head>
<script>
function myfunction()
	{
		if(email== null)
		{
			alert("Fill the field");
			return false;
		}
	}
</script>
<link rel="stylesheet" type="text/css" href="css/style.css">   
<link href="css/main.css" rel="stylesheet">
<link href="css/search.css" rel="stylesheet">
</head>
 
	  <table>
	  <div class="login">
        <form method="Post" onsubmit="return myfunction()">
		 <div>
        <h4 align="center">Recover your Account</h4><br>
		<p> Please Fill Email Id Properly</p>
		</div>
            <div>
              <label>Email Address</label><br>
              <input type="email" name="email" placeholder="Enter Your Email" >
            </div>
			  <div>
			  <br><br>
          <button class="btnsubmit" type="submit" name="submit">Submit</button>
		 <button class="backbutton" type="submit" name="back">Back</button>
		  </div>
        </form>
		</div>
</div>
</html>

<?php
	
	if(isset($_POST['submit']))
	{
		$email=$_POST['email'];
		$sql="select email from users where email='$email'";
		$result=mysqli_query($conn,$sql);
		if(empty($email))
		{
			echo ("<script>
					window.alert('Please insert your Email!!!');
					window.location.href='recover_email.php';
					</script>");
		}
		if($result->num_rows ==1)
		{
			$otp=rand(10000,99999);
			session_start();
			session_regenerate_id();
			$_SESSION['otp']= $otp;
			$_SESSION['email']=$email;
			echo ("<script>
					window.location.href='newpassword.php';
					</script>");
			
		}
		else
		{
			echo ("<script>
					window.alert('Email not found');
					window.location.href='recover_email.php';
					</script>");
		}
	}
	if(isset($_POST['back']))
	{
		echo ("<script>
					
					window.location.href='index.php';
					</script>");
	}
?>
