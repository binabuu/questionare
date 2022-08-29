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
  <h2 >Calculate Income For any Period</h2>
</div>
</p>
<form class="w3-container" method="POST" name="addStaff" id="addStaff" action="<?php echo URL?>company/mapato" >

<div class="w3-row-padding">
  <div class="w3-half">
    <label class="w3-text-teal"><b>Opening Stock</b></label>
  <input class="w3-input w3-border w3-light-grey" name="os" id="os" type="number">
  </div>
  <div class="w3-half">
    
  <label class="w3-text-teal"><b>Closing Stock</b></label>
  <input class="w3-input w3-border w3-light-grey" name="cs" id="cs" type="number">
  </div>
</div>
</p>
<div class="w3-row-padding">
  <div class="w3-half">
    <label class="w3-text-teal"><b>Carriege Inwards</b></label>
  <input class="w3-input w3-border w3-light-grey" name="ci" id="ci" type="number">
  </div>
  <div class="w3-half">
  <label class="w3-text-teal"><b>Expenses</b></label>
  <input class="w3-input w3-border w3-light-grey" name="ex" id="ex" type="number">
  </div>
</div>
</p>
  
<div class="w3-row-padding">
  <div class="w3-half">
    <button class="w3-btn w3-blue-grey" id="newStaff1">Register</button>
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
			 var sid = $('#sid').val();
			 var fname = $('#fn').val();
			 var lname = $('#ln').val();
			 var addr = $('#addr').val();
			 var sex = $('#gender').val();
			 var role = $('#role').val();
			
			
			 if(sid == ''){
				 alert("Fill User Name");
			 }else if(fname == ''){
				 alert("Fill First Name");
			 }else if(lname == ''){
				 alert("Fill Last Name");
			 }else if(addr == ''){
				 alert("Fill Address");
			 }else if(sex == 0){
				 alert("Select Gender");
			 } else if(role == 0){
				 alert("Select Role");
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