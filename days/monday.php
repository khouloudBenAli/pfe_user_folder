<?php
include("db_connect.php");

$response = array();
/*
// Retrieve the data from the database
$req = mysqli_query($cnx, "SELECT prof_seance.id_prof, seance.num_seance, salle_seance.id_salle, seance_classe.id_classe
                           FROM prof_seance
                           JOIN seance ON prof_seance.id_seance = seance.id_seance
                           JOIN seance_classe ON seance.id_seance = seance_classe.id_seance
                           JOIN salle_seance ON seance.id_seance = salle_seance.id_seance
                           WHERE prof_seance.id_prof = '3030'
                           AND prof_seance.jour = 'Monday'");

if (mysqli_num_rows($req) > 0) {
    $response["success"] = "1";
    $response["message"] = "success";
    $tmp = array();
    $response["emploi"] = array();

    // Insert the retrieved data into the emploi_prof table
    while ($cur = mysqli_fetch_array($req)) {
        $id_prof = $cur["id_prof"];
        $num_seance = $cur["num_seance"];
        $id_classe = $cur["id_classe"];
        $id_salle = $cur["id_salle"]; 

        $insert_query = "INSERT INTO emploi (id_prof, id_classe, salle, num_seance) VALUES ('$id_prof', '$id_classe', '$id_salle', '$num_seance')";

        if (mysqli_query($cnx, $insert_query)) {
            $response["insert_success"] = "1";
            $response["insert_message"] = "Data inserted successfully";
        } else {
            $response["insert_success"] = "0";
            $response["insert_message"] = "Error inserting data: " . mysqli_error($cnx);
        }
    }*/
    
    // Select all data from the emploi table
    $select_query = "SELECT * FROM emploi where id_prof='A' ";
    $result = mysqli_query($cnx, $select_query);
    if (mysqli_num_rows($result) > 0) {
        $tmp = array();
        $response["emploi"] = array();
        while ($cur = mysqli_fetch_array($result)) {
            $tmp["id_emploi"] = $cur["id_emploi"];
            $tmp["id_prof"] = $cur["id_prof"];
            $tmp["id_classe"] = $cur["id_classe"];
            $tmp["salle"] = $cur["salle"];
            $tmp["num_seance"] = $cur["num_seance"];

            array_push($response["emploi"], $tmp);
        }
        $response["success"] = "1";
        $response["message"] = "success";
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "no data found!";
        echo json_encode($response);
    }
/*}*/
?>
