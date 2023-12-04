<?php 

function getConnection(){
	$servername="localhost";
	$username= "root";
	$password="";
	$dbname="admindb";
	$conn= new mysqli($servername,$username,$password,$dbname);
	return $conn;
}

 ?>