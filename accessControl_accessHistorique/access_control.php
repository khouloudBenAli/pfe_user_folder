<?php
include("db_connect.php");

$response = array();
$req = mysqli_query($cnx, "SELECT ap.id_prof, ap.id_salle, p.full_name FROM acces_prof ap
                           INNER JOIN professeur p ON p.id_prof = ap.id_prof");

if (mysqli_num_rows($req) > 0) {
    $response["acces"] = array();
    while ($cur = mysqli_fetch_array($req)) {
        $tmp = array();
        $tmp["id_prof"] = $cur["id_prof"];
        $tmp["id_salle"] = $cur["id_salle"];
        $tmp["full_name"] = $cur["full_name"];
        array_push($response["acces"], $tmp);
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
