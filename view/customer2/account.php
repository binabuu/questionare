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
  <h2 ><?php echo $this->cust['fname']." ".$this->cust['mname']." ".$this->cust['lname']." (".$this->cust['location'].") "?> Account</h2>
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
	
	 var url = "<?php echo URL ?>customer2/lastDayInfo/<?php echo $this->cust['oid']?>";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });
	
  });
</script>