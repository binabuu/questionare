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
  <h2 >Stock Out</h2>
</div>
</p>
<form class="w3-container" name="addStaff" id="addStaff" method="POST" action="<?php echo URL?>stock/sendtoCart" >
<?php if(empty($_SESSION['cart'])){ ?>
<div class="w3-row-padding">
  <div class="w3-half">
   <label class="w3-text-teal"><b>Supplier</b></label>
  <select name="cid" class="w3-input w3-border w3-light-grey" id="cid" required>
   <option value="" disabled selected>Choose Supplier</option>
	<?php foreach($this->cust as $key => $row){?>
	 <option value="<?php echo $row['cid']?>"><?php echo $row['fname']." ".$row['lname'].", ".$row['location']?></option>
	<?php }?>
  </select>
  </div>
  <div class="w3-half">
  <label class="w3-text-teal"><b>Customer</b></label>
  <select name="cid2" class="w3-input w3-border w3-light-grey" id="cid2" required>
   <option value="" disabled selected>Choose Customer</option>
	<?php foreach($this->cust2 as $key => $row){?>
	 <option value="<?php echo $row['cid']?>"><?php echo $row['fname']." ".$row['lname'].", ".$row['location']?></option>
	<?php }?>
  </select>
  </div>
</div>
<?php } ?>
</p>

<div class="w3-row-padding">
  <div class="w3-half">
  <label class="w3-text-teal"><b>Product</b></label>
  <input class="w3-input w3-border w3-light-grey" readonly name="pro" id="pro" type="text" value="<?php echo $this->pro2['bname']?>">
  <input class="w3-input w3-border w3-light-grey" readonly name="sid" id="sid" type="hidden" value="<?php echo $this->pro2['sid']?>">
  <input class="w3-input w3-border w3-light-grey" readonly name="bid" id="bid" type="hidden" value="<?php echo $this->pro2['bid']?>">
  <input class="w3-input w3-border w3-light-grey" readonly name="mael" id="mael" type="hidden" value="<?php echo $this->pro2['maelezo']?>">
  
  </div>
  <div class="w3-half">
      <label class="w3-text-teal"><b>Quantity</b></label>
  <input class="w3-input w3-border w3-light-grey" name="qn" id="qn" type="number" required>
  </div>
</div>
</p>

<div class="w3-row-padding">
  <div class="w3-half">
  <label class="w3-text-teal"><b>Price</b></label>
  <input class="w3-input w3-border w3-light-grey" name="price" id="price" type="text" value="<?php echo $this->pro2['sellprice']?>" required>
  </div>
  <div class="w3-half">
     <label class="w3-text-teal"><b>Order Type</b></label>
  <select name="type" class="w3-input w3-border w3-light-grey" id="type" required>
   <option value="" disabled selected>Select Order Type</option>
	 <option value="cash">Cash</option>
	 <option value="credit">Credit</option>
  </select>
  </div>
</div>
</p>
  
<div class="w3-row-padding">
  <div class="w3-half">
    <button class="w3-btn w3-blue-grey" id="newStaff1" > Submit</button>
  </div>
</div>

</p>
<div class="w3-row-padding">
  <div class="w3-half">
    <div id="alert"></div>
  </div>
</div>
  
</form>


</div>
</div>
<?php 
//include 'view/footer.php';
?>
</body>

</html>
<script>
$(document).ready(function () {
			
		 $('#newStaff').click(function () {
			 var cid = $('#cid').val();
			 var qn = $('#qn').val();
			 var pri = $('#pri').val();

			 if(cid == 0){
				 alert("Select Customer");
			 }else if(qn == ''){
				 alert("Fill Quantity");
			 }else if(pri == ''){
				 alert("Fill Price");
			 }else{
				  var form = $("#addStaff");
            var url = form.attr("action");
            var formData = form.serialize();
            $.post(url, formData, function (data) {
				 $("#alert").html(data).css({"background-color": "#616161" ,"color":"#ffffff"}).fadeIn(4000,function(){
			 $("#alert").fadeOut('slow');
			
			
		 }); 
			
			
            });

			 }
			return false;
			
        })
		 });
	
                        
</script>