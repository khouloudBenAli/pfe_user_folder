<?php
include("db_connect.php");

$response=array() ;
$req=mysqli_query($cnx," SELECT st.name, st.lastname, ps.jour

                        FROM student st 
                        INNER JOIN presence_student ps ON st.Id = ps.id_student

                        INNER JOIN emploi e ON ps.id_emploi = e.id_emploi

                        where ps.jour = CURDATE() 
                        AND st.id_classe = '5B'
                        AND e.num_seance = 2");

if (mysqli_num_rows($req) > 0)
{
    $tmp=array();
    $response["lst"]=array();
    while($cur=mysqli_fetch_array($req))
    {
        $tmp["name"]=$cur["name"];
        $tmp["jour"]=$cur["jour"];

        
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
