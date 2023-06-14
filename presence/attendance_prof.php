<?php
include ("db_connect.php");

$response=array() ;
$req = mysqli_query($cnx, "SELECT p.full_name , e.num_seance , pf.status_prof , pf.jour
                            FROM presence_prof  pf

                            inner join
                            emploi e
                            on
                            pf.id_emploi = e.id_emploi

                            inner join 
                            professeur p 
                            on
                            p.id_prof=pf.id_prof  " );


if (mysqli_num_rows($req) > 0)
{
    $tmp=array();
    $response["prof"]=array();
    while($cur=mysqli_fetch_array($req))
    {
        $tmp["full_name"]=$cur["full_name"];
        $tmp["num_seance"]=$cur["num_seance"];
        $tmp["status_prof"]=$cur["status_prof"];
        $tmp["jour"]=$cur["jour"];


        array_push($response["prof"],$tmp);
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