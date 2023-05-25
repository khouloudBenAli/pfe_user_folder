<?php
include ("db_connect.php");
// Check if the id_prof parameter is set
if (isset($_GET['id_prof'])) {
    $id_prof = $_GET['id_prof'];

    $response=array() ;
    $req = mysqli_query($cnx, "SELECT * FROM presence_prof where id_prof = $id_prof  " );


    if (mysqli_num_rows($req) > 0)
    {
        $tmp=array();
        $response["prof"]=array();
        while($cur=mysqli_fetch_array($req))
        {
            $tmp["id_prof"]=$cur["id_prof"];
            $tmp["id_seance"]=$cur["id_seance"];
            $tmp["status_prof"]=$cur["status_prof"];
        

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