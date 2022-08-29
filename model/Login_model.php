<?php 
class Login_model extends Model{
	
	
	public function __construct(){
		
		parent::__construct();
	}


	function login(){
		//echo Hash::create('md5','12345',HASH_KEY);
		$stm = $this->db->prepare("select sid,role,fname,mname,lname from staff where jinalamtumiaji  = :rn and nywilayamtumiaji = :pass  and status = :status");
		$stm->execute(array(':rn'=>$_POST['rn'], ':pass' => Hash::create('md5',$_POST['password'],HASH_KEY),':status' => 'active'));
		$row = $stm->fetch();
		$count = $stm->rowCount();
		if($count == 1){
			Session::init();
			Session::set('id',$row['sid']);
			Session::set('role',$row['role']);
			Session::set('loggedIn', true);
			Session::set('fn', $row['fname']." ".$row['mname']." ".$row['lname']);
			header('location:' .URL. 'home');
		}
		
	}
	
	
	
		
	
}