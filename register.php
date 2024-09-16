<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        /* Polices Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* Styles généraux */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            align-items: center;
            height: 100vh;
            padding: 0;
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
            font-size: 24px;
            color: #3498db;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            font-size: 14px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #3498db;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Lien vers la connexion */
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Ajustement des messages PHP (si applicable) */
        .php-output {
            margin-bottom: 15px;
            color: #e74c3c;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <form action="traitement_inscription.php" method="POST">
        <h1>Inscription</h1>

        <!-- Nom -->
        <div>
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" placeholder="Entrez votre nom" required>
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
        </div>

        <!-- Mot de passe -->
        <div>
            <label for="password-1">Mot de passe:</label>
            <input type="password" id="password-1" name="password-1" placeholder="Entrez votre mot de passe" required>
        </div>

        <!-- Confirmer le mot de passe -->
        <div>
            <label for="password-2">Confirmer le mot de passe:</label>
            <input type="password" id="password-2" name="password-2" placeholder="Confirmez votre mot de passe" required>
        </div>

        <!-- Date de naissance -->
        <div>
            <label for="date_naissance">Date de naissance:</label>
            <input type="date" id="date_naissance" name="date_naissance" required>
        </div>

        <!-- Parcours -->
        <?php
        require_once 'config.php';
        $sql = "SELECT * FROM parcours";

        $stmt = $dbConnex->prepare($sql);
        $stmt->execute();
        echo "<label for='parcours'>Parcours:</label>";
        echo "<select name='parcours' id='parcours'>";

        while ($lineData = $stmt->fetch()) {
            echo "<option value='" . $lineData['id'] . "'>" . $lineData['name'] . "</option>";
        }

        echo "</select>";
        ?>

        <!-- Bouton de soumission -->
        <input type="submit" value="S'inscrire">

        <!-- Lien vers la connexion -->
        <a href="login.php">Se connecter</a>
    </form>

</body>

</html>