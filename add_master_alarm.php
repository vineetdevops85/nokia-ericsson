<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "external_alarm_master";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $port = $_POST['port'];
    $slogan = $_POST['slogan'];
    $severity = $_POST['severity'];
    $normallyopen = $_POST['normallyopen'];

    $sql = "INSERT INTO master_alarm (port, slogan, severity, normallyopen) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $port, $slogan, $severity, $normallyopen);

    if ($stmt->execute()) {
        echo "New alarm added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
