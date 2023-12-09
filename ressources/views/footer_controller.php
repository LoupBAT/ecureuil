<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

if (isset($_POST['submit'])) {

    $nom = $_POST['email'];
    $email = $_POST['name'];
    $message = $_POST['message'];

    // On verifie les doublons
    $checkDuplicate = $bdd->prepare('SELECT COUNT(*) FROM messages WHERE email = :email AND name = :name AND message = :message');
    $checkDuplicate->execute(array('email' => $email, 'name' => $nom, 'message' => $message));

    $count = $checkDuplicate->fetchColumn();

    if ($count == 0) {
        $insertMessage = $bdd->prepare('INSERT INTO messages (email, name, message) VALUES (:email, :name, :message)');
        $insertMessage->execute(array('email' => $email, 'name' => $nom, 'message' => $message));

        // Redirection vers la page actuelle
        $redirect_url = $_POST['redirect_url'];
        header("Location: " . $redirect_url);
        exit;
    } else {
        echo "Un message avec cet email, ce nom et ce contenu existe déjà.";
    }
}
