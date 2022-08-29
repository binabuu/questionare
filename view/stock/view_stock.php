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
  <h2 >View Stock</h2>
</div>
 
<div class="w3-row-padding">
  <div class="w3-half">
  <input class="w3-input w3-border w3-light-grey" name="search" id="search" type="text" placeholder="Search by Product Name">
  </div>
 
</div>
</p>
 <a href="<?php echo URL?>stock" class="button">New Product in Stock</a>
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
	 var url = "<?php echo URL ?>stock/stockList";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
	
      $('#search').keyup(function (){
		  var txt = $(this).val();
		  if(txt != '')
		  {
			  $.ajax({
				  url:"<?php echo URL ?>stock/stockSearch",
				  method:"POST",
				  data:{search:txt},
				  dataType:"text",
				  success:function(data){
					    $("#view_stock_body").html(data);
				  }
			  });
			  
		  }else
		  {
			  var url = "<?php echo URL ?>stock/stockList";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
		  }
	  });
	
	
                        });
</script>
