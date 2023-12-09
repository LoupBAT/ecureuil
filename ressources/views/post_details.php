<?php
ob_start();
require './session_config.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/ressources/Controller/ForumController.php');
$forumController = new ForumController();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $postId = intval($_GET['id']);
    $post = $forumController->getPostById($postId);

    if ($post) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
            <title><?php echo $post->getTitle(); ?></title>
            <script>
                function redirectToPost(url) {
                    window.location.href = url;
                }
            </script>
            <style>

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

                #body-postdetails {
                    font-family: "Poppins", sans-serif;
                    background-color: #ecf0f1;
                    padding-bottom: 100px;
                    padding-top: 25px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    height: fit-content;
                    min-height: 100%;
                }

                .post-forum {
                    border: 1px solid #ccc;
                    margin: 10px auto;
                    /* Centrage horizontal */
                    padding: 10px;
                }

                .title-post {
                    font-size: 20px;
                    font-weight: bold;
                }

                .title-comment {
                    font-size: 18px;
                    font-weight: bold;
                    margin-top: 15px;
                }

                .author-post,
                .author-comment,
                .created-date {
                    font-style: italic;
                    color: #555;
                }

                .content-post,
                .content-comment {
                    margin-top: 10px;
                }

                .comment-section {
                    margin-top: 20px;
                }

                .comment-form {
                    margin-top: 20px;
                }

                .comment-list,
                .comment-forum {
                    border: 1px solid #eee;
                    margin: 10px auto;
                    /* Centrage horizontal */
                    padding: 10px;
                }

            </style>
        </head>

        <body>

        <?php include 'sidebar.php'; ?>
        <header>
            <p class='w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-white sm:text-4xl mt-4'>FORUM</p>
        </header>
        <div id="body-postdetails" class="shadow-inner">
            <?php
            $forumController->showPostDetails($post);
            $forumController->showLikePostButton($post);
            $forumController->showDeletePostButton($post);
            $forumController->showComments($post);
            ?>
        </div>

        </body>z

        <?php include 'footer.php'; ?>

        </html>
        <?php
    } else {
        echo "Post non trouvé.";
    }
} else {
    echo "ID du post non spécifié ou invalide.";
}
ob_end_flush();
?>
