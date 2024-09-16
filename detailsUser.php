<?php
// Inclure le fichier de configuration contenant les paramètres de connexion à la base de données
require_once 'config.php';

// Récupérer l'identifiant de l'utilisateur à partir de la requête GET
$userId = $_GET['id'];

// Préparer et exécuter la requête pour récupérer les informations de l'utilisateur basé sur son identifiant
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $dbConnex->prepare($query); // Préparer la requête SQL
$stmt->execute([$userId]); // Exécuter la requête avec l'identifiant de l'utilisateur
$user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupérer les informations de l'utilisateur

// Vérifier si l'utilisateur a été trouvé
if (!$user) {
    // Afficher un message d'erreur si l'utilisateur n'est pas trouvé
    echo "Utilisateur non trouvé.";
    exit; // Arrêter l'exécution du script
}

// Préparer et exécuter la requête pour récupérer les informations du parcours de l'utilisateur
$queryParcours = "SELECT * FROM parcours WHERE id = ?";
$stmtParcours = $dbConnex->prepare($queryParcours); // Préparer la requête SQL
$stmtParcours->execute([$user['id_parcours']]); // Exécuter la requête avec l'identifiant du parcours de l'utilisateur
$parcours = $stmtParcours->fetch(PDO::FETCH_ASSOC); // Récupérer les informations du parcours
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'utilisateur</title>
    <style>
        /* Styles pour la page de détails de l'utilisateur */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .details-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #3498db;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        strong {
            text-decoration: underline;
            color: #3a3a3a;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="details-container">
        <h2>Détails de l'utilisateur</h2>

        <!-- Affichage des détails de l'utilisateur -->
        <p><strong>Nom:</strong> <br><?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <br><?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Date de naissance:</strong> <br><?php echo htmlspecialchars($user['dateNaissance']); ?></p>
        <p><strong>Parcours:</strong> <br><?php echo htmlspecialchars($parcours['name']); ?></p>

        <!-- Lien pour retourner à la liste des utilisateurs -->
        <a href="listUsers.php">Retour à la liste</a>
    </div>

</body>

</html>
