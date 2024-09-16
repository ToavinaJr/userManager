<?php
// Inclure le fichier de configuration contenant les paramètres de connexion à la base de données
require_once 'config.php';

// Vérifier si une demande de suppression a été faite via un formulaire
if (isset($_POST['delete_user'])) {
    // Récupérer l'identifiant de l'utilisateur à supprimer depuis la requête POST
    $userId = $_POST['id'];

    // Préparer la requête SQL pour supprimer un utilisateur en fonction de son identifiant
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $dbConnex->prepare($deleteQuery); // Préparer la requête SQL
    $stmt->execute([$userId]); // Exécuter la requête avec l'identifiant de l'utilisateur
}

// Préparer la requête SQL pour récupérer tous les utilisateurs de la base de données
$query = "SELECT * FROM users";
$stmt = $dbConnex->prepare($query); // Préparer la requête SQL
$stmt->execute(); // Exécuter la requête
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les résultats de la requête sous forme de tableau associatif

// Rediriger l'utilisateur vers la page listant les utilisateurs après l'opération
header("Location: http://localhost:8585/listUsers.php");
exit(); // Arrêter l'exécution du script pour éviter tout code additionnel après la redirection
?>
