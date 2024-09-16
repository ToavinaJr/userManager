<?php
$email = "toav@gmail.com";
$subject = "uiefghusidgdusgu";
$message = "uiefghusidgdusgu";
$headers = "From:ojzoij@glakklz.com\r\n";

if (mail($email, $subject, $message, $headers)) {
    echo "Email envoyé avec succès";
} else {
    echo "Erreur lors de l'envoi de l'email";
}

