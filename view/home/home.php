<html>
<?php 
include 'view/head.php';
?>

<body>
<?php 
include 'view/header.php';
?>
<div class="w3-container w3-white " id="topBody" >
<?php 
include 'view/nav.php';
?>
<div class="w3-container" style="margin-left:160px">
<div id="keepButton"><a href="<?php echo URL?>home/periodicStock"  class="button">Periodic Stock Out</a> 
<a href="<?php echo URL?>home/stockIn" class="button">Stock In</a>   
<div class="w3-container w3-text-teal ">
  <h2 >Today Stock Out</h2>
</div>
 
<div class="w3-row-padding">
  <div class="w3-half">
  <input class="w3-input w3-border w3-light-grey" name="search" id="search" type="text" placeholder="Search by Customer Name">
  </div>
  
   <div class="w3-half">
  <input class="w3-input w3-border w3-light-grey" name="search2" id="search2" type="text" placeholder="Search by Product Name">
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
	 var url = "<?php echo URL ?>home/productTaken";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
	
      $('#search').keyup(function (){
		  var txt = $(this).val();
		  if(txt != '')
		  {
			  $.ajax({
				  url:"<?php echo URL ?>home/customerSearch",
				  method:"POST",
				  data:{search:txt},
				  dataType:"text",
				  success:function(data){
					    $("#view_stock_body").html(data);
				  }
			  });
			  
		  }else
		  {
			  var url = "<?php echo URL ?>home/productTaken";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
		  }
	  });
	  
	   $('#search2').keyup(function (){
		  var txt = $(this).val();
		  if(txt != '')
		  {
			  $.ajax({
				  url:"<?php echo URL ?>home/productSearch",
				  method:"POST",
				  data:{search2:txt},
				  dataType:"text",
				  success:function(data){
					    $("#view_stock_body").html(data);
				  }
			  });
			  
		  }else
		  {
			  var url = "<?php echo URL ?>home/productTaken";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
		  }
	  });
	
	
                        });
</script>