<?php

include ("db_connect.php");

$response=array() ;

if( isset($_GET["id"]) ) 
{
    $id=$_GET["id"];

    $req=mysqli_query($cnx,  " select * from student where id='$id' ");
    if (mysqli_num_rows($req) > 0)
    {
        $tmp=array();

        $response["student"]=array();
        $cur=mysqli_fetch_array($req);
        
            $tmp["Id"]=$cur["Id"];
            $tmp["name"]=$cur["name"];
            $tmp["lastname"]=$cur["lastname"];
            $tmp["classe"]=$cur["classe"];

            array_push($response["student"],$tmp);  
            $response["success"]="1";
            echo Json_encode($response) ;
    }
   
    else

        {
            $response["success"]=0;
            $response["message"]="no data found !";
            echo Json_encode($response) ;
        }
}
else

{
    $response["success"]=0;
    $response["message"]="requerd fild is missing !";
    echo Json_encode($response) ;
}

?>