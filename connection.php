<?php
$servername = "127.0.0.1";
$username = "root";
$password = "benji";
$dbname = "Project";

$conn =new mysqli($servername, $username, $password, $dbname);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch(PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
?>