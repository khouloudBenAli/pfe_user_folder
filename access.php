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
            $id_carte = $UIDresult; // ID retrieved from the request
            $id_salle = "A_TD1";
            $age = "48";

            // Prepare the query to retrieve id_prof based on id_carte
            //$stmt = $conn->prepare("SELECT p.id_prof  FROM professeur p WHERE p.id_carte = :id_carte");
            $stmt = $conn->prepare("SELECT p.id_prof  FROM professeur p WHERE p.age = :age");

            // Bind the value of id_carte to the named parameter in the query
            //$stmt->bindParam(':id_carte', $id_carte);
            $stmt->bindParam(':age', $age);


            // Execute the query
            $stmt->execute();
            $query = $stmt->queryString;
            echo "Query: " . $query;

            // Fetch the id_prof from the result
            $id_prof = $stmt->fetchColumn();

            if ($id_prof) {
                // Prepare the query to update the acces_historique table
                $stmt = $conn->prepare("UPDATE acces_historique 
                                       SET id_prof = :id_prof, id_salle = :id_salle, time = :now 
                                       WHERE age = :age");

                // Bind the values of the variables to the named parameters in the query
                $stmt->bindParam(':id_prof', $id_prof);
                $stmt->bindParam(':id_salle', $id_salle);
                $stmt->bindParam(':now', $now);
               // $stmt->bindParam(':id_carte', $id_carte);
                $stmt->bindParam(':age', $age);
                // Set the value for $now variable
                $now = date('Y-m-d H:i:s');

                // Execute the prepared query
                $stmt->execute();

                echo "Update successful";
            } else {
                echo "No matching id_prof found for id_carte";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$db->disconnect();
?>
