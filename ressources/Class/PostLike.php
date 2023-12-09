<?php

class PostLike {

    public int $id;
    private User $user;
    private Card $card;


    public function __construct(
        int $id,
        User $user,
        Card $card
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->card = $card;
    }
    // Getters & Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard($card): void
    {
        $this->card = $card;
    }

    // MÉTHODES STATIQUES
    public static function getAllLikesByPostId($id_post)
    {
        global $bdd;
        $queryPosts = $bdd->prepare("SELECT COUNT(*) as total FROM postlikes as cl WHERE post=:idPost");
        $queryPosts->execute(array('idPost' => $id_post));

        $result = $queryPosts->fetch();

        if ($result) {
            $totalLikes = $result['total'];
            return $totalLikes;
        } else {
            return 0;
        }
    }

    public static function isLiked($id_post, $id_user): bool
    {
        global $bdd;
        $queryPosts = $bdd->prepare("SELECT COUNT(*) as total FROM postlikes as cl WHERE post=:idPost and user=:idUser");
        $queryPosts->execute(array('idPost' => $id_post, 'idUser' => $id_user));

        $result = $queryPosts->fetch();

        if ($result['total'] > 0) {
            return true;
        } else {
            return false;
        }


    }

    public static function likePost($idPost, $idUser)
    {
        global $bdd;
        $isLiked = PostLike::isLiked($idPost, $idUser);
        $post = Post::getPostById($idPost);
        if (!$isLiked) {
            $queryPosts = $bdd->prepare("INSERT INTO postlikes (user, post) VALUES(:idUser, :idPost)");
            $queryPosts->execute(array('idUser' => $idUser, 'idPost' => $idPost));

            if ($post) {
                $userID = $post->getAuthor()->getId();
                $pointsToAdd = 10;

                User::addPointsToUser($userID, $pointsToAdd);
            }
        } else {
            $queryDelete = $bdd->prepare("DELETE FROM postlikes WHERE post=:idPost and user=:idUser");
            $queryDelete->execute(array('idPost' => $idPost, 'idUser' => $idUser));
            if ($post) {
                $userID = $post->getAuthor()->getId();
                $pointsToAdd = -10;

                User::addPointsToUser($userID, $pointsToAdd);
            }
        }
    }


}