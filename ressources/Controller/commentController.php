<?php
require('../Class/Comment.php');
//Creation d'un commentaire 
if (isset($_POST['create_Comment'])) {
    $content = $_POST['content'];
    $user = $_POST['user_id'];
    $card = $_POST['card_id'];

    Comment::commentCreate($content, $user, $card);

    header("Location:../views/fiche.php?fiche=" . $card);
    exit;
}
if (isset($_POST['likeCard'])) {
    $user = $_POST['user_id'];
    $card = $_POST['card_id'];

    CardLike::likeCard($card, $user);

    header("Location:../views/fiche.php?fiche=" . $card);
    exit;
}

//Supression d'un commentaire 
if (isset($_POST['delete_Comment'])) {
    $card = $_POST['card_id'];
    $commentId = $_POST['comment_id'];

    Comment::deleteCommentById($commentId);

    header("Location:../views/fiche.php?fiche=" . $card);
    exit;
}

//Edit contentText
if (isset($_POST['edit_contentText'])) {
    $cardId = $_POST['card_id'];
    $newContent = $_POST['new_content_text'];

    Card::editContentTextByCardId($cardId, $newContent);

    header("Location:../views/fiche.php?fiche=" . $cardId);
    exit;
}

//Edit code
if (isset($_POST['edit_code'])) {
    $cardId = $_POST['card_id'];
    $newCode = $_POST['new_code_text'];
    Card::editCodeByCardId($cardId, $newCode);

    header("Location:../views/fiche.php?fiche=" . $cardId);
    exit;
}
