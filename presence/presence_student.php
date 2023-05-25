<?php
include("db_connect.php");

// Check if the id_prof parameter is set
if (isset($_GET['id_prof'])) {
    $id_prof = $_GET['id_prof'];

    $response = array();
    $req = mysqli_query($cnx, "SELECT * FROM presence_student ps
                                INNER JOIN seance s
                                ON ps.id_seance = s.id_seance
                                INNER JOIN prof_seance sp
                                ON s.id_seance = sp.id_seance
                                
                                WHERE sp.id_prof = $id_prof");

    if (mysqli_num_rows($req) > 0) {
        $response["student"] = array();
        while ($cur = mysqli_fetch_array($req)) {
            $tmp = array();
            $tmp["id_student"] = $cur["id_student"];
            $tmp["id_seance"] = $cur["id_seance"];
            $tmp["status_student"] = $cur["status_student"];
            array_push($response["student"], $tmp);
        }
        $response["success"] = "1";
        $response["message"] = "success";
        echo json_encode($response);
    } else {
        $response["success"] = "0";
        $response["message"] = "no data found!";
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "id_prof parameter not set!";
    echo json_encode($response);
}

?>
