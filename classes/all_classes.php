<?php
include ("db_connect.php");

$response=array() ;
$req = mysqli_query($cnx, "SELECT id_classe FROM classe " );


if (mysqli_num_rows($req) > 0)
{
    $tmp=array();
    $response["every"]=array();
    while($cur=mysqli_fetch_array($req))
    {
        $tmp["id_classe"]=$cur["id_classe"];
        
        array_push($response["every"],$tmp);
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