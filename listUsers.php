<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !$_SESSION['user_name']) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit;
}

require_once 'config.php';

// Vérifier si une demande de suppression a été faite
if (isset($_POST['delete_user'])) {
    $userId = $_POST['id'];

    // Préparer et exécuter la requête de suppression
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $dbConnex->prepare($deleteQuery);
    $stmt->execute([$userId]);
}

// Récupérer la liste des utilisateurs
$query = "SELECT * FROM users";
$stmt = $dbConnex->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <style>
        /* Importer la police Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #3498db;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"] {
            background-color: #e74c3c;
        }

        button[type="submit"]:hover {
            background-color: #c0392b;
        }

        button[type="button"] {
            background-color: #2ecc71;
        }

        button[type="button"]:hover {
            background-color: #27ae60;
        }

        form {
            display: inline;
        }

        a {
            text-decoration: none;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .error-message i {
            font-size: 24px;
            margin-right: 10px;
        }

        .error-message p {
            margin: 0;
        }

        .details-btn button {
            background-color: #3498db;
        }

        .details-btn:hover {
            background-color: #27ae60;
        }

        #add-user {
            background-color: #3498db;
            margin: 20px 0;
            padding: 10px;
            width: fit-content;
            border-radius: 10px;
        }

        #add-user a {
            color: #fff;
        }

        #add-user:hover a {
            color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>Liste des Utilisateurs</h1>
    <div id="add-user">
        <a href="register.php">Ajouter un utilisateur</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                        <button type="submit" name="delete_user">Supprimer</button>
                    </form>
                    <a href="edit_user.php?id=<?php echo htmlspecialchars($user['id']); ?>">
                        <button type="button">Modifier</button>
                    </a>
                    <a href="detailsUser.php?id=<?php echo $user['id']; ?>" class="details-btn">
                        <button type="button">Détails</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Button pur la déconnexion -->
    <a href="logout.php">Deconnexion</a>
    
</body>

</html>
