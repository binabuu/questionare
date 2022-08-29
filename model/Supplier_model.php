<?php 
class Supplier_model extends Model{
	
	
	public function __construct(){
		
		parent::__construct();
	}


	function addSupplier(){
		if(!empty($_POST['fn'])){
		$data = array();
		$data['fname'] = strip_tags($_POST['fn']);
		$data['loc'] = strip_tags($_POST['loc']);
		$data['status'] = "active";

		
	$this->db->insert('supplier',array('supname'=>$data['fname'],'location'=>$data['loc'],
	'status'=>$data['status']));

	$stm = $this->db->prepare("select supId from supplier where supId = (select max(supId) from supplier)");
		$stm->execute();
		$row = $stm->fetch();

		$this->db->insert('accont2',array('balance'=>0,'supId'=>$row['supId']));
		
		echo "Registered Successfull";
		
	
		Session::init();
		$id = Session::get('id');
		$action ="Add Staff";
		$this->db->insert('log' ,array('sid'=>$id,'Action'=>$action));
		 
		}else{
			echo "empty";
		}
		
	}
	
	
	function viewSupplierList(){
		$stm = $this->db->prepare("select s.supId,supname,location  from supplier s 
		where status = 'active' order by supname" );
		$stm->execute();
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Supplier</th><th>Location</th><th>Balance</th><th>Action</th></tr>';

	$i = 1;
	$summ = 0;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
		$sid = $row['supId'];
		$stms = $this->db->prepare("select supp_account_id,balance from supplier_account where 
		suppid = '$sid' order by supp_account_id desc limit 1");
		$stms->execute();
		$rows = $stms->fetch();

	echo '<tr  class="w3-hover-teal">
	<td>'.$i.'</td><td>'. $row['supname'].'</td><td>'.$row['location'].'</td>
	<td><b>'.number_format($rows['balance']).'</b></td>
	<td>
	<a  class="remove" href="'.URL.'supplier/viewAccount/'.$row['supId'].'" > View Account </a>
	<a  class="remove" href="'.URL.'supplier/pay/'.$row['supId'].'" > Pay </a>
	<a  class="button" href="'.URL.'supplier/editSupplier/'.$row['supId'].'"> Edit   </a>
	    <a  class="remove" href="'.URL.'supplier/sure/'.$row['supId'].'" > Remove </a>
	    
	  </td>
	</td>
	</tr>'; 
	$summ = $summ+$rows['balance'];
	$i++;
	}
	echo '<tr  class="w3-hover-teal">
	<td></td><td></td><td></td>
	<td> <b> '.number_format($summ).'</b> </td>
	
	</tr>'; 
	echo '</table></div>';
	
	}
	
	function supplierSearch(){
		$fname = $_POST['search'];
		$stm = $this->db->prepare("select s.supId,supname,location from supplier s  
		where supname like '%$fname%' and status = 'active' order by supname" );
		$stm->execute();
	echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Supplier</th><th>Location</th><th>Balance</th><th>Action</th></tr>';

	$i = 1;
	$summ = 0;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
		$sid = $row['supId'];
		$stms = $this->db->prepare("select supp_account_id,balance from supplier_account where 
		suppid = '$sid' order by supp_account_id desc limit 1");
		$stms->execute();
		$rows = $stms->fetch();

	echo '<tr  class="w3-hover-teal">
	<td>'.$i.'</td><td>'. $row['supname'].'</td><td>'.$row['location'].'</td><td><b>'.number_format($rows['balance']).'</b></td>
	<td>
	<a  class="remove" href="'.URL.'supplier/viewAccount/'.$row['supId'].'" > View Account </a>
	<a  class="remove" href="'.URL.'supplier/pay/'.$row['supId'].'" > Pay </a>
	<a  class="button" href="'.URL.'supplier/editSupplier/'.$row['supId'].'"> Edit   </a>
	    <a  class="remove" href="'.URL.'supplier/sure/'.$row['supId'].'" > Remove </a>
	    
	  </td>
	</td>
	</tr>'; 
	$summ = $summ+$rows['balance'];
	$i++;
	}
	echo '<tr  class="w3-hover-teal">
	<td></td><td></td><td></td>
	<td> <b> '.number_format($summ).'</b> </td>
	
	</tr>'; 
	echo '</table></div>';
	
	}
	
	function payList($id = false){
	$stm = $this->db->prepare("select amount,DATE_FORMAT(pdate,'%d-%m-%Y') as pdate from payment2 where supId = '$id'" );
		$stm->execute();
		$count = $stm->rowCount();
		
		$stm1 = $this->db->prepare("select sum(amount) as summ from payment2 where supId = '$id'" );
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
	<td>'.$i.'</td><td>'. number_format($row['amount']).'</td><td>'.$row['pdate'].'</td></tr>'; 
	$i++;
	}
	echo '<tr><td><b>Total</b></td><td><b>'.number_format($row1['summ']).'</b></td>	<td></td>		</tr>';
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
		
		$stm = $this->db->prepare("select supp_account_id,balance from supplier_account where
		 suppid = '$cid' order by supp_account_id desc limit 1");
		$stm->execute();
		$row = $stm->fetch();
		$supId = $row['supp_account_id'];
		$count = $stm->rowCount();
		
		if($count == 1){
		$bl = $row['balance'];
		$newbalance = $bl - $amount;
		$this->db->insert('supplier_account' ,array('transactiondate'=>$today,'description'=>$data['desc'],
		'debit'=>0,'credit'=>$amount,'balance'=>$newbalance,'suppid'=>$cid));

		}else{
			$this->db->insert('supplier_account' ,array('transactiondate'=>$today,'description'=>$data['desc'],
			'debit'=>0,'credit'=>$amount,'balance'=>$total,'suppid'=>$cid));
		}
		 header('location:' .URL. 'supplier/viewAccount/'.$cid);
		}else{
			echo "empty";
		}
	}
	
	
	function editSupplier($id = false){
		$stm = $this->db->prepare("select supId,supname,location from supplier where supId = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function Supplier($id = false){
		$stm = $this->db->prepare("select ss.supId,supname,location,sid2 from supplier s join stock2 ss on s.supId = ss.supId where sid2 = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function accSupplier($id = false){
		$stm = $this->db->prepare("select supId,supname,location from supplier where supId = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function lastDayInfo($id = false){
		
		$stm = $this->db->prepare("select ss.supId,bname,stockin,buyprice, sdate from supplier s join stock2 ss on s.supId = ss.supId join 
		bidhaa b on b.bid = ss.bid where sid2 = '$id'" );
		$stm->execute();
		
	
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th></th><th>S/N</th><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>';
	$total =0;
	$i = 1;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td></td><td>'.$i.'</td><td>'.$row['bname'].'</td><td>	'.$row['stockin'].'  </td>
	<td>'. number_format($row['buyprice']).'</td>
		<td>'.number_format($row['stockin'] * $row['buyprice']).'</td>
	</tr>'; 
	$total = $total + ($row['stockin']* $row['buyprice']);
	$i++;
	}
	echo '<tr><td colspan ="4"></td><td><b>Total</b></td>';
				echo '<td><b>'; 
				if(isset($total)) echo number_format($total) ;
				echo '</b></td>
				</tr>
	</table></div>';
	}
	
	
	function viewDays($id = false){
		$stm = $this->db->prepare("select DATE_FORMAT(sdate,'%d-%m-%Y') as sdate,sid2,stockin,stockinprice as 
		buyprice,bname from stock2 s join bidhaa b on b.bid = s.bid  where supId = '$id' and type = 'credit' 
		order by sdate desc" );
		$stm->execute();
		
		$stm1 = $this->db->prepare("select balance from accont2 where supId = '$id' ");
		$stm1->execute();
		$row1 = $stm1->fetch();
		$balance = $row1['balance'];
		
		echo '<div class="w3-responsive">
	<table style="width:100%" border="0">
	<tr><td width="10%"><a class="button">Balance:  </a>'." ".number_format($balance).'</td><tr>
	</table>
	</div>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>Date Orders</th><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>';
	$i = 1;
	$summ = 0;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td> '.$row['sdate'].'</td><td>'.$row['bname'].'</td><td>'.number_format($row['stockin']).'</td>
	<td>'.number_format($row['buyprice']).'</td><td><b>'.number_format($row['stockin'] * $row['buyprice']).'</b></td>
	
	</td>
	</tr>'; 
	$summ = $summ + ($row['stockin'] * $row['buyprice']);
	$i++;
	}
	echo '<tr  class="w3-hover-teal">
	<td> </td><td></td><td></td>
	<td></td><td><b>'.number_format($summ).'</b></td>
	</td>
	</tr>';
	echo '</table></div>';
		
	}
	
	function saveSupplier(){
		if(!empty($_POST['fn']) ){
		$data = array();
		$data['fname'] = strip_tags($_POST['fn']);
		$data['loc'] = strip_tags($_POST['loc']);

		$sid = $_POST['sid2'];
		
		$this->db->update('supplier' ,array('supname'=>$data['fname'],'location'=>$data['loc']),"supId = '$sid'");
		
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
			$this->db->update('supplier' ,array('status'=>$status),"supId = '$id'") ;
			header('location:' .URL. 'supplier/viewSupplier');
			Session::init();
		$id = Session::get('id');
		$action ="Remove Staff";
		$this->db->insert('log' ,array('staffID'=>$id,'Action'=>$action));
	
		
	  }

	function statement($id = false){
		$stm = $this->db->prepare("select transactiondate,description,debit,credit,balance from supplier_account
		where suppid = '$id' order by supp_account_id asc" );
		$stm->execute();
						
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>Transaction Date</th><th>Description</th><th>Debit</th><th>Credit</th><th>Balance</th></tr>';
	
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td>'.$row['transactiondate'].'</td><td>'.$row['description'].'</td><td>'. number_format($row['debit']).'</td>
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
   
   
  	 $stm = $this->db->prepare("select transactiondate,description,debit,credit,balance from supplier_account
	 where suppid = '$custid' and DATE(transactiondate) between '$sd' and '$ed'  order by supp_account_id asc" );
	 $stm->execute();
	 $count = $stm->rowCount();
			   
	   $_SESSION['startSession'] = $sd;
	   $_SESSION['endSession'] = $ed;
	   $_SESSION['custid'] = $custid;

	   
	 if($count > 0){
		   echo ' <a href="'.URL.'supplier/printStatement/'.$custid.'" class="button" target ="_blank">Print</a>';
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

   $stm = $this->db->prepare("select transactiondate,description,debit,credit,balance from supplier_account
 where suppid = '$custid' and DATE(transactiondate) between '$sd' and '$ed'  order by supp_account_id asc" );
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