<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require './session_config.php';
require('../Class/Thematic.php');
require('../Class/Platform.php');
require('../Class/Card.php');
require('../Class/Message.php');
require('../Class/UserBanned.php');


//Creation d'une platforme
if (isset($_POST['create_platform'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $img = $_POST['img'];

    Platform::createPlatform($name, $description, $link, $img);

    header("Location: dashboard.php");
    exit;
}

//Supression d'une platforme
if (isset($_POST['delete_platform'])) {
    $platformId = $_POST['platform_id'];

    Platform::deletePlatform($platformId);

    header("Location: dashboard.php");
    exit;
}

//Mise à jour d'une platforme
if (isset($_POST['update_platform'])) {
    $platformId = $_POST['platform_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $img = $_POST['img'];

    Platform::editPlatform($platformId, $name, $description, $link, $img);

    header("Location: dashboard.php");
    exit;
}

//Création d'une thématique
if (isset($_POST['create_thematic'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $color = $_POST['color'];

    Thematic::createThematic($name, $description, $color);

    header("Location: dashboard.php");
    exit;
}

//Supression d'une thématique
if (isset($_POST['delete_thematic'])) {
    $thematicId = $_POST['thematic_id'];

    Thematic::deleteThematic($thematicId);

    header("Location: dashboard.php");
    exit;
}

//Mise à jour d'une thématique
if (isset($_POST['update_thematic'])) {
    $thematicId = $_POST['thematic_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $color = $_POST['color'];

    Thematic::editThematic($thematicId, $name, $description, $color);

    header("Location: dashboard.php");
    exit;
}

//Vérifier une fiche
if (isset($_POST['verify_card'])) {
    $cardId = $_POST['card_id'];

    Card::verifyCard($cardId);

    header("Location: dashboard.php");
    exit;
}

//Vérifier un message
if (isset($_POST['verify_message'])) {
    $messageId = $_POST['message_id'];

    Message::verifyMessage($messageId);

    header("Location: dashboard.php");
    exit;
}

//Unban un utilisateur
if (isset($_POST['unBan'])) {
    $banId = $_POST['ban_id'];
    UserBanned::unBan($banId);

    header("Location: dashboard.php");
    exit;
}

//Delete une fiche
if (isset($_POST['delete_card'])) {
    $cardId = $_POST['card_id'];
    Card::deleteCardById($cardId);

    header("Location: dashboard.php");
    exit;
}
include 'dashboard.php';
