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
  <h2 >View Returned Out Stock</h2>
</div>
	
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
	 var url = "<?php echo URL ?>stock/returnForward ";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
	
   });
</script>
