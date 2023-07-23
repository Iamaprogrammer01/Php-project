
<?php include 'db_conn.php'; ?>

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
  margin-left:380px;
  margin-top:35px;
  height:45px;
  width:110px;
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
.main{
	background-color:#4DD5A9;
}
	</style>
	
 </head>
 <body>
 
 <div class="grid-container">

 <?php include'dashboard.php'; ?>
  <main class="main">
<div class="container">

  <form method="POST" enctype="multipart/form-data">
	<br>
	<br>
	<h2>NEW SALES</h2>
	<br>
   <div class="row">
    <div class="col-25">
      <label for="DOB">Date of Sales:</label>
    </div>
    <div class="col-75">
      <input type="date" name="sdate" value="<?php echo date("Y-m-d"); ?>" readonly>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="product">Product Name:</label>
    </div>
	<?php
			$query= "SELECT DISTINCT (name) as name FROM inventory ORDER BY name ASC";
			$result=$conn->query($query);
		?>
    <div class="col-25">
      <Select id="product" name="name">
	  <option value="">Select Product</option>
	  <?php
						if($result->num_rows >0){
							while($row=$result->fetch_assoc()){
								echo"<option value=$row[name]> $row[name]</option>";
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
			
			$query1= "SELECT DISTINCT (company_name) as company_name FROM inventory ORDER BY company_name ASC";
			$result1=$conn->query($query1);
		?>
    <div class="col-25">
      <Select id="company" name="cname">
	  <option value="">Select Company</option>
	  <?php
						if($result1->num_rows >0){
							while($row=$result1->fetch_assoc()){
								echo"<option value=$row[company_name]> $row[company_name]</option>";
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
      <input type="text" id="unit" name="price" placeholder="Enter Price" onkeyup ="numberonly(this)">
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
		$dos=$_POST["sdate"];
		$sucess = 0;
		if(empty($name))
		{
			echo ("<script>
					window.alert('Please select product name!!!');
					window.location.href='sales.php';
					</script>");
		}
		else if(empty($cname))
		{
			echo ("<script>
					window.alert('Please select company name!!!');
					window.location.href='sales.php';
					</script>");
		}
		else if(empty($quantity))
		{
			echo ("<script>
					window.alert('Please Enter Quantity!!!');
					window.location.href='sales.php';
					</script>");
		}
		else if(empty($price))
		{
			echo ("<script>
					window.alert('Please Enter unit price!!!');
					window.location.href='sales.php';
					</script>");
		}
		$query = "Select * from inventory";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){
			
			 if($row['name']==$name && $row['company_name']==$cname){
                    if($quantity>$row['quantity'])
					{
						echo ("<script>
						window.alert('Please enter sufficient quantity of that product!!!');
						window.location.href='sales.php';
						</script>");
					}
					else{
						$qty = $row['quantity']-$quantity;
						//$sql= "insert into sales(name, company_name,unit_price, quantity,dos ,total_price) VALUES ('$name','$cname','$price','$quantity','$dos','$total')";	
						//$result=mysqli_query($conn,$sql)or die (mysqli_error($conn));
						
						if($qty<=0)
						{
							$sql= "insert into sales(name, company_name,unit_price, quantity,dos ,total_price) VALUES ('$name','$cname','$price','$quantity','$dos','$total')";
							mysqli_query($conn,$sql)or die (mysqli_error($conn));
							$sqll="delete from inventory WHERE name='$name' AND company_name='$cname'";
							mysqli_query($conn,$sqll);
							echo ("<script>
										window.alert('New sales is done Successfully');
										window.location.href='sales.php';
										 </script>");
							
						}
						else{
							$sq = "UPDATE inventory SET name = '$name', company_name='$cname', quantity='$qty' where name='$name' AND company_name='$cname'"; 
							mysqli_query($conn,$sq);
							
							$sql= "insert into sales(name, company_name,unit_price, quantity,dos ,total_price) VALUES ('$name','$cname','$price','$quantity','$dos','$total')";	
							$result=mysqli_query($conn,$sql)or die (mysqli_error($conn));
							
							if($result>0){
									echo ("<script>
											window.alert('New sales is done Successfully');
											window.location.href='sales.php';
										  </script>");
									}
						else{
								echo ("<script>
										window.alert('Failed to sale');
										window.location.href='homepage.php';
										</script>");
			
							}
						  }
						
						$sucess = 1;
			

						}
			
				}
			}
		if($sucess==0){	
		
		 echo ("<script>
				window.alert('Your item name and made company doesnot match with inventory!!!');
				window.location.href='sales.php';
				</script>");
		}
		
	}
		if(isset($_GET["delete_id"])&& $_GET["delete_id"]>0){
		$deleteId=$_GET["delete_id"];
		$deleteSql="delete from sales where id=$deleteId";
		$res=mysqli_query($conn,$deleteSql);
		if($res>0){
			echo ("<script>
					window.alert('sales details deleted successfully.');
					window.location.href='sales_view.php';
					</script>");
		}
		else{
			
			echo ("<script>
					window.alert('Failed to delete Record');
					window.location.href='sales_view.php';
					</script>");
		}
	}
?>