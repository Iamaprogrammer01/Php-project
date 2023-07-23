<?php
session_start();
if(!isset($_SESSION["user_name"])){
	header("Location:dashboard.php");
}
include 'db_conn.php';
if(isset($_GET["receipt_id"]) && $_GET["receipt_id"]>0){
		$id=$_GET["receipt_id"];
		$sql="select * from sales where id='$id'";
		$res=mysqli_query($conn,$sql);
		
		while($data=mysqli_fetch_assoc($res)){
			$name=$data["name"];
			$cname=$data["company_name"];
			$price=$data["unit_price"];
			$quantity=$data["quantity"];
			$dop=$data["dos"];
			$total=$data["total_price"];
			
		}
} 
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible"content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<style>
	 h4{
		 font-family: Verdana, Geneva, Tahona, sans-serif;
		 text-align: center;
		 text-decoration:underline;
	 }
	 table{
		 font-family: Arial, Helvetica, sans-serif;
		 border-collapse: collapse;
		 width: 50%;
		  margin-left:auto;
		 margin-right:auto;
	 }
	  h5{
		 font-family: sans-serif;
		 text-align: center;
		 line-height: 0%;
	 }
	 th{
		 border: 1px solid #444;
		 padding: 8px;
		 text-align:left;
	 }
	 td{
		 border: 1px solid #444;
		 padding: 8px;
	
	 }
	 .my-table{
		 text-align:right;
	 }
	 .btn{
		  margin-top:5%;
		 margin-left:40%;
		 text-align:center;
		 width:40%;
		 
	 }
	 .backbtn
	 {
		 margin-top:-1.5%;
		 margin-left:40%;
		 text-align:center;
		 width:60%;
	 }
	</style>
	<body>
	
	<div id="tab">
	<table>
		<h4>Sales Receipt</h4>
		<h5>ABC Department</h5>
		<h5>Birtamode-5,Jhapa</h5>
		<thead>
		<tr>
		<th>Items</th>
		<th>Company</th>
		<th>Quantity</th>
		<th>Rate</th>
		<th>Total Amount</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td><?php echo $name?></td>
		<td><?php echo $cname?></td>
		<td><?php echo $quantity?></td>
		<td><?php echo $price?></td>
		<td><?php echo $total?></td>
		</tr>
		</tbody>
		<tr>
			<th colspan="4" class="my-table">Grand Total</th>
			<th><?php echo $total?></th>
		</tr>
		</table>
		</div>
		<div class="btn">
	<button type="submit" value="Print" 
            id="btPrint" onclick="createPDF()" >Print</button>
	</div>
	<div class="backbtn">
	<button class="backbutton"><a href="sales_view.php">Back</a></button>
		</div>
	</body>
	</html>
		<script>
function createPDF() {
        var sTable = document.getElementById('tab').innerHTML;

        var style = "<style>";
        style = style + "table {width: 60%;font: 17px Calibri;}";
        style = style + "table,h4, th, td {border: solid 1px #DDD; border-collapse: collapse;";
		style = style + " table,h5{text-align: center;}";
	    style = style + "padding: 2px 3px;text-align: center;}";
		
        style = style + "</style>";

        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Profile</title>');
        win.document.write(style);      
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);
        win.document.write('</body></html>');

        win.print();
    }
	</script>