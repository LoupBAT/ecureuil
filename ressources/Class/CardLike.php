<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/Card.php');
class CardLike
{
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

    public static function getAllLikesByCardId($id_card)
    {
        global $bdd;
        $queryCards = $bdd->prepare("SELECT COUNT(*) as total FROM cardlikes as cl WHERE card=:idCard");
        $queryCards->execute(array('idCard' => $id_card));

        // Récupérer le résultat dans une variable
        $result = $queryCards->fetch();

        // Vérifier si le résultat est non vide
        if ($result) {
            $totalLikes = $result['total'];
            return $totalLikes;
        } else {
            return 0;
        }
    }
    public static function isLiked($id_card, $id_user)
    {
        global $bdd;
        $queryCards = $bdd->prepare("SELECT COUNT(*) as total FROM cardlikes as cl WHERE card=:idCard and user=:idUser");
        $queryCards->execute(array('idCard' => $id_card, 'idUser' => $id_user));

        // Récupérer le résultat dans une variable
        $result = $queryCards->fetch();

        // Vérifier si la colonne "total" est supérieure à zéro
        if ($result['total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function likeCard($idCard, $idUser)
    {
        global $bdd;
        $isLiked = CardLike::isLiked($idCard, $idUser);
        $card = Card::getCardById($idCard);
        if (!$isLiked) {
            $queryCards = $bdd->prepare("INSERT INTO cardLikes (user, card) VALUES(:idUser, :idCard)");
            $queryCards->execute(array('idUser' => $idUser, 'idCard' => $idCard));

            if ($card) {
                $userID = $card->getUser()->getId();
                $pointsToAdd = 10;

                User::addPointsToUser($userID, $pointsToAdd);
            }
        } else {
            $queryDelete = $bdd->prepare("DELETE FROM cardLikes WHERE card=:idCard and user=:idUser");
            $queryDelete->execute(array('idCard' => $idCard, 'idUser' => $idUser));
            if ($card) {
                $userID = $card->getUser()->getId();
                $pointsToAdd = -10;

                User::addPointsToUser($userID, $pointsToAdd);
            }
        }
    }
}
