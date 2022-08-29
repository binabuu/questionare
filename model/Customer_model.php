<?php 
class Customer_model extends Model{
	
	
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
		
		
	$this->db->insert('customer' ,array('fname'=>$data['fname'],'mname'=>$data['mname'],'lname'=>$data['lname'],'location'=>$data['addr'],'status'=>$data['status']));
		echo "Registered Successfull";
		
		Session::init();
		$id = Session::get('id');
		$action ="Add Staff";
		$this->db->insert('log' ,array('sid'=>$id,'Action'=>$action));
		 
		}else{
			echo "empty";
		}
		
	}
	
	
	function viewCustomer(){
		$stm = $this->db->prepare("select cid,fname,mname,mname,lname,location from customer where status = 'active' order by fname" );
		$stm->execute();
		return $stm->fetchAll();
	}
	
	function editCustomer($id = false){
		$stm = $this->db->prepare("select cid,fname,mname,lname,location from customer where cid = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function saveCustomer(){
		if(!empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['addr'])){
		$data = array();
		$data['fname'] = strip_tags($_POST['fn']);
		$data['mname'] = strip_tags($_POST['mn']);
		$data['lname'] = strip_tags($_POST['ln']);
		$data['addr'] = strip_tags($_POST['addr']);
		
		$sid = $_POST['sid2'];
		
		$this->db->update('customer' ,array('fname'=>$data['fname'],'mname'=>$data['mname'],'lname'=>$data['lname'],'location'=>$data['addr']),"cid = '$sid'");
		
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
			$this->db->update('customer' ,array('status'=>$status),"cid = '$id'") ;
			header('location:' .URL. 'customer/viewCustomer');
			Session::init();
		$id = Session::get('id');
		$action ="Remove Staff";
		$this->db->insert('log' ,array('staffID'=>$id,'Action'=>$action));
	
		
		

		
	  }
	  

		
	
}