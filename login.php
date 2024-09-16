<?php
require_once 'config.php'; // Inclure votre fichier de configuration
session_start(); // Démarrer la session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier les informations de connexion
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $dbConnex->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        // Stocker des informations dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Rediriger vers la page d'accueil ou tableau de bord
        if ($user['name'] == 'admin')
            header('Location: listUsers.php');
        else 
            header('Location: home.php');
        exit;
    } else {
        if ($user && !password_verify($password, $user['password'])) {
            echo '<p> Mot de passe incorrecte </p>';
        } else if (!$user) {
            echo '<p>Utilisateur non trouvée </p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        /* Importer la police Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

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

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #3498db;
            font-size: 24px;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="email"],
        input[type="password"] {
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
        }

        input[type="submit"] {
            background-color: #3498db;
            border: none;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Styles pour le message d'erreur */
        p {
            color: #e74c3c;
            text-align: center;
            font-size: 14px;
        }

        /* Lien vers mot de passe oublié */
        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #3498db;
            font-size: 14px;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
        nav {
            width: 400px;
            margin: 10px;
            display: flex;
            justify-content: space-between;
        }
        nav a {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 10px;
            width: 40%;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    
    <form method="POST">
        <h1>Connexion</h1>
        <?php
        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
        ?>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Entrez votre email">

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required placeholder="Entrez votre mot de passe">

        <input type="submit" value="Se connecter">

        <!-- Lien mot de passe oublié -->
        <div class="forgot-password">
            <a href="forgot_password.php">Mot de passe oublié ?</a>
        </div>
    </form>
    <nav>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </nav>
</body>

</html>