<?php
session_start();
//connection à la bdd
require($_SERVER['DOCUMENT_ROOT'] . 'ecureuil/layout.php');

$affich_users = $bdd->prepare('SELECT * FROM users');
$affich_users->execute(array());
$affichage = $affich_users->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
    <title>Ecureuil - Se connecter</title>
</head>

<body class="bg-gray-100">
    <?php include 'sidebar.php' ?>
    <div class="p-5 w-[340px] h-80 left-0 top-0  bg-neutral-50 rounded-[20px] shadow m-auto mt-72">
        <div class="text-center text-black text-2xl font-normal font-['Poppins']">Se connecter</div>
        <form action="./login_controller.php" method="post">
            <label for="email" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Email</label>
            <input type="text" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre E-mail" required>
            <label for="password" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Mot de passe</label>
            <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre mot de passe" required>
            <button type="submit" value="Connexion" class="mt-5 text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Se connecter</button>
            </br><a href="/ressources/views/register.php" class="hover:text-[#31ABFF]"> Pas encore membre ? S'inscrire</a>
        </form>
    </div>
</body>

</html>