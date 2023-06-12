<?php

include ("db_connect.php");

$response=array() ;

if(  isset($_GET["avis"]) )
{
	
	$avis= $_GET["avis"];
    //$date_avis= $_GET["date_avis"];
    


	$req=mysqli_query($cnx, " insert into avis_notification (avis,date_avis) values('$avis',NOW() ) ");

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
