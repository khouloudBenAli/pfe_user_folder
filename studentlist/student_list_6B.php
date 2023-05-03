<?php
include("db_connect.php");

$response = array();
$req = mysqli_query($cnx, "SELECT age , name , lastname FROM student s 
                            where id_classe='6B'    ");

if (mysqli_num_rows($req) > 0) {
    $response["student"] = array();
    while ($cur = mysqli_fetch_array($req)) {
        $tmp = array();
        $tmp["age"] = $cur["age"];
        $tmp["name"] = $cur["name"];
        $tmp["lastname"] = $cur["lastname"];
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


?>
