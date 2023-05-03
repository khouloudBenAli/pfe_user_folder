<?php

include ("db_connect.php");

$response=array() ;

if( isset($_GET["id"]) ) {

	$id=$_GET["id"];
	
	$req=mysqli_query($cnx, " delete from student where id='$id'");

	if($req)
	{
		$response["success"]=1;
		$response["message"]="successful delete !";
		echo Json_encode($response) ;
	}
	else

	{
		$response["success"]=0;
		$response["message"]="requerd error !";
		echo Json_encode($response) ;
    }
}    
else 
{
	$response["success"]=0;
	$response["message"]="requerd fild is missing !";
	echo Json_encode($response) ;
} 
?>