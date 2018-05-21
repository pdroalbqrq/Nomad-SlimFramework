<?php
require_once 'DataBase.php';
abstract class crud extends DataBase{
	protected $table;
	abstract public function insert();
	
	abstract public function findAll();
	
}