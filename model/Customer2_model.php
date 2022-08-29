<?php 
class Customer2_model extends Model{
	
	
	public function __construct(){
		
		parent::__construct();
	}


	function addCustomer(){
		if(!empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['addr'])){
		$data = array();
		$data['fname'] = strip_tags($_POST['fn']);
		$data['mname'] = strip_tags($_POST['mn']);
		$data['lname'] = strip_tags($_POST['ln']);
		$data['addr'] = strip_tags($_POST['addr']);
		$data['status'] = "active";
		
		
	$this->db->insert('customer2' ,array('fname'=>$data['fname'],'mname'=>$data['mname'],'lname'=>$data['lname'],'location'=>$data['addr'],'status'=>$data['status']));
	
	$stm = $this->db->prepare("select cid from customer2 where cid = (select max(cid) from customer2)");
		$stm->execute();
		$row = $stm->fetch();

		$this->db->insert('account',array('balance'=>0,'cid'=>$row['cid']));

	echo "Registered Successfull";
		
		Session::init();
		$id = Session::get('id');
		$action ="Add Staff";
		$this->db->insert('log' ,array('sid'=>$id,'Action'=>$action));
		 
		}else{
			echo "empty";
		}
		
	}
	
	
	function viewCustomerList(){
		$stm = $this->db->prepare("select cid,fname,mname,mname,lname,location from customer2 
		where status = 'active' order by fname" );
		$stm->execute();
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Location</th><th>Balance</th><th>Action</th></tr>';

	$i = 1;
	$sum = 0;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
		$cid = $row['cid'];
		$stms = $this->db->prepare("select cust_account_id,balance from customer_account where 
		custid = '$cid' order by cust_account_id desc limit 1");
		$stms->execute();
		$rows = $stms->fetch();

	echo '<tr  class="w3-hover-teal">
	<td>'.$i.'</td><td>'. $row['fname'].'</td><td>'.$row['mname'].'</td><td>'. $row['lname'].'</td>
	<td>'.$row['location'].'</td><td><b>'.number_format($rows['balance']).'</b></td>
	<td>
	<a  class="remove" href="'.URL.'customer2/viewAccount/'.$row['cid'].'" > View Account </a>
	<a  class="remove" href="'.URL.'customer2/pay/'.$row['cid'].'" > Pay </a>
	<a  class="button" href="'.URL.'customer2/editCustomer/'.$row['cid'].'"> Edit   </a>
	    <a  class="remove" href="'.URL.'customer2/sure/'.$row['cid'].'" > Remove </a>
	    
	  </td>
	</td>
	</tr>'; 
	$sum = $sum + $rows['balance'];
	$i++;
	}
	echo '<tr><td colspan="5"></td><td><b>'.number_format($sum).'</b></td></tr>';
	echo '</table></div>';
	
	}
	
	function customerSearch(){
		$fname = $_POST['search'];
		$stm = $this->db->prepare("select cid,fname,mname,mname,lname,location from customer2 
		where status = 'active' and fname like '%$fname%' order by fname" );
		$stm->execute();
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Location</th><th>Balance</th><th>Action</th></tr>';

	$i = 1;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
		$cid = $row['cid'];
		$stms = $this->db->prepare("select cust_account_id,balance from customer_account where 
		custid = '$cid' order by cust_account_id desc limit 1");
		$stms->execute();
		$rows = $stms->fetch();

	echo '<tr  class="w3-hover-teal">
	<td>'.$i.'</td><td>'. $row['fname'].'</td><td>'.$row['mname'].'</td><td>'. $row['lname'].'</td>
	<td>'.$row['location'].'</td><td><b>'.number_format($rows['balance']).'</b></td>
	<td>
	  <a  class="remove" href="'.URL.'customer2/viewAccount/'.$row['cid'].'" > View Account </a>
	  	<a  class="remove" href="'.URL.'customer2/pay/'.$row['cid'].'" > Pay </a>
	<a  class="button" href="'.URL.'customer2/editCustomer/'.$row['cid'].'"> Edit   </a>
		
	   <a  class="remove" href="'.URL.'customer2/sure/'.$row['cid'].'" > Remove </a>

	  </td>
	</td>
	</tr>'; 
	$i++;
	}
	echo '</table></div>';
	
	}
	
	function payList($id = false){
	$stm = $this->db->prepare("select amount,DATE_FORMAT(pdate,'%d-%m-%Y') as pdate from payment where cid = '$id'" );
		$stm->execute();
		$count = $stm->rowCount();
		
		$stm1 = $this->db->prepare("select sum(amount) as summ from payment where cid = '$id'" );
		$stm1->execute();
		$row1 = $stm1->fetch();
		
		if($count > 0){
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Amount</th><th>Date</th></tr>';
	$total = 0;
	$i = 1;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td>'.$i.'</td><td>'. $row['amount'].'</td><td>'.$row['pdate'].'</td></tr>'; 
	$i++;
	}
	echo '<tr><td><b>Total</b></td><td><b>'.$row1['summ'].'</b></td>	<td></td>		</tr>';
	echo '</table></div>';
		}else{
			echo "No Payment";
		}
	}
	
	function insertPayment(){
		if(!empty($_POST['pay']) ){
		$data = array();
		$data['pay'] = strip_tags($_POST['pay']);
		$data['cid'] = strip_tags($_POST['cid']);
		$data['desc'] = strip_tags($_POST['desc']);
		$cid = $data['cid'];
		$amount = $data['pay'];
		$today = date('Y-m-d');
	
		$stm = $this->db->prepare("select cust_account_id,balance from customer_account where custid = '$cid' order by
		cust_account_id desc limit 1");
		$stm->execute();
		$row = $stm->fetch();
		$accId = $row['cust_account_id'];
		$count = $stm->rowCount();
		
		if($count == 1){
		$bl = $row['balance'];
		$newbalance = $bl - $amount;
		$this->db->insert('customer_account' ,array('transactiondate'=>$today,'description'=>$data['desc'],
		'debit'=>0,'credit'=>$amount,'balance'=>$newbalance,'custid'=>$cid));

		}else{
			$this->db->insert('customer_account' ,array('transactiondate'=>$today,'description'=>$data['desc'],
			'debit'=>0,'credit'=>$amount,'balance'=>$total,'custid'=>$cid));
		}
		 header('location:' .URL. 'customer2/viewAccount/'.$cid);
		}else{
			echo "empty";
		}
	}
	
	
	function editCustomer($id = false){
		$stm = $this->db->prepare("select cid,fname,mname,lname,location from customer2 where cid = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function accCustomer($id = false){
		$stm = $this->db->prepare("select cid,fname,mname,lname,location from customer2 where cid = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function accCustomer2($id = false){
		$stm = $this->db->prepare("select c.cid,fname,mname,lname,location,oid from customer2 c join orders o on c.cid = o.customerId where oid = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function lastDayInfo($id = false){
		$stm = $this->db->prepare("select cid,bname,quantity,price, odate from orders o join order_details od on o.oid = od.oid join 
		bidhaa b on b.bid = od.bid where customerId = '13'" );
		$stm->execute();
		
		$stm1 = $this->db->prepare("select DATE_FORMAT(odate,'%d-%m-%Y') as odate from orders o join order_details od on o.oid = od.oid join 
		bidhaa b on b.bid = od.bid where od.oid = '$id'" );
		$stm1->execute();
		$row2 = $stm1->fetch();
				
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>'.$row2['odate'].'</th><th>S/N</th><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>';
	$total =0;
	$i = 1;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td></td><td>'.$i.'</td><td>'.$row['bname'].'</td><td>	'.$row['quantity'].'  </td>
	<td>'. number_format($row['price']).'</td>
		<td>'.number_format($row['quantity'] * $row['price']).'</td>
	</tr>'; 
	$total = $total + ($row['quantity']* $row['price']);
	$i++;
	}
	echo '<tr><td colspan ="4"></td><td><b>Total</b></td>';
				echo '<td><b>'; 
				if(isset($total)) echo number_format($total) ;
				echo '</b></td>
				</tr>
	</table></div>';
	}

	 function getOinfo($id = false){
		return $id;
	}

	
	function orderInfos($id = false){
		$stm1 = $this->db->prepare("select o.oid,DATE_FORMAT(odate,'%d-%m-%Y') as odate,bname,price,quantity 
		from orders o join order_details od on o.oid = od.oid join	bidhaa b on b.bid = od.bid 
		where od.oid = '$id'" );
		$stm1->execute();
		//$row = $stm1->fetch();
				
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th></th><th>S/N</th><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>';
	$total =0;
	$i = 1;
	while($row = $stm1->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td></td><td>'.$i.'</td><td>'.$row['bname'].'</td><td>	'.$row['quantity'].'  </td>
	<td>'. number_format($row['price']).'</td>
		<td>'.number_format($row['quantity'] * $row['price']).'</td>
	</tr>'; 
	$total = $total + ($row['quantity']* $row['price']);
	$i++;
	}
	echo '<tr><td colspan ="4"></td><td><b>Total</b></td>';
				echo '<td><b>'; 
				if(isset($total)) echo number_format($total) ;
				echo '</b></td>
				</tr>
	</table></div>';
		
	}
	
	function saveCustomer(){
		if(!empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['addr'])){
		$data = array();
		$data['fname'] = strip_tags($_POST['fn']);
		$data['mname'] = strip_tags($_POST['mn']);
		$data['lname'] = strip_tags($_POST['ln']);
		$data['addr'] = strip_tags($_POST['addr']);
		
		$sid = $_POST['sid2'];
		
		$this->db->update('customer2' ,array('fname'=>$data['fname'],'mname'=>$data['mname'],'lname'=>$data['lname'],'location'=>$data['addr']),"cid = '$sid'");
		
	echo "Saved successfull";
	
	Session::init();
		$id = Session::get('id');
		$action ="Change Staff";
		$this->db->insert('log' ,array('staffID'=>$id,'Action'=>$action));
	
		 }else{
			 echo "emtp";
		 }
		 	
	}
	
	function deactivate($id = false){
		   $status = "inactive";
			$this->db->update('customer2' ,array('status'=>$status),"cid = '$id'") ;
			header('location:' .URL. 'customer2/viewCustomer');
			Session::init();
		$id = Session::get('id');
		$action ="Remove Staff";
		$this->db->insert('log' ,array('staffID'=>$id,'Action'=>$action));
		
	  }


	  function statement($id = false){
		$stm = $this->db->prepare("select transactiondate,description,debit,credit,balance,oid from customer_account
		where custid = '$id' order by cust_account_id asc" );
		$stm->execute();
						
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>Transaction Date</th><th>Description</th><th>Debit</th><th>Credit</th><th>Balance</th></tr>';
	
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td><a  class="remove" href="'.URL.'customer2/orderInfo/'.$row['oid'].'" >'.$row['transactiondate'].'</a></td>
	<td>'.$row['description'].'</td><td>'. number_format($row['debit']).'</td>
	<td>'. number_format($row['credit']).' </td><td>'. number_format($row['balance']).'</td>
	</tr>'; 

	}
	echo '</table></div>';
	}
	


	  function statementSearch(){
		@session_start();
		
  $sd = $_POST['sd'];
  $ed = $_POST['ed'];
  $custid = $_POST['custid'];
   
   
  	 $stm = $this->db->prepare("select transactiondate,description,debit,credit,balance from customer_account
	 where custid = '$custid' and DATE(transactiondate) between '$sd' and '$ed'  order by cust_account_id asc" );
	 $stm->execute();
	 $count = $stm->rowCount();
			   
	   $_SESSION['startSession'] = $sd;
	   $_SESSION['endSession'] = $ed;
	   $_SESSION['custid'] = $custid;

	   
	 if($count > 0){
		   echo ' <a href="'.URL.'customer2/printStatement/'.$custid.'" class="button" target ="_blank">Print</a>';
	 echo '<div class="w3-responsive">
	 <table class="w3-table-all">
	<tr ><th>Transaction Date</th><th>Description</th><th>Debit</th><th>Credit</th><th>Balance</th></tr>';
	
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td>'.$row['transactiondate'].'</td><td>'.$row['description'].'</td><td>'. number_format($row['debit']).'</td>
	<td>'. number_format($row['credit']).' </td><td>'. number_format($row['balance']).'</td>
	</tr>'; 

	}
echo '</table>
 </div>';
 }else{
		 
		 echo "No Record ";
	 }
  }


  function printSt(){
	@session_start();
	$sd = $_SESSION['startSession'] ;
	$ed = $_SESSION['endSession'] ;
	$custid = $_SESSION['custid'] ;

   $stm = $this->db->prepare("select transactiondate,description,debit,credit,balance from customer_account
 where custid = '$custid' and DATE(transactiondate) between '$sd' and '$ed'  order by cust_account_id asc" );
 $stm->execute();
 $count = $stm->rowCount();
		   
     
 if($count > 0){
	 
 echo '<div class="w3-responsive">
 <table class="w3-table-all">
<tr ><th>Transaction Date</th><th>Description</th><th>Debit</th><th>Credit</th><th>Balance</th></tr>';

while($row = $stm->fetch(PDO::FETCH_ASSOC)){
echo '<tr  class="w3-hover-teal">
<td>'.$row['transactiondate'].'</td><td>'.$row['description'].'</td><td>'. number_format($row['debit']).'</td>
<td>'. number_format($row['credit']).' </td><td>'. number_format($row['balance']).'</td>
</tr>'; 

}
echo '</table>
</div>';
}else{
	 
	 echo "No Record ";
 }
}
	  

		
	
}