<?php
session_start();
if(!isset($_SESSION["user_name"])){
	header("Location:dashboard.php");
}
include 'db_conn.php';
if(isset($_GET["update_id"]) && $_GET["update_id"]>0){
		$id=$_GET["update_id"];
		$sql="select * from product where Id='$id'";
		$res=mysqli_query($conn,$sql);
		$product="";
		$date="";
		
		while($data=mysqli_fetch_assoc($res)){
			$id=$data["Id"];
			$product=$data["Product"];
			$date=$data["Date"];
		}
	}
?>
<html>  
  <head>
    <link rel="stylesheet" href="addbrand.css">
</head>
  
<body>
<?php include 'dashboard.php'; ?>
<style>
form{
	background-color:#61B9CA;
}
label{
	color:black;
}
input[type=text], textarea {
	color:black;
	width:70%;
}
input[type=submit] {
  background-color: #3A6880;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right:80px;
}

input[type=submit]:hover {
  background-color: #45a049;
}
.container {
  border-radius: 5px;
  padding: 20px;
}
button{
	width:20%;
	margin-left:53%;
	margin-top:-10.8%;
	background-color: #3A6880;
	color: white;
	cursor:pointer;
	height:5.3%;
	font-size:16px;
	 border-radius: 4px;
}
#backbtnprdct{
	text-decoration:none;
}
</style>
<div class="container"> 
 <form id="form" method="Post" action="addproduct.php">
 
        <div class="form-control">
            <label>
                Date
            </label>
			  <input type="hidden" name="Id" value="<?php echo $id;?>">
              <input type="text" name="date" value="<?php echo $date ?>" readonly />
        </div>
  
        <div class="form-control">
            <label>
                Product Name
            </label>
			 <input type="hidden" name="Id" value="<?php echo $id;?>">
             <input type="text" name="name" value="<?php echo $product ?>" placeholder="Enter Product Name" required>
        </div>
		<input type="submit" name="updateproduct" value="Update Product">
		<button class="backbtnprdct"><a href="addproduct.php">Back</a></button>
    </form>
	</div>
</body>
  
</html>