<?php 
class Stock_model extends Model{
	
	
	public function __construct(){
		parent::__construct();
	}


	function addStock(){
		if(!empty($_POST['pro']) && !empty($_POST['si']) ){
		$data = array();
		$data['pro'] = strip_tags($_POST['pro']);
		$data['si'] = strip_tags($_POST['si']);
		$data['price'] = strip_tags($_POST['price']);
		$data['supl'] = strip_tags($_POST['supl']);
		$data['type'] = strip_tags($_POST['type']);
		$bid = $data['pro'];
		$sup = $data['supl'];
			
			$stm = $this->db->prepare("select s.bid,bname from stock s join bidhaa b on b.bid = s.bid
			 where s.bid = '$bid'" );
			$stm->execute();
			$row = $stm->fetch();
			$count = $stm->rowCount();
			//$count = 0;
			
			if($count < 1){
				$stm1 = $this->db->prepare("select bid,bname from bidhaa where bid = '$bid'" );
			   $stm1->execute();
			   $row1 = $stm1->fetch();

				$description = $row1['bname']." ".$data['si']." * ".$data['price'];
			
		$this->db->insert('stock' ,array('bid'=>$data['pro'],'stockin'=>$data['si'],'stockout'=>0));
		
	//	$this->db->update('bidhaa' ,array('buyprice'=>$data['price']),"bid = '$bid'");
		
		$today = date('Y-m-d');
		$this->db->insert('stock2' ,array('bid'=>$data['pro'],'stockin'=>$data['si'],'sdate'=>$today,
		'supId'=>$data['supl'],'type'=>$data['type'],'stockinprice'=>$data['price']));
	
		$stm1 = $this->db->prepare("select (stockin * stockinprice) as total,type from stock2 s join
		 bidhaa b on s.bid = b.bid 	where sid2 = (select max(sid2) from stock2) ");
		$stm1->execute();
		$row1 = $stm1->fetch();
		$total =  $row1['total'];
		$type = $row1['type'];
		
		if($type == 'credit'){
		$sup = $data['supl'];
		$sup = $data['supl'];

		$stm = $this->db->prepare("select supp_account_id,balance from supplier_account where suppid = '$sup' order by
		supp_account_id desc limit 1");
		$stm->execute();
		$row = $stm->fetch();
		$suppId = $row['supp_account_id'];
		$count = $stm->rowCount();


		if($count == 1){
			$bl = $row['balance'];
			$newbalance = $bl + $total;
			$this->db->insert('supplier_account' ,array('transactiondate'=>$today,'description'=>$description,
			'debit'=>$total,'credit'=>0,'balance'=>$newbalance,'suppid'=>$sup));
			}else{
				$this->db->insert('supplier_account' ,array('transactiondate'=>$today,'description'=>$description,
				'debit'=>$total,'credit'=>0,'balance'=>$total,'suppid'=>$sup));
	
			}
		
		}
		
		header('location:' .URL. 'stock/viewStock');
		
		
			}else{
				 echo '<script type="text/javascript"> alert("item already added");</script>';
				echo '<script>window.location="'.URL.'stock/viewStock"</script>';
			}
		 
		}else{
			echo "empty";
		}
		
	}
	
		function product(){
		
		$stm = $this->db->prepare("select bid,bname,maelezo,sellprice from bidhaa where status = 'active' order by bname" );
			$stm->execute();
			return $stm->fetchAll();
		
	}
	
	function supplier(){
		
		$stm = $this->db->prepare("select supId,supname,location from supplier where status = 'active'
		 order by supname" );
			$stm->execute();
			return $stm->fetchAll();
		
	}

	function product2($id = false){
		
		$stm = $this->db->prepare("select sid,s.bid,bname,maelezo,sellprice from bidhaa  b join stock s on b.bid = s.bid
		 where sid = '$id' and status = 'active'" );
		$stm->execute();
		return $stm->fetch();
		
	}

	function stockList(){
	$stm = $this->db->prepare("select s.bid,sid,bname,maelezo,sellprice,stockin  as stockavailaable 
	 from bidhaa  b join stock s on  b.bid = s.bid 	where b.status= 'active' order by bname" );
	$stm->execute();
	$count = $stm->rowCount();
		if($count > 0){
		
		Session::init();
		$role = Session::get('role');
		if($role == 'boss'){
		echo ' <a href="'.URL.'pdf/stock" class="button" target ="_blank">Print</a>';
		}
		echo '<div class="w3-responsive ">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Product Name</th><th>Description</th>';
	if($role == 'boss'){
	echo '<th>Available Stock</th>';
	}
	echo '<th>Price</th><th>Action</th></tr>';
	$i = 1;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="del'.$row['sid'].' w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['bname'].'</td><td>'.$row['maelezo'].'</td>';
	if($role == 'boss'){
	echo '<td>'.number_format($row['stockavailaable']).'</td>';
	}
	echo '<td>'.number_format($row['sellprice']).'</td>
	<td>
		<a  class="button" href="'.URL.'stock/editStock/'.$row['sid'].'"> Stock In   </a>
	    <a  class="button" href="'.URL.'stock/stockOut/'.$row['sid'].'" > Stock Out </a>
	    <a  class="button" href="'.URL.'stock/returnIn/'.$row['sid'].'" > Return In </a>
	    <a  class="button" href="'.URL.'stock/returnOut/'.$row['sid'].'" > Return Out </a>
	  </td>
	</td>
	</tr>';
	$i++;
	}
	
	echo '</table></div>';
	}else{
		echo "No Records";
	}
	}
	
	function stockSearch(){
		$bn = $_POST['search'];
	$stm = $this->db->prepare("select s.bid,sid,bname,maelezo,stockin as stockavailaable  from bidhaa  b join stock s on  b.bid = s.bid
	where bname like '%$bn%' and b.status = 'active' order by bname" );
		$stm->execute();
		$count = $stm->rowCount();
		if($count > 0){
			@session_start();
		  $_SESSION['bnameSession'] = $bn;
			
		
		Session::init();
		$role = Session::get('role');
		if($role == 'boss'){
		echo ' <a href="'.URL.'pdf/stockSearch" class="button" target ="_blank">Print</a>';
		}
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Product Name</th><th>Description</th>';
	if($role == 'boss'){
	echo '<th>Available Stock</th>';
	}
	echo '<th>Action</th></tr>';
	$i = 1;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="del'.$row['sid'].' w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['bname'].'</td><td>'.$row['maelezo'].'</td>';
	if($role == 'boss'){
	echo '<td>'.$row['stockavailaable'].'</td>';
	}
	echo '<td>
	<a  class="button" href="'.URL.'stock/editStock/'.$row['sid'].'"> Stock In   </a>
	    <a  class="button" href="'.URL.'stock/stockOut/'.$row['sid'].'" > Stock Out </a>
	  </td>
	</td>
	</tr>';
	$i++;
	}
	
	echo '</table></div>';
	}else{
		echo "No Records";
	}
	}
	
	
	function editStock($id = false){
		$stm = $this->db->prepare("select sid,bname  from stock s join bidhaa b on s.bid = b.bid 
		 where sid = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function sendBack(){
		if(!empty($_POST['qn'])){
		$data = array();
		$data['qn'] = strip_tags($_POST['qn']);
		$data['sid'] = strip_tags($_POST['sid']);
		$data['price'] = strip_tags($_POST['price']);
		$bid = $data['sid'];
		
		$stm = $this->db->prepare("select stockin,bid from stock  where sid = '$bid'" );
		$stm->execute();
		$row = $stm->fetch();
		$bname = $row['bid'];
		$si = $row['stockin'];
		$ns = $si + $data['qn'];
		
		$this->db->update('stock' ,array('stockin'=>$ns),"sid = '$bid'");
		
		$today = date('Y-m-d');
		$this->db->insert('returnin' ,array('bid'=>$bname,'quantity'=>$data['qn'],'rdate'=>$today,'price'=>$data['price']));
		header('location:' .URL. 'stock/viewStock');
		
		}
	}
	
	function sendForward(){
		if(!empty($_POST['qn'])){
		$data = array();
		$data['qn'] = strip_tags($_POST['qn']);
		$data['sid'] = strip_tags($_POST['sid']);
		$data['supl'] = strip_tags($_POST['supl']);
		//$data['price'] = strip_tags($_POST['price']);
		$bid = $data['sid'];
		
		$stm = $this->db->prepare("select stockin,bid from stock  where sid = '$bid'" );
		$stm->execute();
		$row = $stm->fetch();
		$bname = $row['bid'];
		$si = $row['stockin'];
		$ns = $si - $data['qn'];
		
		$this->db->update('stock' ,array('stockin'=>$ns),"sid = '$bid'");
		
		$today = date('Y-m-d');
		$this->db->insert('returnout' ,array('bid'=>$bname,'quantity'=>$data['qn'],'rdate'=>$today
		,'supId'=>$data['supl']));
		header('location:' .URL. 'stock/viewStock');
		
		}
	}
	
	function returnBack(){
		$stm = $this->db->prepare("select quantity,DATE_FORMAT(rdate,'%d-%m-%Y') as rdate,bname,price from returnin r join bidhaa b on r.bid = b.bid" );
	$stm->execute();
	$count = $stm->rowCount();
		if($count > 0){
			echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Product</th><th>Quantity</th><th>Price</th><th>Date</th></tr>';
			$i = 1;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['bname'].'</td><td>	'.number_format($row['quantity']).'  </td>
		<td>'.number_format($row['price']).'</td><td>'.$row['rdate'].'</td>
	</tr>'; 
	$i++;
	}
		}else{
			echo "No retuned Stock";
		}
		
		
	}
	
	function returnForward(){
		$stm = $this->db->prepare("select quantity,DATE_FORMAT(rdate,'%d-%m-%Y') as rdate,bname,supname
		 from returnout r join bidhaa b on r.bid = b.bid join supplier s on s.supId = r.supId" );
	$stm->execute();
	$count = $stm->rowCount();
		if($count > 0){
			echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Product</th><th>Quantity</th><th>Supplier</th><th>Date</th></tr>';
			$i = 1;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['bname'].'</td><td>	'.number_format($row['quantity']).'  </td>
		<td>'.$row['supname'].'</td><td>'.$row['rdate'].'</td>
	</tr>'; 
	$i++;
	}
		}else{
			echo "No retuned Stock";
		}
		
		
	}
	
	function updateStock(){
		if(!empty($_POST['si']) ){
		$data = array();
		$data['si'] = strip_tags($_POST['si']);
		$data['supl'] = strip_tags($_POST['supl']);
		$data['type'] = strip_tags($_POST['type']);
		$data['pn'] = strip_tags($_POST['pn']);
			$bid = $_POST['sid'];
			$data['price'] = $_POST['price'];
			$sup = $data['supl'] ;
			$description = $data['pn']." ".$data['si']." * ".$data['price'];
		
		$stm = $this->db->prepare("select stockin,bid from stock  where sid = '$bid'" );
		$stm->execute();
		$row = $stm->fetch();
		$bname = $row['bid'];
		$si = $row['stockin'];
		$ns = $si + $data['si'];
		
		$this->db->update('stock' ,array('stockin'=>$ns),"sid = '$bid'");
		
		//$this->db->update('bidhaa' ,array('buyprice'=>$data['price']),"bid = '$bname'");
		
		$today = date('Y-m-d');
		$this->db->insert('stock2' ,array('bid'=>$bname,'stockin'=>$data['si'],'sdate'=>$today,
		'supId'=>$data['supl'],'type'=>$data['type'],'stockinprice'=>$data['price']));
		
		$stm1 = $this->db->prepare("select (stockin * stockinprice) as total,type from stock2 s join bidhaa b on s.bid = b.bid 
		where sid2 = (select max(sid2) from stock2) ");
		$stm1->execute();
		$row1 = $stm1->fetch();
		$total = $row1['total'];
		$type =  $row1['type'];
		
		if($type == 'credit'){
	
			$stm = $this->db->prepare("select supp_account_id,balance from supplier_account where suppid = '$sup' order by
			supp_account_id desc limit 1");
			$stm->execute();
			$row = $stm->fetch();
			$suppId = $row['supp_account_id'];
			$count = $stm->rowCount();
	
	
			if($count == 1){
				$bl = $row['balance'];
				$newbalance = $bl + $total;
				$this->db->insert('supplier_account' ,array('transactiondate'=>$today,'description'=>$description,
				'debit'=>$total,'credit'=>0,'balance'=>$newbalance,'suppid'=>$sup));
				}else{
					$this->db->insert('supplier_account' ,array('transactiondate'=>$today,'description'=>$description,
					'debit'=>$total,'credit'=>0,'balance'=>$total,'suppid'=>$sup));
		
				}
		}
		header('location:' .URL. 'stock/viewStock');
		
	echo "Saved successfull ";
	
	Session::init();
		$id = Session::get('id');
		$action ="Change Staff";
		$this->db->insert('log' ,array('staffID'=>$id,'Action'=>$action));
	
		 }else{
			 echo "empty";
		 }
		 	
	}
	
	function customer(){
		$stm = $this->db->prepare("select cid,fname,lname,location from customer where status = 'active' " );
		$stm->execute();
		return $stm->fetchAll();
	}
	
	function customer2(){
		$stm = $this->db->prepare("select cid,fname,lname,location from customer2 where status = 'active' " );
		$stm->execute();
		return $stm->fetchAll();
	}
	
	function sendtoCart(){
		@session_start();
		if(!empty($_SESSION['cart'])){
				$item_id = array_column($_SESSION['cart'],"id");
				if(!in_array($_POST['sid'],$item_id)){
					$count = count($_SESSION['cart']);
					$item = array(
					'id' => $_POST['sid'],
					'bid' => $_POST['bid'],
					'name' => $_POST['pro'],
					'maelezo' => $_POST['mael'],
					'quantity' => $_POST['qn'],
					'cid' => $_POST['cid'],
					'cid2' => $_POST['cid2'],
					'type' => $_POST['type'],
					'price' => $_POST['price']
					);
					$_SESSION['cart'][$count] = $item;
					header('location:' .URL. 'stock/order');
				}else{
					 echo '<script type="text/javascript"> alert("item already added");</script>';
				echo '<script>window.location="'.URL.'stock/viewStock"</script>';
				
				}
			}else{
				
				$item = array(
				'id' => $_POST['sid'],
				'bid' => $_POST['bid'],
					'name' => $_POST['pro'],
					'quantity' => $_POST['qn'],
					'maelezo' => $_POST['mael'],
					'cid' => $_POST['cid'],
					'cid2' => $_POST['cid2'],
					'type' => $_POST['type'],
					'price' => $_POST['price']
				);
				$_SESSION['cart'][0] = $item;
				header('location:' .URL. 'stock/order');
								
			}
		
			
	}
	
	function stockOut2(){
		if(!empty($_SESSION['cart'])){
			$i = 1;
		foreach($_SESSION['cart'] as $key => $value){
		$qn = $value['quantity'];
		$sid = $value['id'] ;
		$cid = $value['cid'] ;
		$cid2 = $value['cid2'] ;
		$bid = $value['bid'] ;
		$price = $value['price'] ;
		$type = $value['type'] ;
		
		$today = date('Y-m-d');
		if($i == 1){
		$this->db->insert('orders' ,array('odate'=>$today,'cid'=>$cid,'customerId'=>$cid2,'ordertype'=>$type));
		}
		
		$stm = $this->db->prepare("select max(oid) as oid from orders " );
		$stm->execute();
		$row = $stm->fetch();
		$oid = $row['oid'];
		
		$this->db->insert('order_details' ,array('bid'=>$bid,'oid'=>$oid,'quantity'=>$qn,'price'=>$price));
			
		$stm = $this->db->prepare("select stockin from stock where sid = '$sid'" );
		$stm->execute();
		$row = $stm->fetch();
		$nso = $row['stockin'] -  $qn;
		
		$this->db->update('stock' ,array('stockin'=>$nso),"sid = '$sid'");
		
		$i++;
		}
		
		$stm = $this->db->prepare("select oid,ordertype,customerId from orders where oid =
		 (select max(oid) from orders) ");
		$stm->execute();
		$row = $stm->fetch();
		$oid = $row['oid'];
		$ot = $row['ordertype'];
		$cidc = $row['customerId'];
		
		if($ot == "credit"){
		$stm = $this->db->prepare("select sum(price * quantity) as total from order_details where oid = $oid ");
		$stm->execute();
		$row = $stm->fetch();
		$total = $row['total'];
		
		$stm = $this->db->prepare("select cust_account_id,balance from customer_account where custid = '$cidc' order by
		cust_account_id desc limit 1");
		$stm->execute();
		$row = $stm->fetch();
		$accId = $row['cust_account_id'];
		$count = $stm->rowCount();
		
		
		if($count == 1){
		$bl = $row['balance'];
		$newbalance = $bl + $total;
		$this->db->insert('customer_account' ,array('transactiondate'=>$today,'description'=>$total,
		'debit'=>$total,'credit'=>0,'balance'=>$newbalance,'custid'=>$cidc,'oid'=>$oid));

		}else{
			$this->db->insert('customer_account' ,array('transactiondate'=>$today,'description'=>$total,
			'debit'=>$total,'credit'=>0,'balance'=>$total,'custid'=>$cidc,'oid'=>$oid));

			//$this->db->insert('orders' ,array('odate'=>$today,'cid'=>$cid,'customerId'=>$cid2,'ordertype'=>$type));
		}
			
		}	
		
			unset($_SESSION['cart']);
			 echo '<script type="text/javascript"> alert("Successfull Saved");</script>';
				echo '<script>window.location="'.URL.'stock/viewStock"</script>';
		}else{
			 echo '<script type="text/javascript"> alert("No Order ");</script>';
				echo '<script>window.location="'.URL.'stock/order"</script>';
		}
	}
	
	
	
	  

		
	
}