<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styled.css">
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="btn">
			<span class="fas fa-bars"></span>
		</div>
		<nav class="sidebar">
			<div class="text">Side Menu</div>
			<ul>
				<li><a href="homepage.php">HomePage</a></li>
				<li>
					<a class="frst-btn">Purchase
					<span class="fas fa-caret-down first"></span>
					</a>
					<ul class="frst-show">
						<li><a href="purchase.php">New Purchase</a><li>
						<li><a href="purchase_view.php">Purchase History</a><li>
					
					</ul>
				</li>
				<li>
					<a href="#" class="scnd-btn">Sales
					<span class="fas fa-caret-down second"></span>
					</a>
					<ul class="scnd-show">
						<li><a href="sales.php">New Sales</a></li>
						<li><a href="sales_view.php">Sales History</a></li>
					</ul>
				</li>
				<li><a href="inventory.php">Inventory</a></li>
				
				<li>
				<a href="#" class="thrd-btn">Settings
				<span class="fas fa-caret-down third"></span>
					</a>
					<ul class="thrd-show">
						<li><a href="profile.php">User details</a></li>
						<li><a href="changepw.php">Change Password</a></li>
					</ul>
				</li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
		<script>
			$('.btn').click(function(){
				$(this).toggleClass("click");
				$('.sidebar').toggleClass("show");
				
			});
			$('.frst-btn').click(function(){
				$('nav ul .frst-show').toggleClass("show");
				$('nav ul .first').toggleClass("rotate");
			});
			$('.scnd-btn').click(function(){
				$('nav ul .scnd-show').toggleClass("show1");
				$('nav ul .second').toggleClass("rotate");
			});
			$('.thrd-btn').click(function(){
				$('nav ul .thrd-show').toggleClass("show2");
				$('nav ul .third').toggleClass("rotate");
			});
			$('nav ul li').click(function(){
				$(this).addClass("active").siblings().removeClass("active");
			});
		</script>
	</body>
</html>