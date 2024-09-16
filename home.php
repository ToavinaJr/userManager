<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !$_SESSION['user_name']) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Salutation</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur notre site <?php echo $_SESSION['user_name']; ?> !</h1>
        <p>Nous sommes ravis de vous accueillir . Profitez de votre visite !</p>
    </div>
    <!-- Button pur la déconnexion -->
    <div class="container">
        <a href="logout.php">Deconnexion</a>
    </div>
</body>
</html>
