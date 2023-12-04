<?php 
require_once('db.php');

function auth($Username,$Pass)
{
	$con=getConnection();
	$sql="select * from adminregdb where username='$Username' and pass='$Pass'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count==1)
	{
		return true;
	}
	else
	{
		return false;
	}

}


 ?>