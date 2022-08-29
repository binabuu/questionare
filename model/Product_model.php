<?php 
class Product_model extends Model{
	
	
	public function __construct(){
		
		parent::__construct();
	}


	function addProduct(){
		if(!empty($_POST['bn'])){
		$data = array();
		$data['bn'] = strip_tags($_POST['bn']);
		$data['desc'] = strip_tags($_POST['desc']);
		$data['bp'] = strip_tags($_POST['bp']);
		$data['sp'] = strip_tags($_POST['sp']);
		$data['status'] = "active";
		
	$this->db->insert('bidhaa' ,array('bname'=>$data['bn'],'maelezo'=>$data['desc'],'sellprice'=>$data['sp']
	,'buyprice'=>$data['bp'],'status'=>$data['status']));
		echo "Registered Successfull";
		
		Session::init();
		$id = Session::get('id');
		$action ="Add Staff";
		$this->db->insert('log' ,array('sid'=>$id,'Action'=>$action));
		 
		}else{
			echo "empty";
		}
		
	}
	
	
	function productList(){
	$stm = $this->db->prepare("select bid,bname,maelezo,buyprice,sellprice from bidhaa where status = 'active' order by bname" );
	$stm->execute();
	$count = $stm->rowCount();
		if($count > 0){
			echo ' <a href="'.URL.'pdf/product" class="button" target ="_blank">Print</a>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Product Name</th><th>Description</th><th>Buy Price</th><th>Sell Price</th><th>Action</th></tr>';
	$i = 1;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="del'.$row['bid'].' w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['bname'].'</td><td>'.$row['maelezo'].'</td><td>'.number_format($row['buyprice']).'</td>
	<td>'.number_format($row['sellprice']).'</td>
	<td>
	<a  class="button" href="'.URL.'product/editProduct/'.$row['bid'].'"> Edit   </a>
	    <a  class="button" href="'.URL.'product/deactivate1/'.$row['bid'].'" > Remove </a>
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
	
	function productSearch(){
		$bn = $_POST['search'];
	$stm = $this->db->prepare("select bid,bname,maelezo,buyprice,sellprice from bidhaa where bname like '%$bn%' and  status = 'active' order by bname" );
		$stm->execute();
		$count = $stm->rowCount();
		if($count > 0){
			@session_start();
		  $_SESSION['productSearch'] = $bn;
			
			echo ' <a href="'.URL.'pdf/productSearch" class="button" target ="_blank">Print</a>';
		echo '<div class="w3-responsive">
	<table class="w3-table-all">
	<tr ><th>S/N</th><th>Product Name</th><th>Description</th><th>Buy Price</th><th>Sell Price</th><th>Action</th></tr>';
	$i = 1;
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
	echo '<tr  class="del'.$row['bid'].' w3-hover-teal">
	<td>'.$i.'</td><td>'.$row['bname'].'</td><td>'.$row['maelezo'].'</td><td>'.number_format($row['buyprice']).'</td>
	<td>'.number_format($row['sellprice']).'</td>
	<td>
	<a  class="button" href="'.URL.'product/editProduct/'.$row['bid'].'"> Edit   </a>
	    <a  class="button" href="'.URL.'product/deactivate/'.$row['bid'].'" > Remove </a>
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
	
	function editProduct($id = false){
		$stm = $this->db->prepare("select bid,bname,maelezo,sellprice,buyprice from bidhaa where bid = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function saveProduct(){
		if(!empty($_POST['bn']) ){
		$data = array();
		$data['bn'] = strip_tags($_POST['bn']);
		$data['desc'] = strip_tags($_POST['desc']);
		$data['bp'] = strip_tags($_POST['bp']);
		$data['sp'] = strip_tags($_POST['sp']);
		
		$bid = $_POST['bid2'];
		$this->db->update('bidhaa' ,array('bname'=>$data['bn'],'maelezo'=>$data['desc'],'buyprice'=>$data['bp'],'sellprice'=>$data['sp']),"bid = '$bid'");
		
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
			$this->db->update('bidhaa' ,array('status'=>$status),"bid = '$id'") ;
			header('location:' .URL. 'product/viewProduct');
			Session::init();
		$id = Session::get('id');
		$action ="Remove Staff";
		$this->db->insert('log' ,array('staffID'=>$id,'Action'=>$action));
	
		
		

		
	  }
	  

		
	
}