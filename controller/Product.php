<?php 

class Product extends Controller{
	
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
		$this->view->render('product/new_product');
	
	}
	
	function productList(){
	$this->model->productList();
	}
	
	
	function productSearch(){
	$this->model->productSearch();
	}
	
	function viewProduct(){
		$this->view->render('product/view_product');
	}
	
	function editProduct($id = false){
		$this->view->edit = $this->model->editProduct($id);
		$this->view->render('product/edit_product');
	}
	
	function addProduct(){
		$this->model->addProduct();
	}
	
	function saveProduct(){
		$this->model->saveProduct();
	}
	
	function deactivate($id = false){
		$this->model->deactivate($id);
	}
	
	function deactivate1($id = false){
		 echo '<script type="text/javascript">
		 var r=confirm("Are You Sure You want to Remove Product!");
		if (r==true)
		{
		window.location="'.URL.'product/deactivate/'.$id.'";
		}
		else
		{
		window.location="'.URL.'product/viewProduct";
		}
		 </script>';
				
		
		
	}
	
	
	
	
	
}



?>