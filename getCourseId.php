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
$id = $_GET['id'];
$sql = "SELECT * FROM course WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
$course = array();
$course = $result->fetch_assoc();
if($course['id'] != ""){
    if($course['deletedAt'] == ""){ 
        echo json_encode($course);
        http_response_code(200);
    } else {
        http_response_code(410);
    }
} else {
    http_response_code(404);
}
?>