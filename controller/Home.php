<?php 

class Home extends Controller{
	
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
		 $this->view->render('home/home');
	 }
	 
	 function productTaken(){
		 
		 $this->model->productTaken();
	 }
	 
	 function customerSearch(){
		 $this->model->customerSearch();
	 }
	 
	  function productSearch(){
		 $this->model->productSearch();
	 }
	 
	 function periodicStock(){
		  $this->view->render('home/periodic');
	 }
	 
	 function periodicSearch(){
		 $this->model->periodicSearch();
	 }
	 
	 function stockIn(){
		   $this->view->render('home/stockin');
	 }
	 
	 function stockInSearch(){
		 $this->model->stockInSearch();
	 }
	 
	 function stockin2(){
		 $this->model->stockin2();
	 }
	 
	 function areYouSure(){
		  echo '<script type="text/javascript">
		 var r=confirm("Are You Sure You want to Delete All Data!");
		if (r==true)
		{
		window.location="'.URL.'home/deleteAll";
		}
		else
		{
			window.location="'.URL.'home";
		
		}
		 </script>';
				
		 
	 }
	 
	 function deleteAll(){
		 $this->model->deleteAll();
	 }

	 
	 function logout(){
		 Session::destroy();
		header('location:../index');
		exit;
	 }
	 
	 
	
}



?>