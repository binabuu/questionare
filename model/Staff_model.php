<?php 
class Staff_model extends Model{
	
	
	public function __construct(){
		
		parent::__construct();
	}


	function addStaff(){
		if(!empty($_POST['sid']) && !empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['addr']) && !empty($_POST['gender']) && !empty($_POST['role'])){
		$data = array();
		$data['sid'] = strip_tags($_POST['sid']);
		$data['fname'] = strip_tags($_POST['fn']);
		$data['mname'] = strip_tags($_POST['mn']);
		$data['role'] = strip_tags($_POST['role']);
		$data['lname'] = strip_tags($_POST['ln']);
		$data['gender'] = strip_tags($_POST['gender']);
		$data['addr'] = strip_tags($_POST['addr']);
		$data['status'] = "active";
		
		$stm = $this->db->prepare("select jinalamtumiaji  from staff where jinalamtumiaji  = :uid ");
		$stm->execute(array(':uid'=>$data['sid']));
		$count = $stm->rowCount();
		if($count > 0){
			echo $data['sid']." User Name already Exist. Please Choose Diffrent One";
		}else{
	$this->db->insert('staff' ,array('jinalamtumiaji'=>$data['sid'],'fname'=>$data['fname'],'mname'=>$data['mname'],'lname'=>$data['lname'],'address'=>$data['addr']
	,'gender'=>$data['gender'],'nywilayamtumiaji'=>Hash::create('md5',$data['sid'],HASH_KEY),'status'=>$data['status'],'role'=>$data['role']));
		echo "Registered Successfull";
		
		Session::init();
		$id = Session::get('id');
		$action ="Add Staff";
		$this->db->insert('log' ,array('sid'=>$id,'Action'=>$action));
		 }
		}else{
			echo "empty";
		}
		
	}
	
	
	function viewStaff(){
		$stm = $this->db->prepare("select sid,jinalamtumiaji,fname,mname,mname,lname,address,gender,role from staff where status = 'active' order by fname" );
		$stm->execute();
		return $stm->fetchAll();
	}
	
	function editStaff($id = false){
		$stm = $this->db->prepare("select sid,fname,mname,lname,address,gender,role from staff where sid = '$id'" );
		$stm->execute();
		return $stm->fetch();
	}
	
	function saveStaff(){
		if(!empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['addr'])  && !empty($_POST['gender']) && !empty($_POST['role'])){
		$data = array();
		$data['fname'] = strip_tags($_POST['fn']);
		$data['mname'] = strip_tags($_POST['mn']);
		$data['role'] = strip_tags($_POST['role']);
		$data['lname'] = strip_tags($_POST['ln']);
		$data['gender'] = strip_tags($_POST['gender']);
		$data['addr'] = strip_tags($_POST['addr']);
		
		$sid = $_POST['sid2'];
		
		$this->db->update('staff' ,array('fname'=>$data['fname'],'mname'=>$data['mname'],'lname'=>$data['lname'],'address'=>$data['addr'],'gender'=>$data['gender']
		,'role'=>$data['role']),"sid = '$sid'");
		
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
			$this->db->update('staff' ,array('status'=>$status),"sid = '$id'") ;
			header('location:' .URL. 'staff/viewStaff');
			Session::init();
		$id = Session::get('id');
		$action ="Remove Staff";
		$this->db->insert('log' ,array('staffID'=>$id,'Action'=>$action));
	
		
		

		
	  }
	  

		
	
}