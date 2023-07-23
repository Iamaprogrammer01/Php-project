<?php
	include 'db_conn.php';
	
?>
<!DOCTYPE html>
<html>
  
<head>
    <link rel="stylesheet" href="addbrand.css">
</head>
  
<body>
<?php include 'dashboard.php'; ?>
<style>
label{
	color:black;
	font-weight:bold;
}
input[type=text], textarea {
	color:black;
	width:70%;
	text-align:left;
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
#select{
		 color:black;
		 width:250px;
		 
	}
	
	option{
		color:black;
	}
	body{
		background-color:#41C2C5;
	}

</style>
<div class="container"> 
 <form id="form" method="POST">
		<h3><center><u><b>ADD NEW BRAND</b></u></center></h3>
        <div class="form-control">
            <label for="date" id="label-name">
                Date
            </label>
			<input type="text" name="date" value="<?php echo date("Y-m-d"); ?>" readonly/>
          
        </div>
  
        <div class="form-control">
            <label for="pname" id="label-email">
                Product Name
            </label>
		<?php
		
			$query= "SELECT * FROM product ORDER BY Product ASC";
			$result=$conn->query($query);
			?>
             <Select id="select" name="product" required>
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
			<input type="text" name="name" placeholder="Enter Brand Name" onkeyup="characteronly(this)"required>
          
        </div>
		<input type="submit" name="submit" value="Add brand">
    </form>
	</div>
</body>
  
</html>
<?php
	
	if(isset($_POST['submit']))
	{
		$date=$_POST["date"];
		$name=$_POST["name"];
		$product=$_POST["product"];
		$s=0;
		/*if(empty($product))
		{
			echo ("<script>
					window.alert('Please Select Product!!!');
					window.location.href='addbrand.php';
					</script>");
				$s=1;
		}
		*/
		$query = "Select * from brand where Product='$product' and brand='$name'";
		$result1 = mysqli_query($conn, $query);
		$checkrows=mysqli_num_rows($result1);
			if($checkrows){
				
                   
					echo("<script>
					window.alert('This brand already exist!!!');
					window.location.href='addbrand.php';
					</script>");
					
				}
				else
				{
					$sql="insert into brand (Date,Product,brand) VALUES ('$date','$product','$name')";	
						$result=mysqli_query($conn,$sql)or die (mysqli_error($conn));
					echo("<script>
					window.alert('Brand Added Successfully!!!');
					window.location.href='addbrand.php';
					</script>");
				}
	}
?>
	<?php


$sql="SELECT * from brand";
if(isset($_GET["search"])){
	$searchKey=$_GET['searchKey'];
	$sql="select * from brand where brand Like '%$searchKey%'";
}
$result=mysqli_query($conn,$sql);

?>
<html>
<body>
<style>
.search{
	 background-color:white;
     max-width: 400px;
	 margin-left:60%;
     margin-top:-300px;
     padding: 30px 20px;
     box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
     color:black;
	 height:-3%;
}

table{
	margin:-8.1%;
	margin-top:-20.8%;
	width:50%;
	background-color:teal;
}
input[type=text], textarea {
	color:black;
	width:70%;
	height:30px;
}
.contain {
  border-radius: 5px;
  padding: 20px;
  float:right;
  margin-top:-27%;
   margin-right:20%;
   height: -30px;
   
 
}
.pview{
	margin-top:2%;
		margin-right:-20%;
		width:90%;
}
.searchbutton{
	width:80px;
	margin-top:1.2%;
	background-color:#3C7DB4;
	float:right;
	border:3px solid black;
	font-weight:bold;
}
.form-inline{
	background-color:#41C2C5;
	margin-top:2%;
	height:4%;
}
.label{
	margin-top:10%;
	font-weight:bold;
}
.text{
	margin-top:1%;
}
th{
	font-size:22px;
	font-family:"times new roman",Times,serif;
	border: 2px solid black;
}
td{
	font-size:20px;
	border: 1px solid #444;
}
</style>
<div class="contain">
	<form class="form-inline" method="GET">
	<br>
	  <label class="label">Search Brand:</label>
	  <input class="text" type="text" name="searchKey" placeholder="Enter Name" onkeyup ="characteronly(this)">
      <button type="submit" name="search" class="searchbutton">Search</button>
	 </div>
   </div>
 
<div class="pview">
	<table border="1" align="right">
	<tr>
<th>Id</th>
		<th>Product</th>
		<th>Brand</th>
		<th>Added Date</th>
		<th>ACTIONS</th>
	</tr>
	<?php
	while($data=mysqli_fetch_assoc($result)){
	?>
	<tr>
	<td><?php echo $data["Id"]?></td>
	<td><?php echo $data["Product"]?></td>
	<td><?php echo $data["brand"]?></td>
	<td><?php echo $data["Date"]?></td>
	<td> 
		<a href="updatebrand.php?update_id=<?php echo $data["Id"];?>">Edit</a>
		<?php echo "||"?>
		<a href="addbrand.php?delete_id=<?php echo $data["Id"]; ?>">Delete</a>
	</td>
	</tr>
	<?php } ?>
</table>
</form>
</div>
<script type="text/javascript">
function characteronly(input)
	{
		var cha= /[^a-z]/gi;
		input.value=input.value.replace(cha,"");
	}
	</script>
</body>
</html>

<?php
 if(isset($_GET["delete_id"])&& $_GET["delete_id"]>0){
		$deleteId=$_GET["delete_id"];
		$deleteSql="delete from brand where Id=$deleteId";
		$res=mysqli_query($conn,$deleteSql);
		if($res>0){
			echo ("<script>
					window.alert('Brand Deleted');
					window.location.href='addbrand.php';
					</script>");
		}
		else{
			
			echo ("<script>
					window.alert('Failed to delete Brand');
					window.location.href='addbrand.php';
					</script>");
		}
	}
if(isset($_POST["updatebrand"])){
		$id=$_POST["id"];
		$name=$_POST["name"];
		$product=$_POST["product"];
		$date=$_POST["date"];
		
		$sql="update brand set Date='$date', Product='$product', brand='$name' where Id='$id'";
		
		$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		if($result>0){
			echo ("<script>
					window.alert('brand Updated');
					window.location.href='addbrand.php';
					</script>");
		}
		else{
			echo ("<script>
					window.alert('Failed to update Brand');
					window.location.href='addbrand.php';
					</script>");
			
		}
	}
?>
