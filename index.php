<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <style>
        /* Importer la police Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }


        nav {
            text-align: center;
            margin: 0;
            background-color: #3498db;
            padding: 20px;
        }

        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .welcome {
            text-align: center;
            margin: 50px 0;
        }

        .welcome h2 {
            color: #3498db;
            font-size: 24px;
        }

        .welcome p {
            color: #555;
            font-size: 16px;
            margin: 10px 0;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <nav>
        <a href="login.php">Se connecter</a>
        <a href="register.php">S'inscrire</a>
    </nav>

    <div class="welcome">
        <h2>Bienvenue sur notre page d'accueil</h2>
        <p>Nous sommes ravis de vous voir ici. Explorez notre site pour en savoir plus sur nos services.</p>
    </div>

    <footer>
        <p>&copy; 2024 MonSite. Tous droits réservés.</p>
    </footer>

</body>

</html>