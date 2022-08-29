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
  <h2 ><?php echo $this->sup2['supname']." (".$this->sup2['location'].") "?> Account</h2>
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
	 var url = "<?php echo URL ?>supplier/viewDays/<?php echo $this->sup2['supId']?>";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
	
	
                        });
</script>