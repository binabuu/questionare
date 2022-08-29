<?php

class Pdf extends Controller {
	
	public function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$role = Session::get('role');
		if ($logged == false  ){
			Session::destroy();
			header('location:' .URL. 'index');
			exit;
		}
		
		
	}
	
	
	function stock(){
		$this->model->stock();
	}
	
	function periodicStock(){
		$this->model->periodicStock();
	}
	
	function stockout(){
		$this->model->stockout();
	}
	
	function stockin2(){
		$this->model->stockin2();
	}
	
	function stockinSearch(){
		$this->model->stockinSearch();
	}
	
	function customerSearch(){
		$this->model->customerSearch();
	}
	
	function bidhaaSearch(){
		$this->model->bidhaaSearch();
	}
	
	function product(){
		$this->model->product();
	}
	
	function productSearch(){
		$this->model->productSearch();
	}
	
	function stockSearch(){
		$this->model->stockSearch();
	}
	
}