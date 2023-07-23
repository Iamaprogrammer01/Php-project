 
<?php include 'db_conn.php'; 

?>

 <html>
 <head>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="maina.css" rel="stylesheet">
	<style>
	input[type=text], textarea {
  width: 50%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  color:black;
  margin-left:80px;
  margin-top:0px;
  height:35px;
  font-weight:bold;
}
	input[type=date]{
		margin-top:5px;
		margin-left:80px;
		height:37px;
		color:black;
		width:50%;
		font-weight:bold;
	}	
	select{
		width:150%;
		height:30px;
		 margin-left:80px;
		 color:black;
		 margin-top:5px;
		 font-weight:bold;
	}
	option{
		color:black;
		font-weight:bold;
	}

label {
  display: inline-block;
  color:black;
  margin-left:0px;
  margin-top:7px;

}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
    margin-left:250px;
	margin-right:500px;
	margin-top:70px;
	width:50%;
	height:80%;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
  
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
h2{
	color:black;
	text-align:center;
	padding:20px;
	margin-top:-20px;
	text-decoration:underline;
}

.addp{
  background-color: #4CAF50;
  width:130px;
  color: White;
  padding: 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-decoration:none;
  margin:0px;
  margin-top:0px;
  margin-button:400px;
}
.addb{
  background-color: #4CAF50;
  width:130px;
  color: White;
  padding: 12px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-decoration:none;
  float:right;
  margin:0px;
  margin-top:0px;
  margin-button:400px;
}
	</style>
	
 </head>
 <body>
 
 <div class="grid-container">
 
 <?php
 
 include'dashboard.php'; 
 ?>
  <main class="main">
 
 
<div class="container">

  <form method="POST" enctype="multipart/form-data">
   <button class="addp" type="submit" name="back">Add New Product</button>
   <button class="addb" type="submit" name="brand">Add New Brand</button>
   <br>
   <br>
  <h2>NEW PURCHASE</h2>
 
   <div class="row">
    <div class="col-25">
      <label for="DOB">Date of Purchase:</label>
    </div>
    <div class="col-75">
      <input type="date" name="pdate" value="<?php echo date("Y-m-d"); ?>" readonly>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="product">Product Name:</label>
    </div>
	<?php
			$query= "SELECT * FROM product ORDER BY Product ASC";
			$result=$conn->query($query);
		?>
    <div class="col-25">
      <Select id="product" name="name">
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
  </div>
  <div class="row">
    <div class="col-25">
      <label for="brand">Company Name:</label>
    </div>
	<?php
			$query1= "SELECT * FROM brand ORDER BY brand ASC";
			$result1=$conn->query($query1);
		?>
    <div class="col-25">
      <Select id="company" name="cname">
	  <option value="">Select Company</option>
	  <?php
						if($result1->num_rows >0){
							while($row=$result1->fetch_assoc()){
								echo"<option value=$row[brand]> $row[brand]</option>";
							}
						}else{
							echo '<option value="">brand not available<?option>';
						}
					?>
	  </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label>Quantity:</label>
    </div>
    <div class="col-75">
      <input type="text" id="quantity" name="quantity" placeholder="Enter Quantity" onkeyup ="numberonly(this)">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">Unit Price:</label>
    </div>
    <div class="col-75">
      <input type="text" id="unit" name="price" placeholder="Enter Price" onkeyup ="numberonly(this)" >
    </div>
  </div>
	<div class="row">
    <div class="col-25">
      <label for="lname">Total Price:</label>
    </div>
    <div class="col-75">
      <input type="text" id="total" name="total" readonly>
    </div>
  </div>
  <div class="row">
    <input type="submit" name="submit" value="Submit">
  </div>
  
  </form>
</div>
   
  </main>

 <?php include 'footer.php'; ?>
</div>
<script>
	$(document).ready(function(){
		$("#unit").keyup(function(){
		
		 var total=0;
		 var x=Number($("#unit").val());
		 var y= Number($("#quantity").val());
		 var total=x * y;
		 $("#total").val(total);
		});
	});
	function numberonly(input)
	{
		var num = /[^0-9]/gi;
		input.value = input.value.replace(num,"");
	}
	</script>
</body>
<script type="text/javascript" src="js/main.js"></script>

</html>
<?php
	
	if(isset($_POST['submit']))
	{
		$name=$_POST["name"];
		$price=$_POST["price"];
		$quantity=$_POST["quantity"];
		$cname=$_POST["cname"];
		$total=$price * $quantity;
		$dop=$_POST["pdate"];
		$sucess = 0;
		if(empty($name))
		{
			echo ("<script>
					window.alert('Please select product name!!!');
					window.location.href='purchase.php';
					</script>");
		}
		else if(empty($cname))
		{
			echo ("<script>
					window.alert('Please select company name!!!');
					window.location.href='purchase.php';
					</script>");
		}
		else if(empty($quantity))
		{
			echo ("<script>
					window.alert('Please Enter Quantity!!!');
					window.location.href='purchase.php';
					</script>");
		}
		else if(empty($price))
		{
			echo ("<script>
					window.alert('Please Enter unit price!!!');
					window.location.href='purchase.php';
					</script>");
		}
		$query = "Select * from inventory";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){
			
			 if($row['name']==$name && $row['company_name']==$cname){
                    
				    $qty = $row['quantity']+$quantity;
					$sq = "UPDATE inventory SET name = '$name', company_name='$cname', quantity='$qty' where name='$name' AND company_name='$cname'"; 
					mysqli_query($conn,$sq);
					
					$sucess = 1;
			 }
			}
		if($sucess==0){	
		
		 $sql_inventory= "INSERT INTO inventory (`name`, `company_name`, `quantity`) VALUES ('$name','$cname','$quantity')";
		 mysqli_query($conn,$sql_inventory);
		}
		$sql= "insert into purchase(name, company_name,unit_price, quantity,dop ,total_price) VALUES ('$name','$cname','$price','$quantity','$dop','$total')";	
		$result=mysqli_query($conn,$sql)or die (mysqli_error($conn));
		if($result>0){
			
			echo ("<script>
					window.alert('New Purchase Created Successfully');
					window.location.href='purchase.php';
					</script>");
		}
		else{
			echo ("<script>
					window.alert('Failed to create new purchase');
					window.location.href='purchase.php';
					</script>");
			
		}
		
	 }
		if(isset($_GET["delete_id"])&& $_GET["delete_id"]>0){
		$deleteId=$_GET["delete_id"];
		$deleteSql="delete from purchase where id=$deleteId";
		
		$res=mysqli_query($conn,$deleteSql);
		if($res>0){
			echo ("<script>
					window.alert('purchase details deleted successfully.');
					window.location.href='purchase_view.php';
					</script>");
		}
		else{
			
			echo ("<script>
					window.alert('Failed to delete Record');
					window.location.href='purchase_view.php';
					</script>");
		}
	}
	if(isset($_POST['back']))
	{
		echo ("<script>
					
					window.location.href='addproduct.php';
					</script>");
	}
	if(isset($_POST['brand']))
	{
		echo ("<script>
					
					window.location.href='addbrand.php';
					</script>");
	}
?>