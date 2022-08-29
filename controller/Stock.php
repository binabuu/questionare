<?php 

class Stock extends Controller{
	
	public function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$role = Session::get('role');
		if ($logged == false ){
			Session::destroy();
			header('location:' .URL. 'index');
			exit;
		}
	}
	
	 function index(){
		 $this->view->supplier = $this->model->supplier();
		 $this->view->pro = $this->model->product();
		$this->view->render('stock/new_stock');
	
	}
	
	function stockList(){
	$this->model->stockList();
	}
	
	function returnIn($id = false){
		$this->view->edit = $this->model->editStock($id);
		$this->view->render('stock/returnin');
	}
	
	function returnOut($id = false){
		$this->view->supplier = $this->model->supplier();
		$this->view->edit = $this->model->editStock($id);
		$this->view->render('stock/returnout');
	}
	
	function returnIn2($id = false){
		$this->view->render('stock/view_returnin');
	}
	
	function returnOut2($id = false){
		$this->view->render('stock/view_returnout');
	}
	
	function sendBack(){
		$this->model->sendBack();
	}
	
	function sendForward(){
		$this->model->sendForward();
	}
	
	function returnBack(){
		$this->model->returnBack();
	}
	
	function returnForward(){
		$this->model->returnForward();
	}
	
	function stockSearch(){
	$this->model->stockSearch();
	}
	
	function viewStock(){
		$this->view->render('stock/view_stock');
	}
	
	function editStock($id = false){
		$this->view->supplier = $this->model->supplier();
		$this->view->edit = $this->model->editStock($id);
		$this->view->render('stock/edit_stock');
	}
	
	function stockOut($id = false){
		$this->view->cust = $this->model->customer();
		$this->view->cust2 = $this->model->customer2();
		$this->view->pro2 = $this->model->product2($id);
		$this->view->render('stock/stockout');
	}
	
	function addStock(){
		$this->model->addStock();
	}
	
	function updateStock(){
		$this->model->updateStock();
	}
	
	function sendtoCart(){
		$this->model->sendtoCart();
	}
	
	function cartRemove($id = false){
		foreach($_SESSION['cart'] as $key => $values){
			if($values['id'] == $id){
				unset($_SESSION['cart'][$key]);
			}
			header('location:' .URL. 'stock/order');
		}
	}
	
	function order(){
		$this->view->render('stock/order');
	}
	
	function stockOut2(){
		$this->model->stockOut2();
	}
	
	
	
	
	
}



?>