<?php include './session_config.php' ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
    <title>Efficiency - S'inscrire</title>
</head>

<body class="bg-gray-100">
    <?php include 'sidebar.php' ?>
    <div class="p-5 w-[340px] h-[564px] left-0 top-0  bg-neutral-50 rounded-[20px] shadow m-auto mt-48">
        <div class="text-center text-black text-2xl font-normal font-['Poppins']">S’inscrire</div>
        <form action="register_controller.php" method="post" action="_URL_" enctype="multipart/form-data">
            <label for="nickname" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Pseudo</label>
            <input type="text" name="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre pseudo" required>
            <label for="lastName" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Nom</label>
            <input type="text" name="lastname" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre nom" required>
            <label for="firstName" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Prenom</label>
            <input type="text" name="firstname" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre prénom" required>
            <label for="email" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Email</label>
            <input type="email" name="email" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre E-mail" required>
            <label for="password" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Mot de passe</label>
            <input type="password" name="password" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre mot de passe" required>
            <div class="flex mt-8">
                <button type="submit" value="annuler" class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Annuler</button>
                <button type="submit" value="envoyer" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Enregistrer</button>
            </div>
            </br><a href="/ressources/views/login.php" class="-mt-2 hover:text-[#31ABFF]"> Déjà membre? Se connecter</a>
        </form>
    </div>
</body>

</html>