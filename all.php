<?php
include ("db_connect.php");

$response=array() ;
//$req=mysqli_query($cnx," select * from student ");
$req = mysqli_query($cnx, "SELECT * FROM presence_student INNER JOIN student ON presence_student.id_student = student.Id");


if (mysqli_num_rows($req) > 0)
{
    $tmp=array();
    $response["student"]=array();
    while($cur=mysqli_fetch_array($req))
    {
        $tmp["Id"]=$cur["Id"];
        $tmp["name"]=$cur["name"];
        $tmp["lastname"]=$cur["lastname"];
        $tmp["age"]=$cur["age"];
        $tmp["id_classe"]=$cur["id_classe"];

        array_push($response["student"],$tmp);
    }
    $response["success"]="1";
    $response["message"]="success";
    echo Json_encode($response) ;
}
else

	{
		$response["success"]=0;
		$response["message"]="no data found !";
		echo Json_encode($response) ;
    }

?>