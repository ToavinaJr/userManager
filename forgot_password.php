<?php

require_once 'config.php'; // Connexion à la base de données et configuration

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fonction pour générer un token unique
function generateToken($length = 50) {
    return bin2hex(random_bytes($length / 2));
}

$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Vérifier si l'email existe dans la base de données
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $dbConnex->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Générer un token de réinitialisation et la date d'expiration (1 heure)
        $resetToken = generateToken();
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Stocker le token et l'expiration dans la base de données
        $updateQuery = "UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?";
        $stmt = $dbConnex->prepare($updateQuery);
        $stmt->execute([$resetToken, $expiry, $email]);

        // Créer le lien de réinitialisation
        $resetLink = "http://localhost:8000/reset_password.php?token=" . $resetToken;
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : " . $resetLink;
        $headers = "From: no-reply@votre-site.com\r\n";

        // Envoyer l'email
        if (mail($email, $subject, $message, $headers)) {
            $successMessage = "Un email de réinitialisation de mot de passe a été envoyé.";
        } else {
            $errorMessage = "Un erreur c'est produite lors de l'envoie de l'email";
        }
    } else {
        $errorMessage = "Aucun utilisateur trouvé avec cet email.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .container {
            width: 500px;
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

        input[type="email"] {
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
        nav {
            width: 500px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Mot de passe oublié</h1>

    <?php if ($errorMessage): ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php if ($successMessage): ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <form method="POST" action="forgot_password.php">
        <label for="email">Entrez votre email :</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Envoyer</button>
    </form>

    
</div>
<div class="container">
    <nav>
        <a href="login.php"><button>Login</button></a>
        <a href="register.php"><button>Register</button></a>
    </nav>
</div>
</body>

</html>
