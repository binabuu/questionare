<?php
 //database should access from model
class Database extends PDO{
	
	public function __construct()
	{
		parent::__construct('mysql:host=localhost;dbname=pims','binabuu','mojambili3');
	}
	
	public function insert($table,$data){
	
		$fieldname = implode(', ', array_keys($data));
		$fieldvalue = ':'. implode(', :', array_keys($data));
		
		$sth = $this->prepare("insert into $table ($fieldname) values ($fieldvalue)");
		foreach($data as $key => $value){
			$sth->bindValue(":$key", $value);
		}
		$sth->execute();
		
	}
	
	public function update($table,$data,$where){
		$fielDetails = NULL ;
		foreach ($data as $key => $value){
			$fielDetails .= "$key = :$key,";
		}
		$fielDetails = rtrim($fielDetails, ',');
		//echo "update $table set $fielDetails where $where";
		//die;
		
		$sth = $this->prepare("update $table set $fielDetails where $where");
		foreach($data as $key => $value){
			$sth->bindValue(":$key", $value);
		}
		$sth->execute();
		
	}
	
	
}
?>