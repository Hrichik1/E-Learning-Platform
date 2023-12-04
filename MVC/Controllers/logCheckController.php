<?php 
require_once('../Models/alldb.php');
if(isset($_REQUEST['submit']))
{
	$Username=$_REQUEST['username'];
	$Pass=$_REQUEST['pass'];

	if(empty($Username))
	{
		echo "empty";
	}
	else
	{
		$status=auth($Username,$Pass);
		if($status){
			echo "Empty";
		}
		else
		{
			header('location:../Views/login.php');
		}
	}

}

 ?>