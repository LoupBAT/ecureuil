<?php
class UserBanned extends User
{
    private int $id;
    private User $user;
    private string $message;
    private string $date;

    public function __construct(int $id, User $user, string $message, string $date)
    {
        $this->id = $id;
        $this->user = $user;
        $this->message = $message;
        $this->date = $date;
    }

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

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public static function getAllUsersBanned($bdd)
    {
        $queryUsersBanned = $bdd->prepare("SELECT b.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM bans b
        JOIN users u ON b.user = u.id");
        $queryUsersBanned->execute();

        $banned = [];

        while ($row = $queryUsersBanned->fetch(PDO::FETCH_ASSOC)) {
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

            $banned[] = new UserBanned(
                $row['id'],
                $user,
                $row['msg'],
                $row['date']
            );
        }

        function formatDateDay($date)
        {
            $formattedDate = new DateTime($date);
            return $formattedDate->format('d/m/Y');
        }

        return $banned;
    }

    public static function unBan($id)
    {
        global $bdd;
        $queryUnBanned = $bdd->prepare("DELETE FROM bans WHERE id = :id");
        $queryUnBanned->execute(array('id' => $id));
    }

    public static function ban($idUser, $message)
    {
        global $bdd;
        $queryUnBanned = $bdd->prepare("INSERT INTO bans (user, msg) VALUES (:user, :msg)");
        $queryUnBanned->execute(array('user' => $idUser, 'msg' => $message));
    }
}
