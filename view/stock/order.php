<html>
<?php 
include 'view/head.php';
?>

<body>
<?php 
include 'view/header.php';
?>
<div class="w3-container w3-white" id="topBody">
<?php 
include 'view/nav.php';
?>
<div class="w3-container" style="margin-left:160px">
<div class="w3-container w3-text-teal ">
  <h2 >Customer Order</h2>
</div>
  
 <div id="view_stock_body">
<div id="keepButton"> <a href="<?php echo URL?>stock/viewStock" class="button">Add Product</a>  
<a href="<?php echo URL?>stock/stockOut2" class="button">Save</a></div>
				
				<table class="w3-table-all">
				<tr>
				<th>S/N</th>
				<th>PRODUCT NAME</th>
				<th>PRICE</th>
				<th>QUANTITY</th>
				<th>TOTAL</th>
				<th>ACTION</th>
				</tr>
				<?php if(!empty($_SESSION['cart'])){
					$total = 0;
						$i = 1;
					foreach($_SESSION['cart'] as $key => $value){
					
						?>
						<tr class="w3-hover-teal">
						<td><?php echo $i ?></td>
				<td><?php echo $value['name']." (".$value['maelezo'] ?>)</td>
				<td> <?php echo number_format($value['price'])?></td>
				<td> <?php echo $value['quantity']?></td>
				<td> <?php echo number_format($value['quantity'] * $value['price'])?></td>
				<td><a href="<?php echo URL?>stock/cartRemove/<?php echo $value['id'] ?> " class ="button"> <i class='fa fa-trash' style='font-size:16px;color:white'></i> Remove</a> </td>
				</tr>
				<?php	
				$total = $total + ($value['quantity']* $value['price']);
				$i++;
				}
				}else{?>
				<tr>
				<td colspan = "7"><b><h2 style="color:red">NO ITEMS ORDERED</h2></b></td>
				</tr>
				<?php } ?>
				<tr>
				<td colspan ="3"></td>
				<td><b>Total</b></td>
				<td><b><?php  if(isset($total)){ echo number_format($total); }?></b></td>
				<td></td>
				</tr>
				</table>
	
</div>
	
 </div> 


</div>
<?php 
//include 'view/footer.php';
?>
</body>

</html>
	
