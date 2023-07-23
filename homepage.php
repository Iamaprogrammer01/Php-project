<?php
session_start();
if(!isset($_SESSION["user_name"])){
	header("Location:index.php");
}
?>

 <html>
 <head>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 </head>
 <style>
 body {
	  margin: 0;
	  padding: 0;
	  font-family: 'Open Sans', Helvetica, sans-serif;
	  box-sizing: border-box;
	   text-decoration: none;
	   background-image: url('homepage.jpg');
	}
.midtext{
		background-color:#00862C;
		color:white;
}
.services{
		margin-top:0px;
		border:solid green;
		background-color: #b0e1e1;
		color:#000000;
		margin-left:280px;
	}
	.img{
		height:74%;
		width:100%;
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
	h4{
		margin-left:40%;
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
	p{
		color:black;
		font-weight:bold;
		margin-left:0px;
	}
	h1{
		color:black;
		font-weight:bolder;
		font-size:20px;
		margin-left:0px;
	}
	h2{
	border:solid black;	
	font-size:18px;
	background-color:#698B74;
	font-weight:normal;
	}
	h3{
		font-size:19px;
		color:black;
	}
	button{
		height:20%;
	}
 </style>
 <body>
 <div class="grid-container">
 <?php include 'header.php';?>
 <?php include 'dashboard.php';?>
 <img class="img" src="homepage.png">
  <div class="services">
    <h1>Our Service</h1>
    <p>No.1 management service that focus on the fast and effective management of Stocks. </p>
    <p>Covering all types of Products, this provides facility related to Inventory. Based on business need, our team can suggest the most effective and efficient service available.
    </p>
  </div>
        <div class="mid" style="height:30px font-size:60px text-align: center; position: absolute;top: 52%;left: 56%;transform: translate(-50%, -50%);color: black;">
           
            <h3 class="midtext">Inventory Management System</h3>
            <h2>A management system where you can easily manage stock's Purchase, Inventory, Sales and Billing.</h2>
		</div>
		</div>
		<?php include 'footer.php';?>
   </body>
  <script type="text/javascript" src="js/main.js"></script>
</html>

 
 