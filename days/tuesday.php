<?php
include("db_connect.php");

$response = array();

// Check if the id_prof parameter is set
if (isset($_GET['id_prof'])) {
    $id_prof = $_GET['id_prof'];

    // Select data from the emploi table with the specified conditions
    $select_query = "SELECT DISTINCT e.id_emploi, e.id_prof, e.id_classe, e.salle, e.num_seance
    FROM emploi e
    JOIN prof_seance ps ON e.id_prof = ps.id_prof
    JOIN seance s ON ps.id_seance = s.id_seance
    JOIN seance_classe sc ON s.id_seance = sc.id_seance
    JOIN salle_seance ss ON s.id_seance = ss.id_seance
    WHERE ps.id_prof = '3000' AND ps.jour = 'tuesday' ";


    $result = mysqli_query($cnx, $select_query);

    if (mysqli_num_rows($result) > 0) {
        $response["emploi"] = array();

        while ($cur = mysqli_fetch_array($result)) {
            $tmp = array();
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
