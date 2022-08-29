<div class="w3-sidebar w3-bar-block w3-light-grey w3-card-2" style="width:160px;">
  <a href="<?php echo URL?>home" class="w3-bar-item w3-button"><i class="fa fa-home" style="font-size:20px;color:black"> Home</i></a>
   <?php Session::init();
				$logged = Session::get('loggedIn');
		$role = Session::get('role');
		if ($logged == true && $role == "boss"){?>
  <a href="<?php echo URL?>staff/viewStaff" class="w3-bar-item w3-button">Staff Management</a>
  <a href="<?php echo URL?>customer/viewCustomer" class="w3-bar-item w3-button">Internal Supplier Management</a>
  <a href="<?php echo URL?>supplier/viewSupplier" class="w3-bar-item w3-button">External Supplier Management</a>
  <a href="<?php echo URL?>customer2/viewCustomer" class="w3-bar-item w3-button">Customer Management</a>
  <a href="<?php echo URL?>company" class="w3-bar-item w3-button">Ochu Farm</a>
  <a href="<?php echo URL?>product/viewProduct" class="w3-bar-item w3-button">Product Management</a>

 
		<?php }elseif($logged == true && $role == "staff"){ ?>

	
	<?php } ?>
	<a href="<?php echo URL?>stock/viewStock" class="w3-bar-item w3-button">Stock Management</a>
  <a href="<?php echo URL?>stock/order" class="w3-bar-item w3-button">Order Details</a>
  <a href="<?php echo URL?>password" class="w3-bar-item w3-button">Change Password</a>
  <a href="<?php echo URL?>home/logout" class="w3-bar-item w3-button">Log Out</a>
  
 
</div>


