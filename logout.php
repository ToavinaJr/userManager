<?php
session_start(); // Démarrer la session

// Supprimer les variables de session spécifiques
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);

// Vérifier si la session est vide, sinon détruire la session entière
if (empty($_SESSION)) {
    session_destroy(); // Détruire la session si elle est vide
}

// Rediriger vers la page de connexion
header('Location: login.php');
exit;
?>
