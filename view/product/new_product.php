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
  <h2 >Add Product</h2>
</div>
</p>
<form class="w3-container" method="POST" name="addStaff" id="addStaff" action="<?php echo URL?>product/addProduct" >

<div class="w3-row-padding">
  <div class="w3-half">
   <label class="w3-text-teal"><b>Product Name</b></label>
  <input class="w3-input w3-border w3-light-grey" name="bn" id="bn" type="text">
  </div>
  <div class="w3-half">
    <label class="w3-text-teal"><b>Description</b></label>
  <input class="w3-input w3-border w3-light-grey" name="desc" id="desc" type="text">
 
  </div>
</div>
</p>
<div class="w3-row-padding">
  <div class="w3-half">
  <label class="w3-text-teal"><b>Buy Price</b></label>
  <input class="w3-input w3-border w3-light-grey" name="bp" id="bp" type="text">
  </div>
 <div class="w3-half">
 <label class="w3-text-teal"><b>Sell Price</b></label>
  <input class="w3-input w3-border w3-light-grey" name="sp" id="sp" type="text">
  </div>
</div>
</p>

  
<div class="w3-row-padding">
  <div class="w3-half">
    <button class="w3-btn w3-blue-grey" id="newStaff">Add</button>
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
			 var bn = $('#bn').val();
			
			 if(bn == ''){
				 alert("Fill Product Name");
			 }else{
				  var form = $("#addStaff");
            var url = form.attr("action");
            var formData = form.serialize();
            $.post(url, formData, function (data) {
				 $("#alert").html(data).css({"background-color": "#616161" ,"color":"#ffffff"}).fadeIn(4000,function(){
			 $("#alert").fadeOut('slow');
			 $('input[type="text"]').val('');
			 $('#mname').val('');
			
		 }); 
			
			
            });

			 }
			return false;
			
        })
		 });
	
                        
</script>