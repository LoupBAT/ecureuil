<?php

include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/Post.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/ForumView.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/PostLike.php');
require($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/CommentForum.php');
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');



class ForumController
{
    public function displayPosts($numberOfPostsToShow, $isTrending)
    {
        $posts = Post::getPosts();

        if ($isTrending) {
            usort($posts, function($a, $b) {
                $likesA = PostLike::getAllLikesByPostId($a->getId());
                $likesB = PostLike::getAllLikesByPostId($b->getId());
                return $likesB - $likesA;
            });
        }

        for ($i = 0; $i < min($numberOfPostsToShow, count($posts)); $i++) {
            ForumView::showPost($posts[$i]);
        }
    }

    //displayRecentPosts($numberOfPostsToShow)

    public function displayRecentPosts($numberOfPostsToShow)
    {
        $posts = Post::getPosts();
        usort($posts, function($a, $b) {
            return strtotime($b->getCreatedDate()) - strtotime($a->getCreatedDate());
        });

        for ($i = 0; $i < min($numberOfPostsToShow, count($posts)); $i++) {
            ForumView::showPost($posts[$i]);
        }
    }

    public function displayUserPosts()
    {
        global $bdd;
        $posts = Post::getAllPostsByUserId(User::getSessionUser($bdd)->getId());
        if (count($posts) == 0) {
            echo "<p>Vous n'avez pas encore posté de message.</p>";
        }
        else {
            for ($i = 0; $i < count($posts); $i++) {
                ForumView::showPost($posts[$i]);
            }
        }
    }


    public function displayPost($postId)
    {
        $post = Post::getPostById($postId);
        ForumView::showPost($post);
    }

    public function displaySearchResults($searchQuery)
    {
        $searchResults = Post::searchPosts($searchQuery);

        ForumView::showSearchResults($searchResults);
    }


    public function showPostForm()
    {
        global $bdd;
        if (User::getSessionUser($bdd)) {
            ForumView::showPostForm();
        } else {
            echo "<p>Vous devez être connecté pour pouvoir poster un message.</p>";
        }
    }

    public function getPostById($postId): ?Post
    {
        return Post::getPostById($postId);
    }

    //displayPostdetails

    public function showPostDetails($post)
    {
        ForumView::showPostDetails($post);
    }

    //display comments of a post
    public function showComments($post)
    {
        $comments = CommentForum::getCommentsByPostId($post->getId());
        ForumView::showComments($post,$comments);
    }

    //display delete post button

    public function showDeletePostButton($post)
    {
        global $bdd;
        if (User::getSessionUser($bdd)) {
            $isAdmin = User::getSessionUser($bdd)->getRole();

            if ($isAdmin) {
                ForumView::showDeletePostButton($post);
            }
        }
    }

    public function showLikePostButton($post){
        ForumView::showLikePostButton($post);
    }



}
