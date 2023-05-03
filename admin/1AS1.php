<?php
include("db_connect.php");

$response=array() ;
$req=mysqli_query($cnx," SELECT s.name , ps.id_student

FROM presence_student ps

INNER JOIN 
seance_classe sc 
ON 
sc.id_seance = ps.id_seance

INNER JOIN 
classe cl 
ON 
cl.id_classe = sc.id_classe

INNER JOIN 
student s
 ON 
 ps.id_student = s.Id

where sc.jour = CURDATE() 
AND cl.id_classe='1A'
AND sc.id_seance=1111

 " );

if (mysqli_num_rows($req) > 0)
{
    $tmp=array();
    $response["lst"]=array();
    while($cur=mysqli_fetch_array($req))
    {
        $tmp["name"]=$cur["name"];
        $tmp["id_student"]=$cur["id_student"];
        
        array_push($response["lst"],$tmp);
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
