<html>
<?php 
include 'view/head.php';
?>

<body>

<div class="w3-container w3-white">

<div class="w3-container">
<div class="w3-container w3-text-teal ">
  <h2 ><?php echo $this->cust2['fname']." ".$this->cust2['mname']." ".$this->cust2['lname']." (".$this->cust2['location'].") "?> Statement</h2>
</div>
Statment From  <?php echo $_SESSION['startSession'] ." To " .$_SESSION['endSession'] ?>
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
	 var url = "<?php echo URL ?>customer2/printSt";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
 });
</script>