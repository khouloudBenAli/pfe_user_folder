<?php

require_once 'database.php';
$db = new database('localhost', 'root', '', 'school');
$conn = $db->connect();

$UIDresult = "";
$MACresult = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data["UIDresult"], $data["MACresult"])) {
        $UIDresult = $data["UIDresult"];
        $MACresult = $data["MACresult"];
        echo "Received data from PHP:";
        echo "UIDresult: " . $UIDresult;
        echo "MACresult: " . $MACresult;

        try {
            $id_carte = $UIDresult; /
            $id_salle = "A_TD1";
            $id_prof = "3000";

                // Prepare the query to update the acces_historique table
                $stmt = $conn->prepare("UPDATE acces_historique 
                                       SET id_prof = :id_prof, id_salle = :id_salle, time = :now 
                                       WHERE id_carte = :id_carte");

                // Bind the values of the variables to the named parameters in the query
                $stmt->bindParam(':id_prof', $id_prof);
                $stmt->bindParam(':id_salle', $id_salle);
                $stmt->bindParam(':now', $now);
               // $stmt->bindParam(':id_carte', $id_carte);
                $stmt->bindParam(':id_carte', $id_carte);
                // Set the value for $now variable
                $now = date('Y-m-d H:i:s');

                // Execute the prepared query
                $stmt->execute();

                echo "Update successful";
            
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    }    
}


$db->disconnect();
?>
