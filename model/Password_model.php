<?php 
class Password_model extends Model{
	
	
	public function __construct(){
		
		parent::__construct();
	}


	
	 function changePassword(){
		Session::init();
		$id = Session::get('id');
		 $data = array();
		$data['op'] = Hash::create('md5',$_POST['op'],HASH_KEY);
		$data['np'] = Hash::create('md5',$_POST['np'],HASH_KEY);
		
		$stm = $this->db->prepare("select nywilayamtumiaji from staff where sid = :rn ");
		$stm->execute(array(':rn'=>$id));
		$row =  $stm->fetch();
		
		if($data['op'] == $row['nywilayamtumiaji']){
			
		$this->db->update('staff' ,array('nywilayamtumiaji'=>$data['np']),"sid= '$id'") ;
		echo "Password Changed";
		}else{
			echo "Password don't match";
		}
	 }
	
	
		
	
}