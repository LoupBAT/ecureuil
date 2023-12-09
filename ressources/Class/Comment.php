<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require('../Class/CardLike.php');

class Comment
{
    public int $id;
    public string $content;
    public string $createdDate;

    private User $user;
    private Card $card;

    public function __construct(
        int $id,
        string $content,
        string $createdDate,
        User $user,
        Card $card
    ) {
        $this->id = $id;
        $this->content = $content;
        $this->createdDate = $createdDate;
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

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(int $user): void
    {
        $this->user = $user;
    }
    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(int $card): void
    {
        $this->card = $card;
    }

    public static function commentCreate($content, $sessinUserId, $idCard)
    {
        global $bdd;
        $queryComments = $bdd->prepare("INSERT INTO comments (content, user, card) VALUES(:content, :user, :card)");
        $queryComments->execute(array('content' => $content, 'user' => $sessinUserId, 'card' => $idCard));
    }

    public static function getAllCommentsByCardId($id)
    {
        global $bdd;
        $queryComment = $bdd->prepare("SELECT cards.*, c.*, u1.nickname as user_nickname, u1.id as user_id, u1.lastName as user_lastName, u1.firstName as user_firstName, u1.email as user_email, u1.role as user_role, u1.rank as user_rank, u1.profilPicture as user_profilPicture, u1.isBanned as user_isBanned, u1.createdDate as user_createdDate FROM comments c 
        JOIN users u1 ON c.user = u1.id 
        LEFT JOIN cards ON c.card = cards.id
        WHERE c.card = :id");

        $queryComment->execute(array('id' => $id));

        $comments = [];

        while ($row = $queryComment->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                $row['user_id'],
                $row['user_nickname'],
                $row['user_lastName'],
                $row['user_firstName'],
                $row['user_email'],
                $row['user_role'],
                $row['user_rank'],
                $row['user_profilPicture'],
                $row['user_isBanned'],
                $row['user_createdDate']
            );

            $card = new Card(
                $row['id'] ?? null,
                $row['title'] ?? '',
                $row['contentText'] ?? '',
                $row['gitHub'] ?? '',
                $row['status'] ?? '',
                $row['createdDate'] ?? '',
                $row['updatedDate'] ?? '',
                $row['summary'] ?? '',
                $user,
                $row['thematic'] ?? '',
                $row['platform'] ?? '',
                $row['img'] ?? ''
            );

            $comments[] = new Comment(
                $row['id'],
                $row['content'],
                $row['createdDate'],
                $user,
                $card
            );
        }

        function formatDateDay($date)
        {
            $formattedDate = new DateTime($date);
            return $formattedDate->format('d/m/Y H:i');
        }
        return $comments;
    }


    public static function countCommentsByCardId($id)
    {
        global $bdd;

        $queryCommentCount = $bdd->prepare("SELECT COUNT(*) as comment_count FROM comments c 
            WHERE c.card = :id");
        $queryCommentCount->execute(array('id' => $id));

        $result = $queryCommentCount->fetch(PDO::FETCH_ASSOC);

        return $result['comment_count'];
    }

    public static function deleteCommentById($id)
    {
        global $bdd;
        $queryComments = $bdd->prepare("DELETE FROM comments WHERE id = :id");
        $queryComments->execute(array('id' => $id));
    }
}
