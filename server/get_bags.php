<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM bags LIMIT 4");
$stmt->execute();

$bags = $stmt->get_result();
?>
