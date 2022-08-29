<?php 
class Company_model extends Model{
	
	
	public function __construct(){
		parent::__construct();
	}


	function tunayodai(){
		$stm = $this->db->prepare("select cid,fname,mname,mname,lname,location from customer2 
		where status = 'active' order by fname" );
		$stm->execute();
		$sum = 0;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
		$cid = $row['cid'];
		$stms = $this->db->prepare("select cust_account_id,balance from customer_account where 
		custid = '$cid' order by cust_account_id desc limit 1");
		$stms->execute();
		$rows = $stms->fetch();

	$sum = $sum + $rows['balance'];

	}

		return $sum;
		
	}
	
	function tunayodaiwa(){
		$stm = $this->db->prepare("select supid,supname,location from supplier order by supname" );
		$stm->execute();
		$sum = 0;
	while($row = $stm->fetch(PDO::FETCH_ASSOC)){
		$supid = $row['supid'];
		$stms = $this->db->prepare("select supp_account_id,balance from supplier_account where 
		suppid = '$supid' order by supp_account_id desc limit 1");
		$stms->execute();
		$rows = $stms->fetch();

	$sum = $sum + $rows['balance'];

	}

		return $sum;
		
	}
	
	function mauzo(){
		$stm = $this->db->prepare("select sum(price * quantity) as mauzo from order_details od join orders o on o.oid = od.oid
		where odate = curdate()" );
		$stm->execute();
		return $stm->fetch();
		
	}
	
	
	function stock(){
		$stm = $this->db->prepare("select sum(stockin * sellprice) as  stock from stock s join bidhaa b on s.bid = b.bid " );
		$stm->execute();
		return $stm->fetch();
		
	}
	
	function mapato(){
		$data = array();
		$data['os'] = strip_tags($_POST['os']);
		$data['cs'] = strip_tags($_POST['cs']);
		$data['ci'] = strip_tags($_POST['ci']);
		$data['ex'] = strip_tags($_POST['ex']);
		
		if(empty($_POST['os'])){
				$data['os'] = 0;
		}
		if (empty($_POST['cs'])){
			$data['cs'] = 0;
		}
		if (empty($_POST['ci'])){
			$data['ci'] = 0;
		}
		if (empty($_POST['ex'])){
			$data['ex'] = 0;
		}
		
		
		$stm = $this->db->prepare("select sum(price * quantity) as mauzo from order_details od join orders o on o.oid = od.oid where odate = curdate()" );
		$stm->execute();
		$row = $stm->fetch();
		$sales = $row['mauzo'];
		//echo "sales ".$sales."</br>";
		
		$stm = $this->db->prepare("select sum(price * quantity) as returnin from returnin where rdate = curdate()" );
		$stm->execute();
		$row = $stm->fetch();
		$returnin = $row['returnin'];
		//echo "return in ".$returnin."</br>";
		
		$salesMinusReturn = $sales - $returnin."</br>";
		
		
		$stm = $this->db->prepare("select sum(buyprice * stockin) as purchase from stock2 s join bidhaa b on s.bid = b.bid
		where sdate = curdate()" );
		$stm->execute();
		$row = $stm->fetch();
		$purchase = $row['purchase'];
		//echo "purchase ".$purchase."</br>";
		
		$stm = $this->db->prepare("select sum(buyprice * quantity) as returnout from returnout r join bidhaa b on r.bid = b.bid
		where rdate = curdate()" );
		$stm->execute();
		$row = $stm->fetch();
		$returnout = $row['returnout'];
		//echo "return out ".$returnout."</br>";
		
		$purchaseOpStock = ($data['os'] + $purchase) - $returnout;
		
		$addCarriegeIn = $purchaseOpStock + $data['ci'];
		
		$lessClosingStock = $addCarriegeIn - $data['cs'];
		
		$grossProfit = $salesMinusReturn - $lessClosingStock;
		
		//echo "gross Profit ".$grossProfit."</br>";
		
		
		$income = $grossProfit - $data['ex'];
		
		echo "income ".$income;
		
		$today = date('Y-m-d');
		
		$this->db->insert('other' ,array('expenses'=>$data['ex'],'carriegein'=>$data['ci'],'odate'=>$today,
		'openingstock'=>$data['os'],'closingstock'=>$data['cs']));
		
		
		
		
	}
	
	
		
	
}