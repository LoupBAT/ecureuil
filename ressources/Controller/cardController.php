<?php

$card = $bdd->prepare("SELECT * FROM cards");
$card->execute();

$cards = [];

while ($row = $card->fetch(PDO::FETCH_ASSOC)) {
    $cards[] = new Card($row['id'], $row['title'], $row['contentText'], $row['gitHub'], $row['status'], $row['upVote'], $row['createdDate'], $row['updatedDate'], $row['summary'], $row['user'], $row['thematic'], $row['platform'], $row['img']);
}
return $cards;

function addCard($bdd, $data)
{
    if (isset($data['submit'])) {
        $title = $data['cardTitle'];
        $summary = $data['cardSummary'];
        $platform = $data['cardPlateforme'];
        $thematic = $data['cardTheme'];
        $contentText = $data['cardContent'];
        $gitHub = $data['cardGitHub'];

        // Vous pouvez effectuer des vérifications ou des validations ici
        // Puis insérer les données dans la base de données

        // Vérifiez si un fichier a été téléchargé et gérez le téléchargement du fichier (à adapter)
        if (isset($_FILES['cardImg'])) {
            $file = $_FILES['cardImg'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileType = $file['type'];

            // Exemple :
            $uploadDirectory = 'votre_dossier_d_upload/';
            $targetFile = $uploadDirectory . $fileName;
            move_uploaded_file($fileTmpName, $targetFile);
        }


        // Ajoutez les données dans la base de données
        $insertQuery = $bdd->prepare("INSERT INTO cards (title, summary, platform, thematic, contentText, gitHub, img) VALUES (:title, :summary, :platform, :thematic, :contentText, :gitHub, :img)");
        $insertQuery->bindParam(':title', $title);
        $insertQuery->bindParam(':summary', $summary);
        $insertQuery->bindParam(':platform', $platform);
        $insertQuery->bindParam(':thematic', $thematic);
        $insertQuery->bindParam(':contentTexte', $contentText);
        $insertQuery->bindParam(':gitHub', $gitHub);
        $insertQuery->bindParam(':img', $fileName);

        if ($insertQuery->execute()) {
            // Insertion réussie
            return true;
        } else {
            // Échec de l'insertion
            return false;
        }
    }
}
