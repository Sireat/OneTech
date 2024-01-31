<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "bdu_ecommerce_2023";
	private $con_srv;
	
	function __construct() {
		$this->con_srv = $this->connectDB();
	}
	
	function connectDB() {
		$con_srv = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $con_srv;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->con_srv,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->con_srv,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>