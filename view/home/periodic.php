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
<div id="keepButton"><a href="<?php echo URL?>home/periodicStock"  class="button">Periodic Stock Out</a> 
<a href="<?php echo URL?>home/stockIn" class="button">Stock In</a>  
<div class="w3-container w3-text-teal ">
  <h2 >Periodic Stock Out</h2>
</div>
 
<div class="w3-row-padding">
  <div class="w3-half">
  <input class="w3-input w3-border w3-light-grey" name="sd" id="sd" type="date" >
  </div>
  
   <div class="w3-half">
  <input class="w3-input w3-border w3-light-grey" name="ed" id="ed" type="date" >
  </div>
 
</div>
</p>
<div class="w3-row-padding">
  <div class="w3-half">
  <input class="w3-input w3-border w3-light-grey" name="bname" id="bname" type="text" placeholder="Search by Product Name">
  </div>
   
</div>
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
<script>
$(document).ready(function () {
	
	
      $('#ed').change(function (){
		  var txt = $(this).val();
		  var sd = $('#sd').val();
		  var bname = $('#bname').val();
		  if(txt != '')
		  {
			  $.ajax({
				  url:"<?php echo URL ?>home/periodicSearch",
				  method:"POST",
				  data:{ed:txt,sd:sd,bname:bname},
				  dataType:"text",
				  success:function(data){
					    $("#view_stock_body").html(data);
				  }
			  });
			  
		  }
	  });
	  
	   $('#sd').change(function (){
		  var txt = $(this).val();
		  var ed = $('#ed').val();
		  var bname = $('#bname').val();
		  if(txt != '')
		  {
			  $.ajax({
				  url:"<?php echo URL ?>home/periodicSearch",
				  method:"POST",
				  data:{sd:txt,ed:ed,bname:bname},
				  dataType:"text",
				  success:function(data){
					    $("#view_stock_body").html(data);
				  }
			  });
			  
		  }
	  });
	  
	   $('#bname').keyup(function (){
		  var txt = $(this).val();
		  var ed = $('#ed').val();
		  var sd = $('#sd').val();
		  if(txt != '')
		  {
			  $.ajax({
				  url:"<?php echo URL ?>home/periodicSearch",
				  method:"POST",
				  data:{bname:txt,ed:ed,sd:sd},
				  dataType:"text",
				  success:function(data){
					    $("#view_stock_body").html(data);
				  }
			  });
			  
		  }
	  });

	  
	  
	
	
                        });
</script>