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
  <h2 ><?php echo $this->cust2['fname']." ".$this->cust2['mname']." ".$this->cust2['lname']." (".$this->cust2['location'].") "?> Account</h2>
</div>
</p> 
<div class="w3-row-padding">
  <div class="w3-half">
  <input class="w3-input w3-border w3-light-grey" name="sd" id="sd" type="date" >
  <input class="w3-input w3-border w3-light-grey" name="custid" id="custid" type="hidden" value="<?php echo $this->cust2['cid']?>" >
  </div>
  
   <div class="w3-half">
  <input class="w3-input w3-border w3-light-grey" name="ed" id="ed" type="date" >
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
	 var url = "<?php echo URL ?>customer2/statement/<?php echo $this->cust2['cid']?>";
    $.get(url, null, function (data) {
        $("#view_stock_body").html(data);
    });

        $('#ed').change(function (){
		  var txt = $(this).val();
		  var sd = $('#sd').val();
		  var custid = $('#custid').val();
		  if(txt != '')
		  {
			  $.ajax({
				  url:"<?php echo URL ?>customer2/statementSearch",
				  method:"POST",
				  data:{ed:txt,sd:sd,custid:custid},
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
		  var custid = $('#custid').val();
		  if(txt != '')
		  {
			  $.ajax({
				  url:"<?php echo URL ?>customer2/statementSearch",
				  method:"POST",
				  data:{sd:txt,ed:ed,custid:custid},
				  dataType:"text",
				  success:function(data){
					    $("#view_stock_body").html(data);
				  }
			  });
			  
		  }
	  });
	
	
                        });
</script>