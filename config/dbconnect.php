<?php

require_once "./dbconfig.php";

$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8";
$username = $DB_USER;
$password = $DB_PASSWORD;

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>
