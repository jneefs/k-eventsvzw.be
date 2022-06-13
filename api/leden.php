<?php
include "../config/config.php";

$stmt = $pdo->query("SELECT * FROM leden");
$leden = $stmt->fetchAll();

echo json_encode($leden);