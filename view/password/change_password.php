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
  <h2 >Change Password</h2>
</div>
</p>
<form class="w3-container" name="addStaff" id="addStaff" method="POST" action="<?php echo URL?>password/changePassword" >


    <label class="w3-text-teal"><b>Old Password</b></label>
  <input class="w3-input w3-border w3-light-grey" name="op" id="sid" type="password">
 
  <label class="w3-text-teal"><b>New Password</b></label>
  <input class="w3-input w3-border w3-light-grey" name="np" id="fn" type="password">
  
</p>


<div class="w3-row-padding">
  <div class="w3-half">
     <button class="w3-btn w3-blue-grey" id="pass">Change</button>
  </div>
  
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
	
	 $('#pass').click(function () {
            var form = $("#addStaff");
            var url = form.attr("action");
            var formData = form.serialize();
            $.post(url, formData, function (data) {
				$('input[type="password"]').val('');
				 $("#alert").html(data);
			
            });
				return false;
		 }); 
			
		
			
        });                  
</script>