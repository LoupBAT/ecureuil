<?php
class User
{
    private int $id;
    private string $nickname;
    private string $lastName;
    private string $firstName;
    private string $email;
    private bool $role;
    private int $rank;
    private string $profilPicture;
    private bool $isBanned;
    private string $createdDate;

    public function __construct($id, $nickname, $lastName, $firstName, $email, $role, $rank, $profilPicture, $isBanned, $createdDate)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->role = $role;
        $this->rank = $rank;
        $this->profilPicture = $profilPicture;
        $this->isBanned = $isBanned;
        $this->createdDate = $createdDate;
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getRank()
    {
        return $this->rank;
    }

    public function getProfilPicture()
    {
        return $this->profilPicture;
    }

    public function getIsBanned()
    {
        return $this->isBanned;
    }

    public function getCreatedDate()
    { {
            return $this->createdDate;
        }
    }

    // SETTERS

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function setProfilPicture($profilPicture)
    {
        $this->profilPicture = $profilPicture;
    }

    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;
    }

    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public static function getSessionUser($bdd)
    {
        try {
            if (isset($_SESSION['user'])) {
                $affich_users = $bdd->prepare('SELECT * FROM users WHERE id = ?');
                $affich_users->execute(array($_SESSION['user']));
                $result = $affich_users->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    return new User(
                        $result['id'],
                        $result['nickname'],
                        $result['lastName'],
                        $result['firstName'],
                        $result['email'],
                        $result['role'],
                        $result['rank'],
                        $result['profilPicture'],
                        $result['isBanned'],
                        $result['createdDate']
                    );
                }
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des données : " . $e->getMessage();
        }

        return null;
    }

    public static function addPointsToUser($idUser, $pointToAdd)
    {
        global $bdd;
        $queryRank = $bdd->prepare("UPDATE users SET rank = rank + :pointToAdd WHERE id=:id ");
        $queryRank->execute(array('pointToAdd' => $pointToAdd, 'id' => $idUser));
    }

    public static function getUserById($userId)
    {
        global $bdd;

        $query = $bdd->prepare("SELECT * FROM users WHERE id = :userId");
        $query->execute(array('userId' => $userId));

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User(
                $row['id'],
                $row['nickname'],
                $row['lastName'],
                $row['firstName'],
                $row['email'],
                $row['role'],
                $row['rank'],
                $row['profilPicture'],
                $row['isBanned'],
                $row['createdDate']
            );
        }

        return null;
    }
}
