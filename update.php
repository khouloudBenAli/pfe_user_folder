<?php

include ("db_connect.php");

$response=array() ;

if( isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["lastname"]) && isset($_GET["classe"]) )
{
	$id=$_GET["id"];
	$name= $_GET["name"];
    $lastname= $_GET["lastname"];
    $age= $_GET["age"];
	$id_classe= $_GET["id_classe"];


	$req=mysqli_query($cnx, " update student set name='$name',lastname='$lastname',age='$age',id_classe=$id_classe  where id='$id'");

	if($req)
	{
		$response["success"]=1;
		$response["message"]="update successfully !";
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
