<?php
include ("db_connect.php");
// Check if the id_prof parameter is set
if (isset($_GET['id_prof'])) {
    $id_prof = $_GET['id_prof'];

    $response=array() ;
    $req = mysqli_query($cnx, "SELECT p.full_name, pp.status_prof, pp.jour, s.num_seance
                                FROM professeur p
                                INNER JOIN presence_prof pp on p.id_prof = pp.id_prof
                                                                
                                INNER JOIN seance s ON pp.id_seance = s.id_seance
                                                                                                
                                WHERE pp.id_prof = $id_prof " );


    if (mysqli_num_rows($req) > 0)
    {
        $tmp=array();
        $response["prof"]=array();
        while($cur=mysqli_fetch_array($req))
        {
            $tmp["full_name"]   =$cur["full_name"];
            $tmp["status_prof"] =$cur["status_prof"];
            $tmp["jour"]        =$cur["jour"];
            $tmp["num_seance"]  =$cur["num_seance"];

        

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
} else {
    $response["success"] = 0;
    $response["message"] = "id_prof parameter not set!";
    echo json_encode($response);
}

?>