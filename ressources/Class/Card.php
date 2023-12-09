<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require('User.php');
class Card
{
    public int $id;
    public string $title;
    public string $contentText;
    public string $gitHub;
    public string $status;
    public string $createdDate;
    public string $updatedDate;
    public string $summary;
    private User $user;
    public int $thematic;
    public int $platform;
    public string $img;

    public function __construct(
        int $id,
        string $title,
        string $contentText,
        string $gitHub,
        string $status,
        string $createdDate,
        string $updatedDate,
        string $summary,
        User $user,
        int $thematic,
        int $platform,
        string $img
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->contentText = $contentText;
        $this->gitHub = $gitHub;
        $this->status = $status;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->summary = $summary;
        $this->user = $user;
        $this->thematic = $thematic;
        $this->platform = $platform;
        $this->img = $img;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContentText(): string
    {
        return $this->contentText;
    }

    public function setContentText(string $contentText): void
    {
        $this->contentText = $contentText;
    }

    public function getGitHub(): string
    {
        return $this->gitHub;
    }

    public function setGitHub(string $gitHub): void
    {
        $this->gitHub = $gitHub;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    public function getUpdatedDate(): string
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(string $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(int $user): void
    {
        $this->user = $user;
    }

    public function getThematic(): int
    {
        return $this->thematic;
    }

    public function setThematic(int $thematic): void
    {
        $this->thematic = $thematic;
    }

    public function getPlatform(): int
    {
        return $this->platform;
    }

    public function setPlatform(int $platform): void
    {
        $this->platform = $platform;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg(int $img): void
    {
        $this->img = $img;
    }



    public static function getAllCards($bdd)
    {
        $queryCards = $bdd->prepare("SELECT c.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM cards c
        JOIN users u ON c.user = u.id");
        $queryCards->execute();

        $cards = [];

        while ($row = $queryCards->fetch(PDO::FETCH_ASSOC)) {
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

            $cards[] = new Card(
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );
        }

        function formatDate($date)
        {
            $formattedDate = new DateTime($date);
            return $formattedDate->format('m/Y');
        }

        return $cards;
    }
    public static function getCardById($id_card)
    {
        global $bdd;
        $queryCard = $bdd->prepare("SELECT c.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM cards c 
    JOIN users u ON c.user = u.id WHERE c.id=:id");
        $queryCard->execute(array('id' => $id_card));

        $row = $queryCard->fetch(PDO::FETCH_ASSOC);

        if ($row) {
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
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );
            function formatDate($date)
            {
                $formattedDate = new DateTime($date);
                return $formattedDate->format('d/m/Y');
            }
            return $card;
        }

        return null;
    }

    public static function getAllToVerifyCards($bdd)
    {
        $queryCards = $bdd->prepare("SELECT c.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM cards c
        JOIN users u ON c.user = u.id WHERE c.status = 'toVerify'");
        $queryCards->execute();

        $cards = [];

        while ($row = $queryCards->fetch(PDO::FETCH_ASSOC)) {
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

            $cards[] = new Card(
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );
        }
        return $cards;
    }

    public static function verifyCard($id)
    {
        global $bdd;
        $queryCard = $bdd->prepare("UPDATE cards SET status='verify' WHERE id=:id");
        $queryCard->execute(array('id' => $id));

        $card = self::getCardById($id);

        if ($card) {
            $userID = $card->getUser()->getId();
            $pointsToAdd = 100;

            User::addPointsToUser($userID, $pointsToAdd);
        }
    }

    public static function createCard($title, $contentText, $gitHub, $summary, $user, $thematic, $platform)
    {
        global $bdd;
        $insertQuery = $bdd->prepare("INSERT INTO cards (title, summary, user, platform, thematic, contentText, gitHub) 
        VALUES (:title, :summary, :user, :platform, :thematic, :contentText, :gitHub)");
        $insertQuery->execute(array(
            'title' => $title,
            'summary' => $summary,
            'user' => $user,
            'platform' => $platform,
            'thematic' => $thematic,
            'contentText' => $contentText,
            'gitHub' => $gitHub,
        ));
    }

    public static function getCardByLike($bdd)
    {
        $queryMostLiked = $bdd->prepare("SELECT cards.*, COUNT(cardlikes.id) as total_likes, users.id as user_id, users.nickname as user_nickname, users.lastName as user_lastName, users.firstName as user_firstName, users.email as user_email, users.role as user_role, users.rank as user_rank, users.profilPicture as user_profilPicture, users.isBanned as user_isBanned, users.createdDate as user_createdDate
        FROM cards
        INNER JOIN cardlikes ON cardlikes.card = cards.id
        INNER JOIN users ON cards.user = users.id
        WHERE status = 'verify'
        GROUP BY cards.id
        ORDER BY total_likes DESC
        LIMIT 3
        ");

        $queryMostLiked->execute();

        $mostLiked = [];

        while ($row = $queryMostLiked->fetch(PDO::FETCH_ASSOC)) {
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
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );

            $mostLiked[] = $card;
        }

        return $mostLiked;
    }

    public static function getAllCardsVerify($bdd)
    {
        $queryCards = $bdd->prepare("SELECT c.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM cards c
        JOIN users u ON c.user = u.id WHERE status='verify'");
        $queryCards->execute();

        $cards = [];

        while ($row = $queryCards->fetch(PDO::FETCH_ASSOC)) {
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

            $cards[] = new Card(
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );
        }

        return $cards;
    }

    public static function formatDate($date)
    {
        $formattedDate = new DateTime($date);
        return $formattedDate->format('m/Y');
    }

    public static function deleteCardById($id)
    {
        global $bdd;
        $queryPlatforms = $bdd->prepare("DELETE FROM cards WHERE id = :id");
        $queryPlatforms->execute(array('id' => $id));
    }

    public static function editContentTextByCardId($id, $newContent)
    {
        global $bdd;
        $queryCard = $bdd->prepare("UPDATE cards SET contentText=:newContent WHERE id=:id");
        $queryCard->execute(array('newContent' => $newContent, 'id' => $id));
    }

    public static function editCodeByCardId($id, $newContent)
    {
        global $bdd;
        $queryCard = $bdd->prepare("UPDATE cards SET github=:newContent WHERE id=:id");
        $queryCard->execute(array('newContent' => $newContent, 'id' => $id));
    }

    public static function getAllCardByUserId($idUser)
    {
        global $bdd;
        $queryCards = $bdd->prepare("SELECT c.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM cards c
        JOIN users u ON c.user = u.id WHERE c.user=:idUser");
        $queryCards->execute(array('idUser' => $idUser));

        $cards = [];

        while ($row = $queryCards->fetch(PDO::FETCH_ASSOC)) {
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

            $cards[] = new Card(
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );
        }

        return $cards;
    }

    public static function getCardUserHaveLikedByUserId($idUser)
    {
        global $bdd;
        $queryCards = $bdd->prepare("SELECT
            cards.id AS card_id,
            cards.title AS card_title,
            cards.contentText AS card_contentText,
            cards.gitHub AS card_gitHub,
            cards.status AS card_status,
            cards.createdDate AS card_createdDate,
            cards.updatedDate AS card_updatedDate,
            cards.summary AS card_summary,
            cards.thematic AS card_thematic,
            cards.platform AS card_platform,
            cards.img AS card_img,
            cards.user AS card_user_id,
            users.nickname AS user_nickname,
            users.lastName AS user_lastName,
            users.firstName AS user_firstName,
            users.email AS user_email,
            users.role AS user_role,
            users.rank AS user_rank,
            users.profilPicture AS user_profilPicture,
            users.isBanned AS user_isBanned,
            users.createdDate AS user_createdDate
            FROM cards
            INNER JOIN cardlikes ON cardlikes.card = cards.id
            INNER JOIN users ON cards.user = users.id
            WHERE cardlikes.user = :idUser");

        $queryCards->execute(array('idUser' => $idUser));

        $cards = [];

        while ($row = $queryCards->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                $row['card_user_id'],
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

            $cards[] = new Card(
                $row['card_id'],
                $row['card_title'],
                $row['card_contentText'],
                $row['card_gitHub'],
                $row['card_status'],
                $row['card_createdDate'],
                $row['card_updatedDate'],
                $row['card_summary'],
                $user,
                $row['card_thematic'],
                $row['card_platform'],
                $row['card_img']
            );
        }

        return $cards;
    }
}
