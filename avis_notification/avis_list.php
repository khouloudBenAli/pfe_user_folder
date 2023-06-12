<?php
include ("db_connect.php");

$response=array() ;
$req = mysqli_query($cnx, "SELECT avis , date_avis
                           From avis_notification  " );


if (mysqli_num_rows($req) > 0)
{
    $tmp=array();
    $response["avis"]=array();
    while($cur=mysqli_fetch_array($req))
    {
        $tmp["avis"]=$cur["avis"];
        $tmp["date_avis"]=$cur["date_avis"];
    

        array_push($response["avis"],$tmp);
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