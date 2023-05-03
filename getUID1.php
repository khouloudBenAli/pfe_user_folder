<?php

    require_once 'database.php';
    $db = new database('localhost', 'root', '', 'school');
    $conn = $db->connect();

    $UIDresult = "";
    $Sc = "";
    $MACresult = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {                        // Check if the request method is POST
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data["UIDresult"], $data["Sc"])) {                   // Check if "UIDresult" and "Sc" exist in the associative array $data
            $UIDresult = $data["UIDresult"];
            $Sc = $data["Sc"]; 
            $MACresult = $data["MACresult"];

            echo "recieved data from php";
            echo "UIDresult: " . $UIDresult;
            echo "Sc: " . $Sc;
            echo "MACresult: " . $MACresult;

            
            try {
                $id_student = $UIDresult;// ID recupereted from requete 
                $num_seance = $Sc; // Seance recupereted from requete 
                $status_student = 'Present';
                
                // Preparer la requete avec les variables "id" et "seance" en utilisant des paramztres nommzs
                 $stmt = $conn->prepare("UPDATE presence_student SET status_student = :status_student WHERE id_student = :id_student AND id_seance IN (SELECT id_seance FROM seance WHERE num_seance = :num_seance)");
                
                // Affecter les valeurs des variables aux parametres nommes dans la requete
                $stmt->bindParam(':id_student', $id_student);
                $stmt->bindParam(':num_seance', $num_seance);
                $stmt->bindParam(':status_student', $status_student);
                
                // Executer la requete preparee
                $stmt->execute();
            
                echo "Update successful";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
        }
    
    }  

    $db->disconnect();


?>


