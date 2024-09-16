<?php
require_once 'config.php';

// Vérifier si une demande de suppression a été faite
if (isset($_POST['delete_user'])) {
    $userId = $_POST['id'];

    // Préparer et exécuter la requête de suppression
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $dbConnex->prepare($deleteQuery);
    $stmt->execute([$userId]);
}

// Récupérer la liste des utilisateurs
$query = "SELECT * FROM users";
$stmt = $dbConnex->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Location: http://localhost:8585/listUsers.php");
exit();  
?>