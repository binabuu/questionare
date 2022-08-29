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
  <h2 >Edit Product</h2>
</div>
</p>
<form class="w3-container" name="addStaff" id="addStaff" method="POST" action="<?php echo URL?>product/saveProduct" >

<div class="w3-row-padding">
  <div class="w3-half">
   <label class="w3-text-teal"><b>Product Name</b></label>
  <input class="w3-input w3-border w3-light-grey" name="bn" id="bn" type="text" value="<?php echo $this->edit['bname']?>">
  <input class="w3-input w3-border w3-light-grey" name="bid2"  type="hidden" value="<?php echo $this->edit['bid']?>">
  </div>
  <div class="w3-half">
    <label class="w3-text-teal"><b>Description</b></label>
  <input class="w3-input w3-border w3-light-grey" name="desc" id="desc" type="text" value="<?php echo $this->edit['maelezo']?>">
 
  </div>
</div>
</p>

  
<div class="w3-row-padding">
  <div class="w3-half">
    <button class="w3-btn w3-blue-grey" id="newStaff" >Save</button>
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
include 'view/footer.php';
?>
</body>

</html>
<script>
$(document).ready(function () {
		
		 $('#newStaff').click(function () {
			 var sid = $('#bn').val();
			
			 if(sid == ''){
				 alert("Fill Product Name");
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