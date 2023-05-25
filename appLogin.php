<?php

// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the username and password from the request
$username = $_POST["username"];
$password = $_POST["password"];

// Perform the query to check if the username and password match
$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

// Check if there is a match
if (mysqli_num_rows($result) > 0) {
    // Username and password are correct
    $row = mysqli_fetch_assoc($result);
    
    $response['success'] = 1;
    $response['message'] = "Login Successful";

    $type_user = $row['type'];
    
    if ($type_user == "admin") {
        $response['type'] = 1;
        $response['typemsg'] = "admin"; 
    } elseif ($type_user == "professeur") {
        $response['type'] = 2;
        $response['typemsg'] = "professeur";
    } else {
        $response['type'] = 0;
        $response['typemsg'] = "Invalid type";
    }
    // Add id_prof and id_admin to the response
    
    $response['id_prof']= $row['id_prof'];
    $response['id_admin'] =$row['id_admin'];
} else {
    // Username and password are incorrect
    $response['success'] = 0;
    $response['message'] = "Invalid Username or Password";
}

// Return the response in JSON format
echo json_encode($response);

// Close the connection
mysqli_close($conn);

?>
