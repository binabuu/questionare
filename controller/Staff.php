<?php 

class Staff extends Controller{
	
	public function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$role = Session::get('role');
		if ($logged == false || $role != "boss"){
			Session::destroy();
			header('location:' .URL. 'index');
			exit;
		}
	}
	
	 function index(){
		$this->view->render('staff/new_staff');
	
	}
	
	function viewStaff(){
		$this->view->staff = $this->model->viewStaff();
		$this->view->render('staff/view_staff');
	}
	
	function editStaff($id = false){
		$this->view->edit = $this->model->editStaff($id);
			$this->view->render('staff/edit_staff');
	}
	
	function addStaff(){
		$this->model->addStaff();
	}
	
	function saveStaff(){
		$this->model->saveStaff();
	}
	
	function deactivate($id = false){
		$this->model->deactivate($id);
	}
	
	
	
	
	
}



?>