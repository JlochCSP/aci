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
$sql = "SELECT name FROM course";
$temp = $conn->query($sql);
$name = $_POST['name'];
if($name == "" || $name == " "){
    http_response_code(400);
    return;
}
while($row = $temp->fetch_assoc()){
    if($nam ==  $row['name']){
        http_response_code(400);
        return;
    }
}
$status = $_POST['status'];
if($status == "scheduled" || $status == "in_production" || $status == "available"){
} else {
    http_response_code(400);
    return;
}
$sql = "INSERT INTO course (id, name, status, createdAt, updatedAt, deletedAt)
VALUES (NULL, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $name, $status);
$stmt->execute();
http_response_code(201);
?>