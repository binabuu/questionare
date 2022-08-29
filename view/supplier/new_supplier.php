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
  <h2 >Add Supplier</h2>
</div>
</p>
<form class="w3-container" method="POST" name="addStaff" id="addStaff" action="<?php echo URL?>supplier/addSupplier" >

<div class="w3-row-padding">
  <div class="w3-half">
   <label class="w3-text-teal"><b>Supplier Name</b></label>
  <input class="w3-input w3-border w3-light-grey" name="fn" id="fn" type="text">
  </div>
  <div class="w3-half">
    <label class="w3-text-teal"><b>Location</b></label>
  <input class="w3-input w3-border w3-light-grey" name="loc" id="loc" type="text">
 
  </div>
</div>

</p>
  
<div class="w3-row-padding">
  <div class="w3-half">
    <button class="w3-btn w3-blue-grey" id="newStaff">Register</button>
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
			 var fname = $('#fn').val();
						
			 if(fname == ''){
				 alert("Fill Supplier Name");
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