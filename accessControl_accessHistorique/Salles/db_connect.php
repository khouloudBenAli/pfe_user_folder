<?php
$cnx=mysqli_connect("localhost","root","root2023*");
if (!$cnx)
{

    echo"erreur de connexion au serveur";
} 

$db=mysqli_select_db($cnx,"school");
if (!$db)
{

    echo"erreur de connexion a la base";
} 

?>