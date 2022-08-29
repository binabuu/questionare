<?php 
class Home_model extends Model{
	
	
	public function __construct(){
		
		parent::__construct();
	}


	function productTaken(){
		
		$stm = $this->db->prepare("select c.fname,c.lname,curdate() as today,c.location,cc.fname as first,cc.lname as last,cc.location as loc,bname,maelezo,quantity 
		from customer c join orders o on c.cid = o.cid	join customer2 cc on cc.cid= o.customerId join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid 
		where odate = curdate() and b.status = 'active'" );
	$stm->execute();
	$count = $stm->rowCount();
		if($count > 0){
			
				echo ' <a href="'.URL.'pdf/stockout" class="button" target ="_blank">Print</a>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Supplier</th><th>Customer</th><th>Product</th><th>Quantity</th></tr>';
	$i = 1;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr class="w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['fname']." ".$row['lname'].", ".$row['location'].'</td>
	<td>'.$row['first']." ".$row['last'].", ".$row['loc'].'</td>
	<td>'.$row['bname']." (".$row['maelezo'].')</td>
	<td>'.$row['quantity'].' </td>
	</tr>';
	$i++;
	}
	
	echo '</table></div>';
		}else{
			
			echo "No Record Today";
		}
	}
	
	 function customerSearch(){
		 $cn = $_POST['search'];
		$stm = $this->db->prepare("select c.fname,c.lname,c.location,bname,maelezo,quantity,cc.fname as first,cc.lname as last,cc.location as loc
		from customer c join orders o on c.cid = o.cid	join customer2 cc on cc.cid = o.customerId join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid
		where odate = curdate() and b.status = 'active' and c.fname like '%$cn%'" );
	$stm->execute();
		$count = $stm->rowCount();
		if($count > 0){
			@session_start();
		  $_SESSION['customerSession'] = $cn;
		  
		  echo ' <a href="'.URL.'pdf/customerSearch" class="button" target ="_blank">Print</a>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Supplier</th><th>Customer</th><th>Product</th><th>Quantity</th></tr>';
	$i = 1;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr class="w3-hover-teal" >
	<td>'.$i.'</td><td>'.$row['fname']." ".$row['lname'].", ".$row['location'].'</td>
	<td>'.$row['first']." ".$row['last'].", ".$row['loc'].'</td>
	<td>'.$row['bname']." (".$row['maelezo'].')</td>
	<td>'.$row['quantity'].' </td>
	</tr>';
	$i++;
	}
	
	echo '</table></div>';
	}else{
			
			echo "No Record ";
		}
	 }
	 
	  function productSearch(){
		 $pn = $_POST['search2'];
		$stm = $this->db->prepare("select c.fname,c.lname,c.location,bname,maelezo,quantity,cc.fname as first,cc.lname as last,cc.location as loc
		from customer c join orders o on c.cid = o.cid	join customer2 cc on cc.cid = o.customerId join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid 
		where odate = curdate() and b.status = 'active' and bname like '%$pn%'" );
	$stm->execute();
		$count = $stm->rowCount();
		if($count > 0){
			
			@session_start();
		  $_SESSION['bidhaaSession'] = $pn;
		  
		   echo ' <a href="'.URL.'pdf/bidhaaSearch" class="button" target ="_blank">Print</a>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Supplier</th><th>Customer</th><th>Product</th><th>Quantity</th></tr>';
	$i = 1;
	$total = 0;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr class="w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['fname']." ".$row['lname'].", ".$row['location'].'</td>
		<td>'.$row['first']." ".$row['last'].", ".$row['loc'].'</td>
	<td>'.$row['bname']." (".$row['maelezo'].')</td>
	<td>'.$row['quantity'].' </td>
	</tr>';
	$total = $total + $row['quantity'];
	$i++;
	}
	echo '<tr>
				<td colspan ="3"></td>
				<td><b>Total</b></td>
				<td><b>';
				  if(isset($total)){ echo number_format($total); }
				echo '</b></td>
			
				
				</tr>
	
	</table></div>';
	}else{
			
			echo "No Record ";
		}
	 }
	 
	  function periodicSearch(){
		   @session_start();
		   
	 $sd = $_POST['sd'];
	 $ed = $_POST['ed'];
	 if(!empty($_POST['bname'])){
		$bname = $_POST['bname'];
	}else{
		$bname = 0;
	}
	 
	 if($bname == "0"){
		$stm = $this->db->prepare("select c.fname,c.lname,c.location,bname,maelezo,quantity,DATE_FORMAT(odate,'%d-%m-%Y') as odate ,cc.fname as first,
		cc.lname as last,cc.location as loc from customer c join orders o on c.cid = o.cid join customer2 cc on cc.cid = o.customerId 
		join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid 
		where  b.status = 'active' and odate between '$sd' and '$ed' " );
		$stm->execute();
		$count = $stm->rowCount();
				  $_SESSION['bnSession'] = $bname;
	 }elseif($bname != "0"){
	 $stm = $this->db->prepare("select c.fname,c.lname,c.location,bname,maelezo,quantity,DATE_FORMAT(odate,'%d-%m-%Y') as odate,cc.fname as first,
	 cc.lname as last,cc.location as loc from customer c join orders o on c.cid = o.cid join customer2 cc on cc.cid = o.customerId 
		join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid where  b.status = 'active' and bname like '%$bname%' " );
		$stm->execute();
		$count = $stm->rowCount();
				  $_SESSION['bnSession'] = $bname;
		 
	 }
	 
	
		  $_SESSION['startSession'] = $sd;
		  $_SESSION['endSession'] = $ed;

		  
		if($count > 0){
			  echo ' <a href="'.URL.'pdf/periodicStock" class="button" target ="_blank">Print</a>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Supplier</th><th>Customer</th><th>Product</th><th>Quantity</th><th>Date</th></tr>';
	$i = 1;
	$total = 0;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr class="w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['fname']." ".$row['lname'].", ".$row['location'].'</td>
	<td>'.$row['first']." ".$row['last'].", ".$row['loc'].'</td>
	<td>'.$row['bname']." (".$row['maelezo'].')</td>
	<td>'.$row['quantity'].' </td>
	<td>'.$row['odate'].' </td>
	</tr>';
	$total = $total + $row['quantity'];
	$i++;
	}
	echo '<tr>
				<td colspan ="3"></td>
				<td><b>Total</b></td>
				<td><b>';
				  if(isset($total)){ echo number_format($total); }
				echo '</b></td>
				<td></td>
				
				
				</tr>
	
	</table></div>';
	}else{
			
			echo "No Record ";
		}
	 }
	 
	 function stockInSearch(){
		    @session_start();
	 $sd = $_POST['sd'];
	 $ed = $_POST['ed'];
	  if(!empty($_POST['bname'])){
		$bname = $_POST['bname'];
	}else{
		$bname = 0;
	}
	
		if($bname == "0"){
		$stm = $this->db->prepare("select bname,maelezo,stockin,DATE_FORMAT(sdate,'%d-%m-%Y')as sdate from bidhaa b join stock2 s on s.bid = b.bid
		where sdate between '$sd' and '$ed' order by bname" );
		$stm->execute();
		$_SESSION['bnSession1'] = $bname;
		}elseif($bname != "0"){
		$stm = $this->db->prepare("select bname,maelezo,stockin,DATE_FORMAT(sdate,'%d-%m-%Y')as sdate from bidhaa b join stock2 s on s.bid = b.bid
		where bname like '%$bname%' order by bname" );
		$stm->execute();
		$_SESSION['bnSession1'] = $bname;
			
		}
		$count = $stm->rowCount();
		
		 $_SESSION['startSession1'] = $sd;
		  $_SESSION['endSession1'] = $ed;
		  
		if($count > 0){
			  echo ' <a href="'.URL.'pdf/stockinSearch" class="button" target ="_blank">Print</a>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Product Name</th><th>Description</th><th>Stock In</th><th>Date</th></tr>';
	$i = 1;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr class="w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['bname'].'</td><td>'.$row['maelezo'].'</td><td>'.$row['stockin'].'</td><td>'.$row['sdate'].'</td>
	</tr>';
	$i++;
	}
		
	echo '</table></div>';
	}else{
			
			echo "No Record ";
		}
	 }
	 
	 
	 function stockin2(){
		 $stm = $this->db->prepare("select bname,maelezo,stockin from bidhaa b join stock2 s on s.bid = b.bid where sdate =curdate() order by bname" );
	$stm->execute();
		$count = $stm->rowCount();
		if($count > 0){
			
			  echo ' <a href="'.URL.'pdf/stockin2" class="button" target ="_blank">Print</a>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Product Name</th><th>Description</th><th>Stock In</th></tr>';
	$i = 1;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr class="w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['bname'].'</td><td>'.$row['maelezo'].'</td><td>'.$row['stockin'].'</td>
	</tr>';
	$i++;
	}
		
	echo '</table></div>';
	}else{
			
			echo "No Record ";
		}
	 }
	 
	  function deleteAll(){
		$stm = $this->db->prepare("delete  from customer " );
	$stm->execute();
	
	$stm = $this->db->prepare("delete  from bidhaa " );
	$stm->execute();
	
	$stm = $this->db->prepare("delete  from orders " );
	$stm->execute();
	
	$stm = $this->db->prepare("delete  from order_details " );
	$stm->execute();
	
	$stm = $this->db->prepare("delete  from stock " );
	$stm->execute();
	
	$stm = $this->db->prepare("delete  from stock2 " );
	$stm->execute();
	
		header('location:' .URL. 'home');
	 }
	
	
	
	
		
	
}