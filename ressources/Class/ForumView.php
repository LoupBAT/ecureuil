<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

class ForumView
{

    public static function showPost($post)
    {
        global $bdd;
        $postUrl = "/ressources/views/post_details.php?id=" . $post->getId();
        echo "<div class='post-forum flex row' onclick='redirectToPost(\"$postUrl\")'>";

        echo "<div class='post-like-section flex column'>";
        echo "<p class='like-count'>" . PostLike::getAllLikesByPostId($post->getId()) . "</p>";
        echo "<a class='like-button' onclick='void' >";
        if (isset($_SESSION['user'])){
            if (PostLike::isLiked($post->getId(), User::getSessionUser($bdd)->getId())) {
                echo '<svg fill="#FB335B" id="like-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.701 471.701" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1 c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3 l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4 C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3 s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4 c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3 C444.801,187.101,434.001,213.101,414.401,232.701z"></path> </g> </g></svg>';
            }
            else{
                echo '<svg fill="#000000" id="like-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.701 471.701" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1 c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3 l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4 C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3 s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4 c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3 C444.801,187.101,434.001,213.101,414.401,232.701z"></path> </g> </g></svg>';

            }
        } else {
        echo '<svg fill="#000000" id="like-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.701 471.701" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1 c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3 l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4 C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3 s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4 c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3 C444.801,187.101,434.001,213.101,414.401,232.701z"></path> </g> </g></svg>';
        }
        echo "</a>";
        echo "</div>";



        echo "<div class='description-post flex column'>";
        echo "<h2 class='title-post'>" . $post->getTitle(). "</h2>";
        echo "<p class='author-post'>" . $post->getAuthor()->getNickname() . "</p>";
        echo "</div>";
        echo "<div class='date-post flex column'>";
        echo "<p class='created-date'>Last Update: " . $post->getDateLastInteraction() . "</p>";
        echo "</div>";

        echo "</div>";
    }

    //show results of search

    public static function showSearchResults($searchResults)
    {

        if (count($searchResults) == 0) {
            echo "<p>Aucun résultat trouvé.</p>";
        }
        else {
            for ($i = 0; $i < count($searchResults); $i++) {
                ForumView::showPost($searchResults[$i]);
            }
        }
    }

    public static function showPostForm()
    {
        global $bdd;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];


                if (!empty($title) && !empty($content)) {
                    $userId = User::getSessionUser($bdd)->getId();
                    Post::createPost($title, $content, $userId);

                    echo "Post créé avec succès !";
                } else {
                    echo "Veuillez remplir tous les champs du formulaire.";
                }
            }
        }

        // Affiche le formulaire HTML
        ?>
        <form id="commentForm" class="form-create" method="POST" action="">
            <div class="title-label">
            <label for="title">Titre :</label>
            <input type="text" name="title" required>
            </div>
            <div class="content-label">
            <label for="content">Contenu :</label>
            <textarea name="content" required></textarea>
            </div>
            <div class="submit">
            <input type="submit" name="submit" value="Créer le post">
            </div>
        </form>
        <?php
    }

    public static function showCommentForm($postId)
    {
        global $bdd;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['commentSubmit'])) {
                $commentContent = $_POST['commentContent'];

                if (!empty($commentContent)) {
                    $userId = User::getSessionUser($bdd)->getId();

                    CommentForum::addComment($commentContent, $postId, $userId);

                    echo "Commentaire ajouté avec succès !";
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                } else {
                    echo "Veuillez saisir un commentaire.";
                }
            }
        }

        ?>
        <form method="POST" action="">
            <label for="commentContent" class="block text-gray-700 text-sm font-bold mb-2">Commentaire :</label>
            <textarea name="commentContent" class="w-full border rounded-md py-2 px-3 placeholder-gray-400 focus:outline-none focus:ring focus:border-blue-300" required></textarea>
            <input class="bg-[#2CE6C1] text-white px-4 py-2 rounded-md hover:bg-[#1C9E88] focus:outline-none focus:ring focus:border-blue-300 mt-2" type="submit" name="commentSubmit" value="Ajouter un commentaire">
        </form>
        <?php
    }

    //show post details page

    public static function showPostDetails($post)
    {
        global $bdd;
        echo "<div class='flex flex-row bg-white p-4 rounded-lg' style='width: 750px;'>";
        echo "<div class='flex flex-col flex-wrap'>"; // Ajout de flex-wrap pour permettre le passage à la ligne
        echo "<h2 class='text-2xl font-bold mb-2'>" . $post->getTitle() . "</h2>";
        echo "<p class='text-gray-500'>" . $post->getAuthor()->getNickname(). "</p>";
        echo "<p class='mt-2 text-gray-800'>" . $post->getContent() . "</p>";
        echo "</div>";
        echo "<div class='flex flex-col ml-4'>";
        echo "<p class='text-gray-500'>" . $post->getCreatedDate() . "</p>";
        echo "</div>";
        echo "</div>";
    }


    public static function showDeletePostButton($post)
    {
        if (isset($_POST['deleteComment'])) {
            $idCommentToDelete = $_POST['idComment'];
            Post::deletePost($idCommentToDelete);
            header("Location: /ressources/views/forum.php");
            exit();
        }
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='idComment' value='" . $post->getId() . "'>";
        echo "<button type='submit' class='bg-red-500 text-white px-3 py-1 mt-2 rounded-md' name='deleteComment'>Supprimer</button>";
        echo "</form>";

    }


    //show comments of a post

    public static function showComments($post, $comments)
    {
        global $bdd;
        echo "<div class='mt-4'>";
        echo "<h2 class='text-2xl font-bold mb-2'>Commentaires</h2>";
        echo "</div>";
        if (User::getSessionUser($bdd)) {
            echo "<div class='comment-form mt-4'>";
            self::showCommentForm($post->getId());
            echo "</div>";
        } else {
            echo "<div class='border-1 p-4'>";
            echo "<p class='text-lg font-semibold mb-4'>Vous devez être connecté pour pouvoir commenter.</p>";
            echo "</div>";
        }

        echo "<div class='comment-section mt-4'>";

        if (count($comments) == 0) {
            echo "<p class='text-lg font-semibold'>Pas encore de commentaire</p>";
        } else {
            foreach ($comments as $comment) {
                self::showComment($comment);
            }
        }

        echo "</div>";
    }

    //show comment of a post

    public static function showComment($comment)
    {
        if (isset($_POST['deleteComment'])) {
            $idCommentToDelete = $_POST['idComment'];
            CommentForum::deleteComment($idCommentToDelete);
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
        $user_nickname = User::getUserById($comment->getUser())->getNickname();
        global $bdd;
        echo "<div class='flex flex-row bg-white p-4 rounded-lg mt-4' style='width: 700px;'>"; // Ajuste la largeur maximale ici
        echo "<div class='flex flex-col items-start'>";
        echo "<p class='text-gray-500'>" . $user_nickname. "</p>";
        echo "<p class='mt-2 text-gray-800'>" . $comment->getContent() . "</p>";
        echo "</div>";
        echo "<div class='flex flex-col ml-4'>";
        echo "<p class='text-gray-500'>" . $comment->getCreatedDate() . "</p>";
        if (User::getSessionUser($bdd)) {
            $isAdmin = User::getSessionUser($bdd)->getRole();

            if ($isAdmin) {
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='idComment' value='" . $comment->getId() . "'>";
                echo "<button type='submit' class='bg-red-500 text-white px-3 py-1 mt-2 rounded-md' name='deleteComment'>Supprimer</button>";
                echo "</form>";
            }
        }
        echo "</div>";
        echo "</div>";
    }

    public static function showLikePostButton($post)
    {
        global $bdd;
        if (isset($_POST['likePost'])) {
            $idPostToLike = $_POST['postId'];
            $userId = User::getSessionUser($bdd)->getId();

            PostLike::likePost($idPostToLike, $userId);
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }

        if (isset($_SESSION['user'])) {
            $userId = User::getSessionUser($bdd)->getId();
            $postId = $post->getId();
            $numLikes = PostLike::getAllLikesByPostId($postId);

            echo '<form method="post" action="" class="p-4 bg-white rounded-md shadow-md mt-4">';
            echo '<input type="hidden" name="postId" value="' . $postId . '">';


            if (PostLike::isLiked($postId, $userId)) {
                echo '<button class="like-button" type="submit" name="likePost">';
                echo '<svg class="" fill="#FB335B" id="like-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.701 471.701" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1 c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3 l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4 C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3 s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4 c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3 C444.801,187.101,434.001,213.101,414.401,232.701z"></path> </g>';
                echo '</g></svg>';
                echo '<span class="like-text">J\'aime</span>';
            } else {
                echo '<button class="like-button" type="submit" name="likePost">';
                echo '<svg class="" fill="#000000" id="like-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.701 471.701" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1 c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3 l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4 C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3 s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4 c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3 C444.801,187.101,434.001,213.101,414.401,232.701z"></path> </g>';
                echo '</g></svg>';
                echo '<span class="like-text">J\'aime</span>';
            }

            echo '<span class="like-count ml-1">' . $numLikes . '</span>';
            echo '</button>';
            echo '</form>';
        } else {
            echo '<p class="text-gray-500 mt-4">Vous devez être connecté pour aimer un contenu</p>';

        }
    }






}