<?php
session_start();
if(!isset($_SESSION["user_name"])){
	header("Location:dashboard.php");
}
include 'db_conn.php';
if(isset($_GET["update_id"]) && $_GET["update_id"]>0){
		$id=$_GET["update_id"];
		$sql="select * from purchase where id='$id'";
		$res=mysqli_query($conn,$sql);
		$name="";
		$price="";
		$quantity="";
		$dop="";
		$total="";
		
		while($data=mysqli_fetch_assoc($res)){
			$Id=$data["id"];
			$name=$data["name"];
			$price=$data["unit_price"];
			$quantity=$data["quantity"];
			$dop=$data["dop"];
			$total=$data["total_price"];
			
		}
		$sql1="select * from company where item_id='$id'";
		$res1=mysqli_query($conn,$sql1);
		$cname="";
		
		while($data=mysqli_fetch_assoc($res1)){
			$ID=$data["c_id"];
			$cname=$data["company_name"];
		}
	}
?>

 <html>
<head>
	<script type="text/javascript" src="jquery-3.6.0.min.js">
	</script>
	<body>
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
	</script>
	<div>
		<table align="center">
			<form action="purchase.php"method="post" name="purchase"  >
			<input type="hidden" name="Id" value="<?php echo $Id;?>">
			<input type="hidden" name="ID" value="<?php echo $ID;?>">
		<?php
			echo"<table>
			<form method='post'>
			<tr>
			<td>Product Name:</td>
			<td>";
	
			$query= "SELECT DISTINCT (Product) as Product FROM product";
			if($result=$conn->query($query))
				{
					echo"<select id=s1 name=name>";
					while($row=$result->fetch_assoc())
					{
			
						echo"<option value=$row[Product]> $row[Product]</option>";
					}
					echo"</select>";
					echo"</td>";
				}
	
			else
				{
				$conn->error;
				}
				
	?>
				
				<tr>
				<td>Quantity</td>
				<td><input type="text" id="quantity" value="<?php echo $quantity; ?>" name="quantity"> </td>
				</tr>
				<tr> 
				<td>Unit Price</td>
				<td>  <input type="text"id="unit" value="<?php echo $price; ?>" name="price">
				</td>
				</tr>
				<tr>
				<td>Total Price</td>
				<td>   <input type="text" id="total" value="<?php echo $total; ?>" name="total" readonly> </td>
				</tr>
				<?php
			echo"<table>
			<form method='post'>
			<tr>
			<td>Company Name:</td>
			<td>";
	
			$query= "SELECT DISTINCT (brand) as brand FROM brand";
			if($result=$conn->query($query))
				{
					echo"<select id=s1 name=cname>";
					while($row=$result->fetch_assoc())
					{
			
						echo"<option value=$row[brand]> $row[brand]</option>";
					}
					echo"</select>";
					echo"</td>";
				}
	
			else
				{
				$conn->error;
				}
				echo "</tr>";
			?>
				
				<div>
					<label>Purchase Date</label>
					<input type="text" name="pdate" value="<?php echo $dop ?>" readonly />
				</div>
				<tr>
				<td></td>
				<td><button type="submit" name="updatepurchase">Update</td>
				<td><button class="backbutton"><a href="dashboard.html">Back</a></button></td>
				</tr>
			</form>
		</table>
	</div>
	</body>
</html>