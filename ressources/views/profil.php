<?php
require '../Class/CardLike.php';
require '../Class/UserBanned.php';
require './session_config.php';
$id_user = $_GET['user'];
$userInfo = User::getUserById($id_user);
$cardOfUser = Card::getAllCardByUserId($id_user);
$likesOfUser = Card::getCardUserHaveLikedByUserId($id_user);
$isUserSession = false;
if (isset($_SESSION['user'])) {
   $sessionUser = User::getSessionUser($bdd);
   if ($id_user == $sessionUser->getId()) {
      $isUserSession = true;
   }
}
$rankUser = '';
$userPoints = $userInfo->getRank();
if ($userPoints >= 0 && $userPoints <= 300) {
   $rankUser = 'Débutant';
} elseif ($userPoints >= 301 && $userPoints <= 500) {
   $rankUser = 'Intermédiaire';
} else {
   $rankUser = 'Confirmé';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Efficiency - <?php echo $userInfo->getNickname() ?></title>
   <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
</head>
<style>
   .swiper {
      width: 100%;
      height: fit-content;
      background-color: #2CE6C1;
   }

   .swiper-slide {
      width: 40% !important;
      text-align: center;
      font-size: 18px;
      align-items: center;
      margin: 0px 35px 0px 35px;
      cursor: pointer;
   }

   .swiper-button-next {
      color: white;
      right: 0px;
   }

   .swiper-button-prev {
      color: white;
      left: 0px;
   }

   @media (max-width: 760px) {
      .swiper-button-next {
         right: 20px;
         transform: rotate(90deg);
      }

      .swiper-button-prev {
         left: 20px;
         transform: rotate(90deg);
      }
   }

   .custom-button {
      background-color: white;
      color: #2CE6C1;
      border: 2px solid transparent;
      border-image: linear-gradient(to right, #31ABFF, #2ce6c1);
      border-image-slice: 1;
      padding: 0.6rem 1rem;
      margin-top: 20px;
      transition: background-color 0.3s, color 0.3s;
      cursor: pointer;
   }

   .custom-button:hover {
      background-color: linear-gradient(to right, #3b82f6, #10b981);
      color: black;
      border: 2px solid black;
   }

   .card::before {
      content: '';
      position: absolute;
      inset: 0;
      left: -5px;
      margin: auto;
      width: 105%;
      height: 264px;
      border-radius: 10px;
      background: linear-gradient(-45deg, #364BFF 0%, #2CE6C1 100%);
      z-index: -10;
      pointer-events: none;
      transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
   }


   .card:hover::before {
      transform: rotate(-90deg) scaleX(1.34) scaleY(0.77);
   }
</style>

<body class="bg-gray-100" x-data="{ activeTab: 1 }">
   <?php include 'sidebar.php' ?>
   <!-- Avatar et modification d'avatar -->
   <div class="flex justify-center mt-12 px-4 border-b border-gray-300" x-data="{ showModal: false }">
      <div class="h-fit">
         <!-- Avatar actuel -->
         <img src="<?= $userInfo->getProfilPicture(); ?>" alt=" Avatar" class="flex w-24 h-24 rounded-full flex items-center justify-center cursor-pointer" x-on:click="showModal = true">
         <!-- L'élément d'entrée de fichier caché -->
         <input type="file" accept="image/*" class="hidden" @change="updateAvatar($event)">
         <p class="mt-1 sm:text-center leading-8 text-gray-500"><?php echo $userInfo->getNickName() ?></p>
         <div class="mt-2 flex justify-center mb-4">
            <span class="flex justify-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?php if ($rankUser === 'Débutant') {
                                                                                                            echo 'bg-blue-50 text-blue-700 ring-blue-700/10';
                                                                                                         } elseif ($rankUser === 'Intermédiaire') {
                                                                                                            echo 'bg-green-50 text-green-700 ring-green-700/10';
                                                                                                         } else {
                                                                                                            echo 'bg-red-50 text-red-700 ring-red-700/10';
                                                                                                         } ?>">
               <?php echo $rankUser ?>
            </span>
         </div>
         <?php if ($userInfo->getRole() == 1) { ?>
            <div class="mt-2 flex justify-center mb-4">
               <span class="flex justify-center rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-800 ring-1 ring-inset ring-red-700/10">Administrateur</span>
            </div>
         <?php } ?>
         <?php if (isset($_SESSION['user']) && $sessionUser->getRole() == 1 && $id_user != $sessionUser->getId()) { ?>
            <!-- Bouton Bannissement -->
            <div x-data="{ showModal: false }">
               <div class="flex justify-center mt-">
                  <div class="mb-2">
                     <button name="ban" @click="showModal = true" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Bannir</button>
                  </div>
                  <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5);">
                     <div class="bg-white p-8 rounded-lg shadow-lg" @click.away="showModal = false">
                        <!-- Votre contenu de la fenêtre modale -->
                        <span class="absolute top-0 right-0 p-4 cursor-pointer" @click="showModal = false">&times;</span>
                        <form action="../Controller/userController.php" method="post">
                           <input type="hidden" name="ban_id" value="<?php echo $userInfo->getId() ?>">
                           <label for="msg" class="text-sm mt-2 block mb-2 font-medium text-gray-900">Bannissement</label>
                           <textarea type="text" name="message" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Quels sont les raisons du bannissement?" required></textarea>
                           <button name="banned" type="submit" class="mx-auto mt-4 mb-4 text-white bg-red-500 hover:bg-red-600 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Bannir définitevement</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         <?php } ?>
      </div>
      <!-- Fenêtre modale pour téléverser l'image -->
      <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5);">
         <div class="bg-white p-8 rounded-lg shadow-lg" @click.away="showModal = false">
            <span class="absolute top-0 right-0 p-4 cursor-pointer" @click="showModal = false">&times;</span>
            <!-- Formulaire pour téléverser l'image ou mettre à jour l'URL de l'image de profil -->
            <?php if ($isUserSession) { ?>
               <form action="../Controller/userController.php" method="post" enctype="multipart/form-data">
                  <div class="mb-4">
                     <label class="text-sm font-medium text-gray-900">Image de profil (URL)</label>
                     <input type="hidden" name="user_id" value="<?php echo $userInfo->getId() ?>">
                     <input type="text" id="profile_picture" name="profile_picture" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" required>
                  </div>
                  <button name="update_profile_picture" type="submit" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Mettre à jour l'image de profil</button>
                  <button class="mx-auto text-white bg-red-500 hover:bg-red-600 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4" @click="showModal = false">Fermer</button>
               </form>
            <?php } ?>
         </div>
      </div>
   </div>
   <ul class="flex justify-center space-x-4 mt-4">
      <li x-on:click="activeTab = 1" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 1, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 1 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
         Fiches
      </li>
      <li x-on:click="activeTab = 2" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 2, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 2 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
         Likes
      </li>
      <?php if ($isUserSession) { ?>
         <li x-on:click="activeTab = 3" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 3, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 3 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
            Infos
         </li>
      <?php } ?>
   </ul>
   <!-- Affichage fiche utilisateur -->
   <div class="flex justify-center mt-4" x-show="activeTab === 1">
      <?php if (empty($cardOfUser)) : ?>
         <div class="flex justify-center bg-white shadow-lg h-2/5 rounded-lg">
            <div class="w-96 mt-5">
               <img src="https://image.noelshack.com/fichiers/2023/44/3/1698825390-undraw-feeling-blue-4b7q.png" class="w-full">
               <p class="text-center">Il n'y a rien à voir par ici</p>
            </div>
         </div>
      <?php else : ?>
         <div class="flex justify-center">
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-6 mx-auto">
               <?php foreach ($cardOfUser as $card) : ?>
                  <div class="card relative w-[190px] h-[254px] bg-white justify-between flex flex-col p-3 cursor-pointer rounded-md mx-6 mt-4">
                     <a href="/ressources/views/fiche.php?fiche=<?= $card->getId(); ?>" class="">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 h-20"><?= $card->getTitle(); ?></h2>
                     </a>
                     <a class="flex items-center border-b-2 border-[#2CE6C1] pb-2" href="profil.php?user=<?= $card->getUser()->getId(); ?>">
                        <img class="h-10 w-10 rounded-full bg-gray-50 mr-3" src="<?= $card->getUser()->getProfilPicture(); ?>" alt="">
                        <p class="text-xl"><?= $card->getUser()->getNickname(); ?></p>
                     </a>
                     <div class="flex justify-between">
                        <div class="flex">
                           <svg class="w-6 h-6 mr-1 fill-current text-red-500" viewBox="0 0 20 20">
                              <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                           </svg>
                           <p class="text-lg"><?php echo CardLike::getAllLikesByCardId($card->getId()); ?></p>
                        </div>
                        <p class="text-end font-semibold"><?= CARD::formatDate($card->getCreatedDate()); ?></p>
                     </div>
                  </div>
               <?php endforeach; ?>
            </div>
         </div>
      <?php endif; ?>
   </div>
   <!-- Affichage des fiches like par l'utilisateur -->
   <div class="flex justify-center mt-4" x-show="activeTab === 2">
      <?php if (empty($likesOfUser)) : ?>
         <div class="flex justify-center bg-white shadow-lg h-2/5 rounded-lg">
            <div class="w-96 mt-5">
               <img src="https://image.noelshack.com/fichiers/2023/44/3/1698825390-undraw-feeling-blue-4b7q.png" class="w-full">
               <p class="text-center">Il n'y a rien à voir par ici</p>
            </div>
         </div>
      <?php else : ?>
         <div class="flex justify-center">
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-6 mx-auto">
               <?php foreach ($likesOfUser as $card) : ?>
                  <div class="card relative w-[190px] h-[254px] bg-white justify-between flex flex-col p-3 cursor-pointer rounded-md mx-6 mt-4">
                     <a href="/ressources/views/fiche.php?fiche=<?= $card->getId(); ?>" class="">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 h-20"><?= $card->getTitle(); ?></h2>
                     </a>
                     <a class="flex items-center border-b-2 border-[#2CE6C1] pb-2" href="profil.php?user=<?= $card->getUser()->getId(); ?>">
                        <img class="h-10 w-10 rounded-full bg-gray-50 mr-3" src="<?= $card->getUser()->getProfilPicture(); ?>" alt="">
                        <p class="text-xl"><?= $card->getUser()->getNickname(); ?></p>
                     </a>
                     <div class="flex justify-between">
                        <div class="flex">
                           <svg class="w-6 h-6 mr-1 fill-current text-red-500" viewBox="0 0 20 20">
                              <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                           </svg>
                           <p class="text-lg"><?php echo CardLike::getAllLikesByCardId($card->getId()); ?></p>
                        </div>
                        <p class="text-end font-semibold"><?= CARD::formatDate($card->getCreatedDate()); ?></p>
                     </div>
                  </div>
               <?php endforeach; ?>
            </div>
         </div>
      <?php endif; ?>
   </div>

   <?php if ($isUserSession) { ?>
      <!-- Affichage donnée d'utilisateur -->
      <div class="flex justify-center mt-4" x-show="activeTab === 3">
         <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-0">
               <dt class="font-medium leading-6 text-gray-900">Nom</dt>
               <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $userInfo->getLastName() ?></dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-0">
               <dt class=" font-medium leading-6 text-gray-900">Prénom</dt>
               <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $userInfo->getFirstName() ?></dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-0">
               <dt class=" font-medium leading-6 text-gray-900">Email</dt>
               <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $userInfo->getEmail() ?></dd>
            </div>


            <!-- Bouton Modifier les informations -->
            <div class="flex justify-center mt-6">
               <div x-data="{ showModal: false }">
                  <div class="flex justify-center mt-6">
                     <button name="edit" @click="showModal = true" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Modifier les informations</button>
                     <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5);">
                        <div class="bg-white p-8 rounded-lg shadow-lg" @click.away="showModal = false">
                           <span class="absolute top-0 right-0 p-4 cursor-pointer" @click="showModal = false">&times;</span>
                           <form action="../Controller/userController.php" method="post" enctype="multipart/form-data">
                              <label for="nickname" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Pseudo</label>
                              <input type="text" name="nickname" value=" <?php echo $userInfo->getNickName() ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre pseudo" required>
                              <label for="lastName" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Nom</label>
                              <input type="text" name="lastName" value=" <?php echo $userInfo->getLastName() ?>" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre nom" required>
                              <label for="firstName" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Prenom</label>
                              <input type="text" name="firstName" value=" <?php echo $userInfo->getFirstName() ?>" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre prénom" required>
                              <label for="email" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Email</label>
                              <input type="email" name="email" value=" <?php echo $userInfo->getEmail() ?>" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre E-mail" required>
                              <label for="new_password" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nouveau mot de passe</label>
                              <input type="password" name="new_password" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Nouveau mot de passe">
                              <label for="confirm_password" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmer le mot de passe</label>
                              <input type="password" name="confirm_password" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Confirmer le mot de passe">
                              <input type="hidden" name="user_id" value="<?php echo $userInfo->getId() ?>">
                              <button name="save" type="submit" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 mt-6 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Enregistrer</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </dl>
      </div>
   <?php } ?>

</body>

</html>