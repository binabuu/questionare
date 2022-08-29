<?php 

class Supplier extends Controller{
	
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
		$this->view->render('supplier/new_supplier');
	
	}
	
	function pay($id = false){
		$this->view->sup2 = $this->model->accSupplier($id);
		$this->view->render('supplier/payment');
	}
	
	function payList($id = false){
		$this->model->payList($id);
	}
	
	function insertPayment(){
		$this->model->insertPayment();
	}
	
	
	function viewSupplier(){
		$this->view->render('supplier/view_supplier');
	}
	
	function supplierSearch(){
		$this->model->supplierSearch();
	}
	
	function viewSupplierList(){
		 $this->model->viewSupplierList();
	}
	
	function editSupplier($id = false){
		$this->view->edit = $this->model->editSupplier($id);
			$this->view->render('supplier/edit_supplier');
	}

	function viewAccount($id = false){
		$this->view->cust2 = $this->model->accSupplier($id);
		$this->view->render('supplier/viewaccount');
	}
	
	function addSupplier(){
		$this->model->addSupplier();
	}

	function statement($id = false){
		$this->model->statement($id);	
	}

	function statementSearch(){
		$this->model->statementSearch();
	}

	function printStatement($id = false){
		$this->view->cust2 = $this->model->accSupplier($id);
		$this->view->render('supplier/printStatement');
	}

	function printSt(){
		$this->model->printSt();
	}
	
	function saveSupplier(){
		$this->model->saveSupplier();
	}
	
	function deactivate($id = false){
		$this->model->deactivate($id);
	}
	
	function account($id = false){
		$this->view->supl = $this->model->Supplier($id);
		$this->view->render('supplier/account');
	}
	
	function lastDayInfo($id = false){
		$this->model->lastDayInfo($id);	
	}
	
	function daySearch($id = false){
		$this->model->daySearch($id);
		
	}
	
	function viewDay($id = false){
		$this->view->sup2 = $this->model->accSupplier($id);
		$this->view->render('supplier/viewdays');
	}
	
	function viewDays($id = false){
		$this->model->viewDays($id);
		
	}
	
	function sure($id = false){
		 echo '<script type="text/javascript">
		 var r=confirm("Are You Sure You want to Remove Supplier!");
		if (r==true)
		{
		window.location="'.URL.'supplier/deactivate/'.$id.'";
		}
		else
		{
			window.location="'.URL.'supplier/viewSupplier";
		
		}
		 </script>';
		
	}
	
	
	
	
	
}



?>