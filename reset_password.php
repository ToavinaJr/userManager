<?php
require_once 'config.php'; // Connexion à la base de données et configuration

$errorMessage = '';
$successMessage = '';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Vérifier si le token existe et n'est pas expiré
    $query = "SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
    $stmt = $dbConnex->prepare($query);
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Vérifier que les deux mots de passe correspondent
            if ($newPassword === $confirmPassword) {
                // Hacher le nouveau mot de passe
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Mettre à jour le mot de passe dans la base de données
                $updateQuery = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?";
                $stmt = $dbConnex->prepare($updateQuery);
                $stmt->execute([$hashedPassword, $user['id']]);

                $successMessage = "Votre mot de passe a été réinitialisé avec succès.";
            } else {
                $errorMessage = "Les mots de passe ne correspondent pas.";
            }
        }
    } else {
        $errorMessage = "Le lien de réinitialisation est invalide ou a expiré.";
    }
} else {
    $errorMessage = "Aucun token fourni.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #3498db;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Réinitialiser le mot de passe</h1>

    <?php if ($errorMessage): ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php if ($successMessage): ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <?php if (!isset($successMessage) || empty($successMessage)): ?>
        <form method="POST" action="reset_password.php?token=<?php echo htmlspecialchars($token); ?>">
            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirmez le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Réinitialiser</button>
        </form>
    <?php endif; ?>
</div>
<div class="container">
    <a href="login.php">Se connécter maintenant</a>
</div>
</body>

</html>
