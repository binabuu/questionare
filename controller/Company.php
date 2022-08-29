<?php 

class Company extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
	 
	 function index(){
		 $this->view->tunayodai = $this->model->tunayodai();
		 $this->view->tunayodaiwa = $this->model->tunayodaiwa();
		 $this->view->mauzo = $this->model->mauzo();
		$this->view->stock = $this->model->stock();
		 $this->view->render('company/index');
	 }
	 
	 function mapato(){
		 $this->model->mapato();
	 }
	 
	 function getIncome(){
		  $this->view->render('company/getIncome');
	 }
	 
	 function viewIncome(){
		  $this->view->render('company/view_income');
	 }
	 
	 
	
	 
	
}



?>