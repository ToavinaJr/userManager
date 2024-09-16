<?php
require_once 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password1 = $_POST['password-1'];
$password2 = $_POST['password-2'];
$date_naissance = $_POST['date_naissance'];
$parcours = $_POST['parcours'];

if ($password1 != $password2) {
    include("forgot_password.php");
    exit;
}


$query = "SELECT * FROM users WHERE email=?";
$stmt = $dbConnex->prepare($query);
$stmt->execute([$email]);

// Tester si l'utilisateur est déjà dans la base de données 
if ($data = $stmt->fetch()) {
    echo "<p>L'email " . $data['email'] . " est déjà associée à un compte</p>";
} else {
    $addUserQuery = "INSERT INTO users (name, email, id_parcours, dateNaissance, password) VALUES (?, ?, ?, ?, ?)";

    $stmt = $dbConnex->prepare($addUserQuery);
    $stmt->execute([
        $name,
        $email,
        (int) $parcours,
        $date_naissance,
        password_hash($password1, PASSWORD_DEFAULT)
    ]);
}

header('Location: ./login.php');
