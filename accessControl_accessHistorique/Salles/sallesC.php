<?php
include("db_connect.php");


    $response = array();
    $req = mysqli_query($cnx, "SELECT id_salle  FROM salle s 
                                where etage= '3'  ");

    if (mysqli_num_rows($req) > 0) {
        $response["etage"] = array();
        while ($cur = mysqli_fetch_array($req)) {
            $tmp = array();
            $tmp["id_salle"] = $cur["id_salle"];
            array_push($response["etage"], $tmp);
        }
        $response["success"] = "1";
        $response["message"] = "success";
        echo json_encode($response);
    } else {
        $response["success"] = "0";
        $response["message"] = "no data found!";
        echo json_encode($response);
    }


?>
