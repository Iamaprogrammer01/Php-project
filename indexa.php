<?php
	include 'db_conn.php';
	
?>
<html>
  <head>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel='stylesheet' href='https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'>
    <script src="https://code.jquery.com/ui/1.13.0-rc.3/jquery-ui.min.js" integrity="sha256-R6eRO29lbCyPGfninb/kjIXeRjMOqY3VWPVk6gMhREk=" crossorigin="anonymous"></script>
    
  </head>
  <body>
    <div class='container pt-5'>
      <?php
        if(isset($_POST["submit"])){
          $invoice_no=$_POST["invoice_no"];
          $invoice_date=date("Y-m-d",strtotime($_POST["invoice_date"]));
          $cname=mysqli_real_escape_string($conn,$_POST["cname"]);
          $caddress=mysqli_real_escape_string($conn,$_POST["caddress"]);
          $grand_total=mysqli_real_escape_string($conn,$_POST["grand_total"]);
          
          $sql="insert into invoice (INVOICE_NO,INVOICE_DATE,CNAME,CADDRESS,GRAND_TOTAL) values ('{$invoice_no}','{$invoice_date}','{$cname}','{$caddress}','{$grand_total}') ";
          if($conn->query($sql)){
            $sid=$conn->insert_id;
            
            $sql2="insert into sales (name,company_name,unit_price,quantity,dos,total_price) values ";
            $rows=[];
            for($i=0;$i<count($_POST["pname"]);$i++)
            {
              $pname=mysqli_real_escape_string($conn,$_POST["name"][$i]);
			   $cname=mysqli_real_escape_string($conn,$_POST["cname"][$i]);
              $price=mysqli_real_escape_string($conn,$_POST["price"][$i]);
              $qty=mysqli_real_escape_string($conn,$_POST["qty"][$i]);
              $total=mysqli_real_escape_string($conn,$_POST["total"][$i]);
			  
              $rows[]="('{$pname}','{$cname}','{$price}','{$qty}','{$invoice_date}','{$total}')";
            }
            $sql2.=implode(",",$rows);
            if($conn->query($sql2)){
              echo "<div class='alert alert-success'>Invoice Added Successfully. <a href='print.php?id={$sid}' target='_BLANK'>Click </a> here to Print Invoice </div> ";
            }else{
              echo "<div class='alert alert-danger'>Invoice Added Failed.</div>";
            }
          }else{
            echo "<div class='alert alert-danger'>Invoice Added Failed.</div>";
          }
        }
        
      ?>
      <form method='post' action='indexa.php' autocomplete='off'>
        <div class='row'>
          <div class='col-md-4'>
            <h5 class='text-success'>Invoice Details</h5>
            <div class='form-group'>
              <label>Invoice No</label>
              <input type='text' name='invoice_no' required class='form-control'>
            </div>
            <div class='form-group'>
              <label>Invoice Date</label>
              <input type='text' name='invoice_date' id='date' required class='form-control'>
            </div>
          </div>
          <div class='col-md-8'>
            <h5 class='text-success'>Customer Details</h5>
            <div class='form-group'>
              <label>Name</label>
              <input type='text' name='cname' required class='form-control'>
            </div>
            <div class='form-group'>
              <label>Address</label>
              <input type='text' name='caddress' required class='form-control'>
          </div>
        </div>
        <div class='row'>
          <div class='col-md-12'>
            <h5 class='text-success'>Product Details</h5>
            <table class='table table-bordered'>
              <thead>
                <tr>
                  <th>Product</th>
				  <th>Company</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='product_tbody'>
                <tr>
                  <td><Select id="product" name="name">
					<option value="">Select Product</option>
						<?php
						
							$query= "SELECT DISTINCT (name) as name FROM inventory ORDER BY name ASC";
							$result=$conn->query($query);
		
						if($result->num_rows >0){
							while($row=$result->fetch_assoc()){
								echo"<option value=$row[name]> $row[name]</option>";
							}
						}else{
							echo '<option value="">Product not available<?option>';
						}
						?>
					</td>
				  <td><Select id="company" name="cname">
					<option value="">Select Company</option>
					<?php
					$query1= "SELECT DISTINCT (company_name) as company_name FROM inventory ORDER BY company_name ASC";
					$result1=$conn->query($query1);
						if($result1->num_rows >0){
							while($row=$result1->fetch_assoc()){
								echo"<option value=$row[company_name]> $row[company_name]</option>";
							}
						}else{
							echo '<option value="">brand not available<?option>';
						}
					?>
					</select>
					</td>
                  <td><input type='text' required name='price[]' class='form-control price'></td>
                  <td><input type='text' required name='qty[]' class='form-control qty'></td>
                  <td><input type='text' required name='total[]' class='form-control total'></td>
				  
                  <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td><input type='button' value='+ Add Row' class='btn btn-primary btn-sm' id='btn-add-row'></td>
                  <td colspan='3' class='text-right'>Total</td>
                  <td><input type='text' name='grand_total' id='grand_total' class='form-control' required></td>
                </tr>
              </tfoot>
            </table>
            <input type='submit' name='submit' value='Save Invoice' class='btn btn-success float-right'>
          </div>
        </div>
      </form>
    </div>
    <script>
      $(document).ready(function(){
        $("#date").datepicker({
          dateFormat:"dd-mm-yy"
        });
        
        $("#btn-add-row").click(function(){
          var row="<tr> <td><input type='text' required name='pname[]' class='form-control'></td> <td><input type='text' required name='price[]' class='form-control price'></td> <td><input type='text' required name='qty[]' class='form-control qty'></td> <td><input type='text' required name='total[]' class='form-control total'></td> <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td> </tr>";
          $("#product_tbody").append(row);
        });
        
        $("body").on("click",".btn-row-remove",function(){
          if(confirm("Are You Sure?")){
            $(this).closest("tr").remove();
            grand_total();
          }
        });

        $("body").on("keyup",".price",function(){
          var price=Number($(this).val());
          var qty=Number($(this).closest("tr").find(".qty").val());
          $(this).closest("tr").find(".total").val(price*qty);
          grand_total();
        });
        
        $("body").on("keyup",".qty",function(){
          var qty=Number($(this).val());
          var price=Number($(this).closest("tr").find(".price").val());
          $(this).closest("tr").find(".total").val(price*qty);
          grand_total();
        });      
        
        function grand_total(){
          var tot=0;
          $(".total").each(function(){
            tot+=Number($(this).val());
          });
          $("#grand_total").val(tot);
        }
      });
    </script>
  </body>
</html>