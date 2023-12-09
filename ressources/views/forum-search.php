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
            background-color: #ecf0f1;
            margin: 0;
            padding: 15px 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: fit-content;
            min-height: 100%;
        }

        header {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 40px;
            width: 100%;
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

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #bdc3c7;
            border-radius: 15px 0px 0px 15px;
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

        .like-count {
            font-family: "Poppins", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        .like-button {
            width: 30px;
            height: 30px;
            background-image: url("/ressources/images/like.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            cursor: pointer;
        }

        .description-post {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            width: 70%;
            padding-left: 20px;
        }

        .title-post {
            font-family: "Poppins", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        .author-post {
            font-family: "Poppins", sans-serif;
            font-size: 15px;
            margin: 0;
        }

        .date-post {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            width: 30%;
        }

        .created-date {
            font-family: "Poppins", sans-serif;
            font-size: 15px;
            margin: 0;
        }

        .post-forum:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .post-forum:active {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #like-icon {
            width: 75%;
            height: 75%;
            margin: auto;
        }

        form {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 700px;
            margin-top: 40px;
        }

        form button {
            border-radius: 0px 15px 15px 0px;
            padding: 10px 20px;
            background-color: #2ce6c1 !important;
            font-size: 16px;
            border: 1px solid #abeede;
            cursor: pointer;
        }

        #add-post {
            position: fixed;
            bottom: 45px;
            right: 45px;
        }

        #add-post button {
            border-radius: 15px;
            border: 1px solid #2ce6c1;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="forum-body">
        <header>
            <h1>FORUM</h1>
        </header>


        <form method="post" action="forum-search.php">
            <input type="text" name="searchQuery">
            <button type="submit">Recherche</button>
        </form>

        <h1 class="section-title"> Résultats de la recherche </h1>
        <div id="featured-posts">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $searchQuery = $_POST["searchQuery"];

                $forumController->displaySearchResults($searchQuery);
            }
            ?>
        </div>

        <?php
        if (isset($_SESSION['user'])) {
            echo '<a id="add-post" href="create-post.php">';
            echo '<button type="button">';
            echo '<h1>+</h1>';
            echo 'Créer un post';
            echo '</button>';
            echo '</a>';
        }
        ?>

    </div>

</body>

</html>