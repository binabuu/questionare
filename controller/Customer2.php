<?php 

class Customer2 extends Controller{
	
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
		$this->view->render('customer2/new_customer');
	
	}
	
	function pay($id = false){
		$this->view->cust = $this->model->accCustomer($id);
		$this->view->render('customer2/payment');
	}
	
	function payList($id = false){
		$this->model->payList($id);
	}
	
	function insertPayment(){
		$this->model->insertPayment();
	}
	
	
	function viewCustomer(){
		$this->view->render('customer2/view_customer');
	}
	
	function customerSearch(){
		$this->model->customerSearch();
	}

	function statementSearch(){
		$this->model->statementSearch();
	}

	function printStatement($id = false){
		$this->view->cust2 = $this->model->accCustomer($id);
		$this->view->render('customer2/printStatement');
	}

	function printSt(){
		$this->model->printSt();
	}
	
	function viewCustomerList(){
		 $this->model->viewCustomerList();
	}
	
	function editCustomer($id = false){
		$this->view->edit = $this->model->editCustomer($id);
		$this->view->render('customer2/edit_customer');
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
	
	function account($id = false){
		$this->view->cust = $this->model->accCustomer2($id);
		$this->view->render('customer2/account');
	}
	
	function lastDayInfo($id = false){
		$this->model->lastDayInfo($id);	
	}

	function statement($id = false){
		$this->model->statement($id);	
	}
	
	function daySearch($id = false){
		$this->model->daySearch($id);
		
	}
	
	function viewDay($id = false){
		$this->view->cust2 = $this->model->accCustomer($id);
		$this->view->render('customer2/viewdays');
	}

	function orderInfo($id = false){
		$this->view->oinfo = $this->model->getOinfo($id);
		$this->view->render('customer2/view_customer2');
	}

	function orderInfos($id = false){
		$this->model->orderInfos($id);
	}

	function viewAccount($id = false){
		$this->view->cust2 = $this->model->accCustomer($id);
		$this->view->render('customer2/viewaccount');
	}
	
	function viewDays($id = false){
		$this->model->viewDays($id);
		
	}
	
	function sure($id = false){
		 echo '<script type="text/javascript">
		 var r=confirm("Are You Sure You want to Remove Customer!");
		if (r==true)
		{
		window.location="'.URL.'customer2/deactivate/'.$id.'";
		}
		else
		{
			window.location="'.URL.'customer2/viewCustomer";
		
		}
		 </script>';
		
	}
	
	
	
	
	
}



?>