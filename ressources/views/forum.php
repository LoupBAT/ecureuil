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
            color: #ffffff !important;
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

        #input-search{
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

        .form {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 700px;
            margin-top: 40px;
        }

        .form button{
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
            padding: 10px 10px 10px 10px;
            border: 2.5px solid #2ce6c1;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #ffffff;
        }

        #add-post button h1 {
            font-size: 25px;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="forum-body">
        <header>
            <p class='w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-white sm:text-4xl pb-4 mt-4'>FORUM</p>
        </header>


        <form class="form" method="post" action="forum-search.php">
            <input id="input-search" type="text" name="searchQuery">
            <button type="submit">Recherche</button>
        </form>

        <p class="w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 mt-4 border-b-4 border-[#2CE6C1]">À la une</p>
        <div id="featured-posts">
            <?php
            $forumController->displayPosts(3, true);
            ?>
        </div>

        <p class="w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 mt-4 border-b-4 border-[#2CE6C1]">Les + Récents</p>
        <div id="recent-posts">
            <?php
            $forumController->displayPosts(3, false);
            ?>
        </div>


        <?php if (isset($_SESSION['user'])){
            echo "<p class='w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 mt-4 border-b-4 border-[#2CE6C1]'>Mes posts</p>";
            echo"<div id='my-posts'>";

            $forumController->displayUserPosts();
            echo "</div>";
        }
        ?>

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
    <?php include 'footer.php'; ?>

</body>

</html>