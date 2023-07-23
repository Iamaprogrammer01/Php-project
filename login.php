<?php
include 'db_conn.php';
if (isset($_POST['uname']) && isset($_POST['password'])) {
	
	function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	
	if (empty($uname)){
		header("Location: index.php?error=Username is Required");
		exit();
	}else if(empty($pass)){
		header("Location: index.php?error=Password is Required");
		exit();
	}
	
	else{
		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
		
		$result =mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_assoc($result)) {
					session_start();
		$_SESSION["user_name"]=$uname;
		header("location:homepage.php");
			}
		}
		else{
			header("Location: index.php?error=Incorect Username or Password ");
		}
}

}else{
	header("Location: index.php");
	exit();
}
?>