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
  <h2 >View Supplier</h2>
</div>

 <a href="<?php echo URL?>customer" class="button">Add Supplier</a>
	<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Location</th><th>Action</th></tr>
	<?php 
	$i = 1;
	foreach($this->customer as $key => $row){?>
	<tr  class="del<?php echo $row['cid']?> w3-hover-teal">
	<td><?php echo $i?></td><td><?php echo $row['fname']?></td><td><?php echo $row['mname']?></td><td><?php echo $row['lname']?></td>
	<td><?php echo $row['location']?></td>
	<td>
	<a  class="button" href="<?php echo URL?>customer/editCustomer/<?php echo $row['cid']?>"> Edit   </a>
	    <a  class="remove" id ="<?php echo $row['cid']?>" > Remove </a>
	  </td>
	</td>
	</tr>
	<?php 
	$i++;
	} ?>
	</table>
	</div>
 </div> 


</div>
<?php 
//include 'view/footer.php';
?>
</body>

</html>
<script>
 $(".remove").click(function(){
	   var id = $(this).attr("id");
	   var un = id;
	   	if(confirm("Are you sure you want to remove the Supplier " )){
	   $.ajax({
			type: 'POST',
			url: '<?php echo URL?>customer/deactivate/'+id ,
			data: ({id: id}),
			beforeSend: function() {
				$(".del"+id).css("background-color", "#616161");
			},
			success: function() {
				$(".del"+id).fadeOut('slow'); 
			}
		});
		}else{
			return false;}
    });
	</script>
