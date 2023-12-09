<?php

class CommentForum {

    private int $id;
    private string $content;
    private string $createdDate;
    private int $post;

    private int $user;




    //getters

    public function getId(): int {
        return $this->id;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getCreatedDate(): string {
        return $this->createdDate;
    }

    public function getPost(): int {
        return $this->post;
    }

    public function getUser(): int {
        return $this->user;
    }

    //setters

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function setCreatedDate(string $createdDate): void {
        $this->createdDate = $createdDate;
    }

    public function setIdPost(int $idPost): void {
        $this->post = $idPost;
    }

    public function setUser(int $user): void {
        $this->user = $user;
    }

    //construct

    public function __construct(int $id, string $content, string $createdDate, int $idPost, int $user) {
        $this->id = $id;
        $this->content = $content;
        $this->createdDate = $createdDate;
        $this->post = $idPost;
        $this->user = $user;
    }

    //static methods

    public static function getCommentsByPostId(int $post): array {
        global $bdd;
        $queryComments = $bdd->prepare("SELECT * FROM commentsforums WHERE post=:post ORDER BY createdDate DESC");
        $queryComments->bindParam(':post', $post, PDO::PARAM_INT);
        try {
            $queryComments->execute();
        } catch (PDOException $e) {
            echo 'Erreur d\'exécution de la requête : ' . $e->getMessage();
        }

        $comments = [];

        while ($data = $queryComments->fetch()) {
            $comment = new CommentForum($data['id'], $data['content'], $data['createdDate'], $data['post'], $data['user']);
            array_push($comments, $comment);
        }

        return $comments;
    }

    public static function addComment(string $content, int $post, int $idUser): void {
        global $bdd;
        $queryAddComment = $bdd->prepare("INSERT INTO commentsforums (content, createdDate, post, user) VALUES (:content, NOW(), :post, :user)");
        $queryAddComment->execute(array('content' => $content, 'post' => $post, 'user' => $idUser));

        $queryUpdatePost = $bdd->prepare("UPDATE posts SET dateLastInteraction=NOW() WHERE id=:post");
        $queryUpdatePost->execute(array('post' => $post));
    }

    public static function deleteComment(int $id): void {
        global $bdd;
        $queryDeleteComment = $bdd->prepare("DELETE FROM commentsforums WHERE id=:id");
        $queryDeleteComment->execute(array('id' => $id));
    }



}