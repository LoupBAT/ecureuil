<?php
require('../Class/User.php');
require('../Class/UserBanned.php');

session_start(); // Démarre la session
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $email = strtolower($email);

    // Vérification si l'utilisateur existe déjà
    $check = $bdd->prepare('SELECT * FROM users WHERE email=?');
    $check->execute(array($email));
    $verif_user = $check->fetch();
    $row =  $check->rowCount();

    if ($row > 0) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (password_verify($password, $verif_user['password'])) {
                // Vérification si l'utilisateur est banni
                $bannedUsers = UserBanned::getAllUsersBanned($bdd);

                foreach ($bannedUsers as $bannedUser) {
                    if ($bannedUser->getUser()->getId() == $verif_user['id']) { ?>
                        <div class="p-5 w-[340px] h-auto left-0 top-0  bg-neutral-50 rounded-[20px] shadow m-auto mt-72">
                            <div class="text-center text-black text-2xl font-normal font-['Poppins']">Vous êtes banni</div>
                            <p>Raison : <?php echo $bannedUser->getMessage() ?></p>
                            <p class="mb-4">Le <?php echo formatDateDay($bannedUser->getDate()) ?></p>
                            <a href="../../index.php" class="flex justify-center mt-10 text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Accueil</a>
                        </div>
<?php
                        die();
                    }
                }

                $_SESSION['user'] = $verif_user['id'];
                header('Location: ' . $_SESSION['current_page']);
                die();
            } else {
                echo 'Votre mot de passe ne correspond pas';
            }
        } else {
            echo "Votre email n'est pas valide";
        }
    } else {
        echo "Cet utilisateur n'existe pas";
    }
} else {
    echo "Vous n'êtes pas connecté";
}
