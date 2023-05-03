<?php

include ("db_connect.php");

$response=array() ;

if( isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["lastname"]) && isset($_GET["classe"]) )
{
	$id=$_GET["id"];
	$name= $_GET["name"];
    $lastname= $_GET["lastname"];
    $classe= $_GET["classe"];


	$req=mysqli_query($cnx, " insert into student(id,name,lastname,classe) values('$id','$name','$lastname','$classe') ");

	if($req)
	{
		$response["success"]=1;
		$response["message"]="inserted ";
		echo Json_encode($response) ;
	}
	else

	{
		$response["success"]=0;
		$response["message"]="reauest error";
		echo Json_encode($response) ;
	}
}     
else 
{
	$response["success"]=0;
	$response["message"]="requerd fild is missing ";
	echo Json_encode($response) ;
} 



?>
