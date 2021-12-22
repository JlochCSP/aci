<?php

header('Content-type: application/json');

define('SERVER_NAME', 'localhost');
define('DATABASE_NAME', 'acidb');
define('DBF_USER_NAME', 'root');
define('DBF_PASSWORD', 'mysql');

$conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$conn->select_db(DATABASE_NAME);

$sql = "SELECT * FROM course WHERE deletedAt IS NULL ORDER BY createdAt";
$result = $conn->query($sql);

$courses = array();
while($row = $result->fetch_assoc( )){
    $courses[] = $row;
}
$finalArr = array("courses" => $courses);
echo json_encode($finalArr);
?>