<?php
include("db_connect.php");

$response = array();
$req = mysqli_query($cnx, "SELECT ah.id_prof, ah.id_salle, ah.time, p.full_name FROM acces_historique ah
                           INNER JOIN professeur p ON p.id_prof = ah.id_prof
                           where ah.id_salle = 'TPA1'
                           ");

if (mysqli_num_rows($req) > 0) {
    $response["historique"] = array();
    while ($cur = mysqli_fetch_array($req)) {
        $tmp = array();
        $tmp["id_prof"] = $cur["id_prof"];
        $tmp["full_name"] = $cur["full_name"];
        $tmp["id_salle"] = $cur["id_salle"];
        $tmp["time"] = $cur["time"];
        array_push($response["historique"], $tmp);
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
