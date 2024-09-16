<?php
$dbHost = "localhost";
$dbName = "dbUser";
$user = "toavina";
$passwd = "azertyuiop";

try {
    $dbConnex = new PDO("mysql:host=$dbHost;dbname=$dbName", $user, $passwd);
    $dbConnex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
