<?php
include '../../layout.php';
require('../Class/Card.php');
require('../Class/Message.php');
require('../Class/UserBanned.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function modifyUserDetails($id, $newData)
{
    try {
        global $bdd;
        var_dump($newData);

        // Définir la requête SQL pour mettre à jour les détails de l'utilisateur
        $query = "UPDATE users 
                   SET 
                      nickname = :nickname,
                      lastName = :lastName, 
                      firstName = :firstName, 
                      email = :email";

        // Si un nouveau mot de passe a été fourni, inclure la colonne "password" dans la requête
        if (isset($newData['password']) && !empty($newData['password'])) {
            $query .= ", password = :password ";
        }
        // Terminez la requête avec la clause WHERE pour spécifier l'utilisateur à mettre à jour
        $query .= "WHERE id = :id";


        // Préparer la requête SQL
        $stmt = $bdd->prepare($query);

        // Liage des paramètres
        $stmt->bindParam(':nickname', $newData['nickname']); // Assurez-vous de disposer d'une clé 'nickname' dans $newData
        $stmt->bindParam(':lastName', $newData['lastName']);
        $stmt->bindParam(':firstName', $newData['firstName']);
        $stmt->bindParam(':email', $newData['email']);
        if (isset($newData['password']) && !empty($newData['password'])) {
            $hashedPassword = password_hash($newData['password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword);
        }
        $stmt->bindParam(':id', $id);

        // Exécuter la requête SQL
        $stmt->execute();

        // La mise à jour a réussi
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des données : " . $e->getMessage();
        // En cas d'erreur, vous pouvez choisir de la gérer ici.
        // Par exemple, affichez un message d'erreur ou enregistrez-le dans un fichier de journal.
        // Pour l'instant, nous retournons false en cas d'erreur.
        return false;
    }
}

if (isset($_POST['save'])) {
    $userId = $_POST['user_id']; // Assurez-vous d'avoir un champ caché pour l'ID de l'utilisateur
    $newData = [
        'nickname' => $_POST['nickname'],
        'lastName' => $_POST['lastName'],
        'firstName' => $_POST['firstName'],
        'email' => $_POST['email'],
        'password' => $_POST['new_password'],
    ];

    // Ajoutez ici la vérification des mots de passe
    if (!empty($newData['password']) && $newData['password'] !== $_POST['confirm_password']) {
        echo "Les mots de passe ne correspondent pas.";
        return false;
    }

    // Si l'URL de l'image de profil est fournie dans le deuxième formulaire


    // Appelez votre fonction de mise à jour des détails de l'utilisateur (à l'exception de l'image de profil)
    if (modifyUserDetails($userId, $newData)) {
        // La mise à jour a réussi, redirigez l'utilisateur ou affichez un message de succès
        header('Location:../views/profil.php?user=' . $userId);
        exit;
    } else {
        // La mise à jour a échoué, affichez un message d'erreur si nécessaire
        echo "Erreur lors de la mise à jour des informations.";
        return false;
    }
}

function updateProfilePicture($userId, $newProfilePictureUrl)
{
    global $bdd;

    // Utilisez une requête préparée pour mettre à jour le champ "profilPicture" dans la base de données
    $sql = "UPDATE users SET profilPicture = :profilePicture WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':profilePicture', $newProfilePictureUrl);
    $stmt->bindParam(':id', $userId);

    try {
        // Exécutez la requête SQL
        $stmt->execute();

        // La mise à jour a réussi, redirigez l'utilisateur
        header('Location: ../views/profil.php');
        exit;
    } catch (PDOException $e) {
        // La mise à jour a échoué, affichez un message d'erreur si nécessaire
        echo "Erreur lors de la mise à jour des informations : " . $e->getMessage();
        return false;
    }
}

// Appelez la fonction avec l'ID de l'utilisateur et l'URL de la nouvelle image de profil
if (isset($_POST['update_profile_picture'])) {
    $userId = $_POST['user_id']; // Assurez-vous d'avoir un champ caché pour l'ID de l'utilisateur
    $newProfilePictureUrl = $_POST['profile_picture'];

    // Appelez la fonction pour mettre à jour l'image de profil
    updateProfilePicture($userId, $newProfilePictureUrl);
}

//Ban un utilisateur
if (isset($_POST['banned'])) {
    $banId = $_POST['ban_id'];
    $message = $_POST['message'];
    UserBanned::ban($banId, $message);

    header('Location:../views/dashboard.php');
    exit;
}
