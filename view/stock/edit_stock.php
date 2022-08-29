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
  <h2 >Stock In</h2>
</div>
</p>
<form class="w3-container" name="addStaff" id="addStaff" method="POST" action="<?php echo URL?>stock/updateStock" >

<div class="w3-row-padding">
  <div class="w3-half">
   <label class="w3-text-teal"><b>Product Name</b></label>
  <input class="w3-input w3-border w3-light-grey" name="pn" id="pn" type="text" readonly value="<?php echo $this->edit['bname']?>">
 
  </div>
  <div class="w3-half">
   <label class="w3-text-teal"><b>Stock In</b></label>
  <input class="w3-input w3-border w3-light-grey" name="si" id="si" type="number">
  <input class="w3-input w3-border w3-light-grey" name="sid" id="sid" type="hidden" value="<?php echo $this->edit['sid']?>">
  </div>
</div>
</p>
<div class="w3-row-padding">
  <div class="w3-half">
   <label class="w3-text-teal"><b>Price</b></label>
	 <input class="w3-input w3-border w3-light-grey" name="price" id="price" type="number" required>
  </div>
  <div class="w3-half">
    <label class="w3-text-teal"><b>Supplier</b></label>
  <select name="supl" class="w3-input w3-border w3-light-grey" id="supl" required>
    <option value="0">Choose Supplier</option>
	<?php foreach($this->supplier as $key => $row){?>
	 <option value="<?php echo $row['supId']?>"><?php echo $row['supname'].", ".$row['location']?></option>
	<?php }?>
  </select>
  </div>
</div>
</p>
<div class="w3-row-padding">
  <div class="w3-half">
   <label class="w3-text-teal"><b>Puchase by</b></label>
	  <select name="type" class="w3-input w3-border w3-light-grey" id="type" required>
    <option value="0">Choose type</option>
	 <option value="cash">Cash</option>
	 <option value="credit">Credit</option>
  </select>
  </div>
  <div class="w3-half">
   
  </div>
</div>
</p>
  
<div class="w3-row-padding">
  <div class="w3-half">
    <button class="w3-btn w3-blue-grey" id="newStaff1" >Save</button>
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
			 var sid = $('#si').val();
			
			 if(sid == ''){
				 alert("Fill the Box");
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