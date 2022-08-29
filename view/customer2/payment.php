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
  <h2 >Make Payment</h2>
</div>
<form class="w3-container" name="payment" id="payment" method="POST" action="<?php echo URL?>customer2/insertPayment/" >
<div class="w3-row-padding">
  <div class="w3-half">
  <label class="w3-text-teal"><b>Amount</b></label>
  <input class="w3-input w3-border w3-light-grey" name="pay" id="pay" type="text" required>
  <input class="w3-input w3-border w3-light-grey" name="cid" id="cid" type="hidden" value="<?php echo $this->cust['cid'] ?>">
  </div>
  <div class="w3-half">
  <label class="w3-text-teal"><b>Description</b></label>
  <input class="w3-input w3-border w3-light-grey" name="desc" id="desc" type="text" required>
  </div>
</div>
</p>
<div class="w3-row-padding">
  <div class="w3-half">
    <button class="w3-btn w3-blue-grey" id="pay" >Submit</button>
  </div>
</div>
</form>
</p>
	
	<div id="view_stock_body">

</div>
 </div> 


</div>
<?php 
//include 'view/footer.php';
?>
</body>

</html>

<!-- <script>
$(document).ready(function () {
	 var url = "<?php echo URL ?>customer2/payList/<?php echo $this->cust['cid']?> ";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
	
   });
</script> -->
