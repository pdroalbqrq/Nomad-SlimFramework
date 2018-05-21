<?php
require_once 'crud.php';
class class_user extends crud{
	
	protected $table = 'user';
	private $name;

    
	public function setName($nome){
		$this->name = $nome;
	}
	public function getName(){
		return $this->name;
	}

	public function insert(){
		$sql  = "INSERT INTO $this->table (name) VALUES (:name)";
		$stmt = DataBase::prepare($sql);
		$stmt->bindParam(':name', $this->name);
		return $stmt->execute(); 
	}

	 public function findAll(){
		$sql  = "SELECT * FROM $this->table";
		$stmt = DataBase::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}