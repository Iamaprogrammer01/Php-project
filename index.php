<?php
session_start();
if(isset($_SESSION["user_name"])){
	header("Location:dashboard.php");
}
 ?>
 <html>
 <head>
	<title>Inventory Management System</title>
	
	<link href="style.css" rel="stylesheet">
	<style>
	form {
	width: 500px;
	border: 2px solid #ccc;
	padding: 30px;
	background-image:url("Loginpage.jpg");
	border-radius:15px;
}
p{
	margin-top: -10px;
	border; 1px solid box;
	font-size:18px;
}

	</style>
 </head>

 <body>
	<form action="login.php" method="post">
		<h2>LOGIN</h2>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		
		<label>Username</label>
		<input type="text" name="uname" placeholder="User Name"><br>
		
		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>
		<p> Forgot password?<a href="recover_email.php">Click here</a></p>
		<button type="submit">Login</button>
		<p></p>
		<p><br></p>
		 <p> Don't have an account??<a href="signup.php">SignUp </a>Here</p>
	</form>
 </body>
 </html>