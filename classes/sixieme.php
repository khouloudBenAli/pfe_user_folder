<?php
include("db_connect.php");

$response=array() ;
$req=mysqli_query($cnx," SELECT * FROM classe WHERE description='sixieme' " );

if (mysqli_num_rows($req) > 0)
{
    $tmp=array();
    $response["niveaux"]=array();
    while($cur=mysqli_fetch_array($req))
    {
        $tmp["id_classe"]=$cur["id_classe"];
        $tmp["description"]=$cur["description"];
        
        array_push($response["niveaux"],$tmp);
    }
    $response["success"]="1";
    $response["message"]="success";
    echo Json_encode($response) ;
}
else

	{
		$response["success"]=0;
		$response["message"]="no data found !";
		echo Json_encode($response) ;
    }


?>
