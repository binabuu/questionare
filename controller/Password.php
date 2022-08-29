<?php 

class Password extends Controller{
	
	public function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == false ){
			Session::destroy();
			header('location:' .URL. 'index');
			exit;
		}
	}
	 
	 function index(){
		 $this->view->render('password/change_password');
	 }
	 
	 function changePassword(){
		 $this->model->changePassword();
	 }
	 
	 
	
}



?>