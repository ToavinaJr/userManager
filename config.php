<?php
// Définir les paramètres de connexion à la base de données
$dbHost = "localhost";  // Adresse du serveur de base de données
$dbName = "dbUser";     // Nom de la base de données
$user = "toavina";      // Nom d'utilisateur pour se connecter à la base de données
$passwd = "azertyuiop"; // Mot de passe pour l'utilisateur

try {
    // Créer une nouvelle connexion PDO à la base de données
    $dbConnex = new PDO("mysql:host=$dbHost;dbname=$dbName", $user, $passwd);
    
    // Définir le mode de gestion des erreurs pour la connexion PDO
    // PDO::ERRMODE_EXCEPTION : les erreurs de la base de données lanceront des exceptions
    $dbConnex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'échec de la connexion, afficher le message d'erreur et arrêter l'exécution du script
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>
