<?php
global $bdd;
require './session_config.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/ressources/Controller/forumController.php');
$forumController = new ForumController();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
    <title>Efficiency - Forum</title>
    <script>
        function redirectToPost(url) {
            window.location.href = url;
        }
    </script>
    <style>
        .forum-body {
            font-family: "Poppins", sans-serif;
            background-color: #ecf0f1;
            padding-bottom: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: fit-content;
            min-height: 100%;
        }

        header {
            background-color: #2ce6c1;
            color: #ffffff!important;
            padding-top: 25px;
            text-align: center;
            font-size: 40px;
            width: 100vw;
            font-family: "Poppins", sans-serif;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #featured-posts {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            max-width: 700px;
            margin-top: 20px;
            width: 700px;
        }

        #my-posts {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            max-width: 700px;
            margin-top: 20px;
            width: 700px;
        }

        #recent-posts {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            max-width: 700px;
            margin-top: 20px;
            width: 700px;
        }


        .search-bar {
            margin-top: 20px;
        }

        input[type="text"],
        textarea{
            padding: 10px;
            font-size: 16px;
            border: 1px solid #bdc3c7;
            border-radius: 15px;
            width: 300px;
        }


        .section-title {
            font-family: "Poppins", sans-serif;
            font-size: 25px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .post-forum {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .post-like-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-right: 20px;
            border-right: 2px solid #abeede;
        }


        #like-icon {
            width: 75%;
            height: 75%;
            margin: auto;
        }

        .form-create {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: fit-content;
            margin-top: 40px;
        }

        .form-create div {
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: fit-content;
            margin: 20px;
        }

        .form-create div label {
            width: 80px;
            margin: 20px;
        }


        .form-create div input,
        .form-create div textarea {
            justify-content: center;
            width: 600px;
            margin: 20px;
        }

        .form-create .submit input {
            background-color: #2ce6c1;
            color: #ffffff;
            width: fit-content;
            border-radius: 15px;
            padding: 20px;

        }

        .form-body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 700px;
            margin-top: 40px;
        }

    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>


<div class="forum-body">
    <header>
        <p class='w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-white sm:text-4xl pb-4 mt-4'>FORUM</p>
    </header>


    <p class="w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 mt-8 border-b-4 border-[#2CE6C1]">Créer un Post</p>

    <?php
    if (User::getSessionUser($bdd)) {
        echo "<div class='form-body'>";
        $forumController->showPostForm();
        echo "</div>";
    }else {
        echo "<div class='form-body'>";
        echo "<p>Vous devez être connecté pour pouvoir poster un message.</p>";
        echo "</div>";
    }
    ?>
    </div>

</body>

</html>