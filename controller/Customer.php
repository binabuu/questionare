<?php 

class Customer extends Controller{
	
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
		$this->view->render('customer/new_customer');
	
	}
	
	function viewCustomer(){
		$this->view->customer = $this->model->viewCustomer();
		$this->view->render('customer/view_customer');
	}
	
	function editCustomer($id = false){
		$this->view->edit = $this->model->editCustomer($id);
			$this->view->render('customer/edit_customer');
	}
	
	function addCustomer(){
		$this->model->addCustomer();
	}
	
	function saveCustomer(){
		$this->model->saveCustomer();
	}
	
	function deactivate($id = false){
		$this->model->deactivate($id);
	}
	
	
	
	
	
}



?>