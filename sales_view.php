<?php
session_start();
if(!isset($_SESSION["user_name"])){
	header("Location:index.php");
}
include 'db_conn.php';


$sql="SELECT * from sales";

if(isset($_GET["search"])){
	$searchKey=$_GET['searchKey'];
	$sql="select * from sales where name Like '%$searchKey%'";
}
$result=mysqli_query($conn,$sql);
?>
<html>
<head>
<link href="main.css" rel="stylesheet">
</head>
<style>

input[type=text]{
	color:black;
	height:35px;
}

body{
	margin-top:0px;
	height:100%;
	background-color:9999ff;
}
 h3{
		 font-family: Verdana, Geneva, Tahona, sans-serif;
		 text-align: center;
		 margin-top:40px;
		 text-decoration:underline;
		 color:black;
	 }
	 table{
		 font-family: Arial, Helvetica, sans-serif;
		 border-collapse: collapse;
		 width:70%;
		  margin-left:20%;
		 margin-right:auto;
		 color:black;
		 text-align:center;
	 }
	  h5{
		 font-family: sans-serif;
		 text-align: center;
		 line-height: 0%;
		 color:black;
	 }
	 th{
		 background-color:#bfc1c2;
		 border: 2px solid black;
		 padding: 5px;
		 text-align:left;
		 font-size:15px;
		 color:black;
		
	 }
	 td{
		 border: 1px solid #444;
		 padding: 5px;
		 font-size:15px;
		 color:black;
	 }
	 .sym{
		 margin-left:auto;
		 margin-right:auto;
	 }
	   tbody tr:nth-child(odd) {
        background: #ffffff;
      }
      tbody tr:nth-child(even) {
        background:#f2f2f2;
      }
	  button{
		  color:black;
		  font-size:17px;
	  }
	  a{
		  color:black;
		  text-decoration:none;
	  }
	  label{
		  margin-left:50%;
		  font-size:20px;
	  }
	  	.header {
	  grid-area: header;
	  display: flex;
	  align-items: center;
	  justify-content: space-between;
	  padding: 0 16px;
	  background-color: #64839D;
	   text-decoration: none;
	   height:7%;
	}
	.footer {
	  grid-area: footer;
	  display: flex;
	  align-items: center;
	  justify-content: space-between;
	  padding: 0 16px;
	  background-color: #537e7b;
	  height:6%;
	  font-weight:bold;
	}
	.footera{
		  color:#212121;
	}
	.button{
		background-color:gray;
		border:3px solid black;
		color:white;
	}
	</style>
	<?php include 'dashboard.php';?>
	<br>
<body>
<h3>Sales History:</h3>
<br>
<br>


<form class="form-inline" method="GET" align="center">
	  <label class="searchbutton">Search sales:</label>
	  <input type="text" name="searchKey" placeholder="Enter Product Name" onkeyup="characteronly(this)">
      <button type="submit" name="search">Search</button>
	 </form>
	 <br>
	 <br>
	<table align="center">
	<tr>
		<th>ITEM NAME</th>
		<th>QUANTITY</th>
		<th>UNIT PRICE</th>
		<th>TOTAL PRICE</th>
		<th>MANUFACTURED COMPANY</th>
		<th>DATE OF SALES</th>
		<th>ACTIONS</th>
	</tr>
	<?php
	while($data=mysqli_fetch_assoc($result)){
	?>
	<tr>
	<td><?php echo $data["name"]?></td>
	<td><?php echo $data["quantity"]?></td>
	<td><?php echo $data["unit_price"]?></td>
	<td><?php echo $data["total_price"]?></td>
	<td><?php echo $data["company_name"]?></td>
	<td><?php echo $data["dos"]?></td>
	<td> 
		<button class="button"><a href="sales_view.php?delete_id=<?php echo $data["id"]; ?>">Delete</a></button>
		<button class="button"><a href="receipt.php?receipt_id=<?php echo $data["id"];?>">Receipt</a></button>
		
	</td>
	</tr>
	<?php } ?>
	
</table>
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
		$deleteSql="delete from sales where id=$deleteId";
		$res=mysqli_query($conn,$deleteSql);
		if($res>0){
			echo ("<script>
					window.alert('Sales record Deleted');
					window.location.href='sales_view.php';
					</script>");
		}
		else{
			
			echo ("<script>
					window.alert('Failed to delete SALES record');
					window.location.href='sales_view.php';
					</script>");
		}
	}
	?>