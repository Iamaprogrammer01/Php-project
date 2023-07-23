<?php
session_start();
if(!isset($_SESSION["user_name"])){
	header("Location:dashboard.php");
}
include 'db_conn.php';
if(isset($_GET["update_id"]) && $_GET["update_id"]>0){
		$id=$_GET["update_id"];
		$sql="select * from brand where id='$id'";
		$res=mysqli_query($conn,$sql);
		$date="";
		$product="";
		$brand="";
		while($data=mysqli_fetch_assoc($res)){
			$id=$data["Id"];
			$product=$data["Product"];
			$date=$data["Date"];
			$brand=$data["brand"];
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
select{
		color:black;
		width:250px;
}
	option{
		color:black;
	}

</style>
<div class="container"> 
 <form method="Post" id="form" action="addbrand.php">
 
        <div class="form-control">
            <label for="date" id="label-name">
                Date
            </label>
			<input type="text" name="date" value="<?php echo $date ?>" readonly />
			   <input type="hidden" name="id" value="<?php echo $id;?>">
          
        </div>
  
        <div class="form-control">
            <label for="pname" id="label-email">
                Product Name
            </label>
		<?php
			$query= "SELECT * FROM product ORDER BY Product ASC";
			$result=$conn->query($query);
			?>
             <Select class="select" name="product">
				<option value="">Select Product</option>
	  <?php
						if($result->num_rows >0){
							while($row=$result->fetch_assoc()){
								echo"<option value=$row[Product]> $row[Product]</option>";
							}
						}else{
							echo '<option value="">Product not available<?option>';
						}
					?>
	  </select>
        </div>
		<div class="form-control">
            <label for="date" id="label-name">
                Brand
            </label>
			<input type="text" name="name" value="<?php echo $brand ?>" required>
			<input type="hidden" name="id" value="<?php echo $id;?>">
          
        </div>
		<input type="submit" name="updatebrand" value="Update Brand">
    </form>
	</div>
</body>
  
</html>