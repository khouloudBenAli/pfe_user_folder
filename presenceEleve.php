<?php

    require_once 'database.php';
    $db = new database('localhost', 'root', '', 'school');
    $conn = $db->connect();

    $UIDresult = "";
    $Sc = "";
    $MACresult = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {                            // Check if the request method is POST
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data["UIDresult"], $data["Sc"], $data["MACresult"])) {   // Check if "UIDresult" and "Sc" exist in the associative array $data
            $UIDresult = $data["UIDresult"];
            $Sc = $data["Sc"]; 
            $MACresult = $data["MACresult"];

            echo "recieved data from php";
            echo "UIDresult: " . $UIDresult;
            echo "Sc: " . $Sc;
            echo "MACresult: " . $MACresult;

            
            try {
                $id_student = $UIDresult;   // ID recupereted from requete 
                $num_seance = $Sc;          // Seance recupereted from requete 
                $id_salle = $MACresult      // salle recupereted from requete
                $status_student = 'Present';
                
                $stmt = $conn->prepare("SELECT Id, name
                            FROM student st

                            INNER JOIN 
                            classe cl 
                            ON 
                            st.id_classe = cl.id_classe


                            INNER JOIN 
                            seance_classe sc 
                            ON 
                            cl.id_classe = sc.id_classe

                            INNER JOIN 
                            seance s 
                            ON 
                            s.id_seance = sc.id_seance

                            INNER JOIN 
                            salle_seance ss 
                            ON 
                            ss.id_seance = s.id_seance

                            INNER JOIN 
                            salle sl 
                            ON 
                            sl.id_salle = ss.id_salle

                            WHERE st.Id = :id_student 
                            AND s.num_seance = :num_seance 
                            AND s.jour = CURDATE() 
                            AND ss.id_salle = :id_salle");

                $stmt->bindParam(':id_student', $id_student);
                $stmt->bindParam(':num_seance', $num_seance);
                $stmt->bindParam(':id_salle', $id_salle);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    
                    $status_student = 'Present';

                    $stmt = $conn->prepare("INSERT INTO 
                                        presence_student (id_student, id_seance, status_student) 
                                        VALUES (:id_student, 
                                                (SELECT id_seance FROM seance WHERE num_seance = :num_seance), 
                                                :status_student)");

                    $stmt->bindParam(':id_student', $id_student);
                    $stmt->bindParam(':num_seance', $num_seance);
                    $stmt->bindParam(':status_student', $status_student);
                    $stmt->execute();

                    echo "Insertion successful";
                } else {
                    echo "No Data Found ";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
                
        }
    
    }  

    $db->disconnect();


?>