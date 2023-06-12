<?php

require_once 'database.php';
$db = new database('localhost', 'root', '', 'school');
$conn = $db->connect();



/*    KHOULOUD
$id_student = '243163157146'
$num_seance ='3'
$id_salle = 'C_TD5';          */
 

try {
    $id_student = '50'; 
    $id_prof = 'A';
    $num_seance = 2;
    $id_salle = 'C_TD1';

    $stmt = $conn->prepare("SELECT st.Id, st.name, 
                                 p.id_prof, p.full_name
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
                            seance s1 
                            ON 
                            s1.id_seance = sc.id_seance
                                
                            INNER JOIN 
                            salle_seance ss 
                            ON 
                            ss.id_seance = s1.id_seance
                                
                            INNER JOIN 
                            salle sl 
                            ON 
                            sl.id_salle = ss.id_salle
                                
                            INNER JOIN 
                            prof_seance pc 
                            ON 
                            pc.id_seance = s1.id_seance
                                
                            INNER JOIN 
                            professeur p 
                            ON 
                            p.id_prof = pc.id_prof
                                
                            WHERE p.id_prof = :id_prof
                                AND st.Id  = :id_student
                                AND s1.num_seance = :num_seance 
                                /*AND s1.jour = CURDATE()*/
                                AND sc.jour = CURDATE()
                                AND pc.jour = CURDATE()
                                AND ss.id_salle=:id_salle ;");


    $stmt->bindParam(':id_student', $id_student);
    $stmt->bindParam(':id_prof', $id_prof);
    $stmt->bindParam(':num_seance', $num_seance);
    $stmt->bindParam(':id_salle', $id_salle);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        
        $status_student = 'Present';
        $status_prof = 'Present';
        $dataJour = CURDATE() ;

        $stmt = $conn->prepare("INSERT INTO 
                               presence_student (id_student, id_seance, status_student , jour) 
                               VALUES (:id_student, 
                                      (SELECT id_seance FROM seance WHERE num_seance = :num_seance), 
                                      :status_student,
                                      :dataJour) ;
                                
                              INSERT INTO   
                              presence_prof (id_prof, id_seance, status_prof , jours) 
                              VALUES (:id_prof, 
                                    (SELECT id_seance FROM seance WHERE num_seance = :num_seance), 
                                    :status_prof,
                                    :dataJour)  ;
                                      
                                      
                                      ");

        $stmt->bindParam(':id_student', $id_student);
        $stmt->bindParam(':id_prof', $id_prof);
        $stmt->bindParam(':num_seance', $num_seance);
        $stmt->bindParam(':status_student', $status_student);
        $stmt->bindParam(':status_prof', $status_prof);
        $stmt->bindParam(':dataJour', $dataJour);
        $stmt->execute();

        echo "Insertion successful";
    } else {
        echo "No Data Found ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$db->disconnect();
