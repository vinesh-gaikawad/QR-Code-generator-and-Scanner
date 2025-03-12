<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"));

if (isset($data->name)) {
    $name = $conn->real_escape_string($data->name);

    $sql = "INSERT INTO attendance (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Attendance recorded"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

$conn->close();
?>
