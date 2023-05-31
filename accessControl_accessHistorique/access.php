<?php

require_once 'database.php';
$db = new database('localhost', 'root', 'root2023*', 'school');
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
            $id_carte = $UIDresult; 
            $id_salle = 'A_TD1';
            $now = date('Y-m-d H:i:s');
        
            $stmt = $conn->prepare("SELECT id_prof FROM professeur WHERE id_carte = :id_carte");
            $stmt->bindParam(':id_carte', $id_carte);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                $id_prof = $result['id_prof'];
        
                $stmt = $conn->prepare("INSERT INTO acces_historique (id_prof, id_salle, time) 
                                       VALUES (:id_prof, :id_salle, :now)");
                $stmt->bindParam(':id_prof', $id_prof);
                $stmt->bindParam(':id_salle', $id_salle);
                $stmt->bindParam(':now', $now);
                $stmt->execute();
        
                echo "Insertion successful";
            } else {
                echo "No Data Found";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }    
}

$db->disconnect();
?>
