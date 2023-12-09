<?php
require './session_config.php';
require('../Class/Thematic.php');
require('../Class/Platform.php');
require('../Class/Card.php');
require('../Class/Message.php');
require('../Class/UserBanned.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
    <title>Efficiency - Dashboard</title>
</head>

<body>
    <?php
    $sessionUser = User::getSessionUser($bdd);
    $thematics = Thematic::getAllThematics($bdd);
    $platforms = Platform::getAllPlatforms($bdd);
    $cards = Card::getAllCards($bdd);
    $cardsToVerify = Card::getAllToVerifyCards($bdd);
    $messagesToVerify = Message::getAllMessagesToVerify($bdd);
    $usersBanned = UserBanned::getAllUsersBanned($bdd);

    include 'sidebar.php' ?>
    <div class="bg-cover bg-center bg-opacity-50 bg-[#2CE6C1] h-auto text-black py-8 px-10 object-fill mr-8 ml-28 mt-5 mb-5 rounded-lg flex">
        <div class="md:w-1/2 pr-4 flex items-center ml-16">
            <div>
                <p class="font-bold text-sm uppercase">Admin</p>
                <p class="text-3xl font-bold">Bonjour <?php echo $sessionUser->getNickName() ?></p>
                <p class="text-2xl mb-10 leading-none">Bienvenue dans votre espace de gestion.</p>
            </div>
        </div>
        <div class="w-96">
            <img src="https://image.noelshack.com/fichiers/2023/42/6/1697877626-undraw-software-engineer-re-tnjc.png" class="w-full">
        </div>
    </div>


    <div x-data="{ activeTab: 1 }" class="md:ml-28 md:mr-8">
        <ul class="flex justify-center space-x-4">
            <li x-on:click="activeTab = 1" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 1, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 1 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Fiches
            </li>
            <li x-on:click="activeTab = 2" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 2, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 2 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Thématiques
            </li>
            <li x-on:click="activeTab = 3" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 3, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 3 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Platformes
            </li>
            <li x-on:click="activeTab = 4" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 4, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 4 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Messages
            </li>
            <li x-on:click="activeTab = 5" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 5, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 5 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Bannis
            </li>
        </ul>
        <div x-show="activeTab === 1">
            <?php if (empty($cardsToVerify)) : ?>
                <div class="flex justify-center">
                    <div class="w-96 mt-5">
                        <img src="https://image.noelshack.com/fichiers/2023/44/3/1698825390-undraw-feeling-blue-4b7q.png" class="w-full">
                        <p class="text-center">Il n'y a rien à voir par ici</p>
                    </div>
                </div>
            <?php else : ?>
                <!-- Fiches -->
                <div class="container mx-auto mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        <?php foreach ($cardsToVerify as $card) : ?>
                            <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1">
                                <div class="flex flex-row items-center justify-between">
                                    <h2 class="text-lg font-semibold text-gray-800 text-center">
                                        <?= $card->getTitle(); ?>
                                    </h2>
                                    <form action="dashboard_controller.php" method="post">
                                        <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                                        <button type="submit" name="delete_card" class="text-white bg-red-500 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            X
                                        </button>
                                    </form>
                                </div>
                                <p class="text-gray-500 text-center">Le <?= formatDate($card->getCreatedDate()); ?> par <?= $card->getUser()->getNickname(); ?></p>

                                <div class="flex justify-between mt-1">
                                    <a href="fiche.php?fiche=<?= $card->getID(); ?>" class="text-white font-medium rounded-lg text-sm w-1/2 text-center h-6 mr-1 text-white bg-[#2CE6C1] hover:bg-[#BAE1FE]">
                                        Voir
                                    </a>
                                    <form action="dashboard_controller.php" method="post" class="cursor-pointer text-white font-medium rounded-lg text-sm w-1/2 text-center h-6 bg-[#2CE6C1] hover:bg-[#BAE1FE]">
                                        <input type="hidden" name="card_id" value="<?= $card->getId(); ?>">
                                        <button type="submit" name="verify_card" class="cursor-pointer text-white font-medium rounded-lg text-sm w-full text-center h-6 bg-[#2CE6C1] hover:bg-[#BAE1FE]">
                                            Vérifier
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>


        <div x-show="activeTab === 2" x-data="{ popUpAdd:false, isOpen: false, editThematicId: null, thematicName: '', thematicDescription: '', thematicColor: '' }">
            <div class="flex items-center mx-auto my-auto">
                <button class="rounded-full border-2 border-white w-20 h-20 bg-[#2CE6C1] text-white hover:text-[#2CE6C1] border-[3px] border-[#2CE6C1] hover:bg-white duration-500 mx-auto mt-4 !important" @click="popUpAdd = true">
                    <span class="material-symbols-outlined" style="font-size: 48px;">add</span>
                </button>
            </div>
            <?php if (empty($thematics)) : ?>
                <div class="flex justify-center">
                    <div class="w-96 mt-5">
                        <img src="https://image.noelshack.com/fichiers/2023/44/3/1698825390-undraw-feeling-blue-4b7q.png" class="w-full">
                        <p class="text-center">Il n'y a rien à voir par ici</p>
                    </div>
                </div>
            <?php else : ?>
                <!-- Thématiques -->
                <div class="container mx-auto">
                    <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-1">
                        <?php foreach ($thematics as $thematic) : ?>
                            <div class="rounded-lg overflow-hidden shadow-md p-4 bg-[<?= $thematic->getColor(); ?>] transition-transform transform hover:translate-y-1">
                                <h2 class="text-lg font-semibold text-white"><?= $thematic->getName(); ?></h2>
                                <p class="text-white text-sm"><?= $thematic->getDescription(); ?></p>
                                <div class="flex justify-between mt-1">
                                    <button class="text-white font-medium rounded-lg text-sm w-1/2 text-center h-6 mr-1 text-white bg-[#2CE6C1] hover:bg-[#BAE1FE]" @click="editThematicId = <?= $thematic->getId(); ?>; thematicName = '<?= $thematic->getName(); ?>'; thematicDescription = '<?= $thematic->getDescription(); ?>'; thematicColor = '<?= $thematic->getColor(); ?>'; isOpen = true">
                                        Modifier
                                    </button>
                                    <form action="dashboard_controller.php" method="post" class="cursor-pointer text-white font-medium rounded-lg text-sm w-1/2 text-center h-6 bg-red-500 hover:bg-red-600">
                                        <input type="hidden" name="thematic_id" value="<?= $thematic->getId(); ?>">
                                        <button type="submit" name="delete_thematic">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Pop-up add thématique -->
            <div x-show="popUpAdd" x-transition:enter="transform duration-300 ease-out" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="scale-100" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Ajouter une thématique</h2>
                    <!-- Formulaire d'ajout -->
                    <form class=" w-4/4 mx-auto mt-2 p-4 rounded-xl" action="dashboard_controller.php" method="post">
                        <div class="justify-cente w-2/4r">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Titre de la thématique</label>
                                <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre thématique" required>
                            </div>
                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea type="text" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre description" required></textarea>
                            </div>
                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Couleur en héxadécimal</label>
                                <input type="text" name="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre couleur (#BAE1FE)" required>
                            </div>
                        </div>
                        <div class="flex mt-4">
                            <button type="submit" name="create_thematic" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] mx-auto font-medium rounded-lg text-sm w-36 mt-2">Enregistrer</button>
                        </div>
                    </form>
                    <button class="mx-auto text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm w-36 mt-2 text-center" @click="popUpAdd = false">Fermer</button>
                </div>
            </div>
            <!-- Pop-up edit thématique -->
            <div x-show="isOpen" x-transition:enter="transform duration-300 ease-out" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="scale-100" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Modifier la thématique</h2>
                    <!-- Formulaire de modification -->
                    <form action="dashboard_controller.php" method="post">
                        <input type="hidden" name="thematic_id" value="" x-bind:value="editThematicId">
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-900" for="name">Nom de la thématique</label>
                            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" x-model="thematicName" required>
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-900" for="description">Description</label>
                            <textarea id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model="thematicDescription" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-900" for="link">Couleur</label>
                            <input type="text" id="link" name="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" x-model="thematicColor" required>
                        </div>
                        <button type="submit" name="update_thematic" class="mx-auto text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] font-medium rounded-lg text-sm w-36 mt-4">Enregistrer</button>
                    </form>
                    <button class="mx-auto text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm w-36" @click="isOpen = false">Fermer</button>
                </div>
            </div>
        </div>


        <div x-show="activeTab === 3" x-data="{ popUpAdd: false, isOpen: false, editPlatformId: null, platformName: '', platformDescription: '', platformLink: '', platformImg: '' }">
            <div class="flex items-center mx-auto my-auto">
                <button class="rounded-full border-2 border-white w-20 h-20 bg-[#2CE6C1] text-white hover:text-[#2CE6C1] border-[3px] border-[#2CE6C1] hover:bg-white duration-500 mx-auto mt-4 !important" @click="popUpAdd = true">
                    <span class="material-symbols-outlined" style="font-size: 48px;">add</span>
                </button>
            </div>
            <?php if (empty($platforms)) : ?>
                <div class="flex justify-center">
                    <div class="w-96 mt-5">
                        <img src="https://image.noelshack.com/fichiers/2023/44/3/1698825390-undraw-feeling-blue-4b7q.png" class="w-full">
                        <p class="text-center">Il n'y a rien à voir par ici</p>
                    </div>
                </div>
            <?php else : ?>
                <!-- Plateformes -->
                <div class="container mx-auto mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mt-4">
                        <?php foreach ($platforms as $platform) : ?>
                            <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1">
                                <div class="flex flex-col items-center">
                                    <img src="<?= $platform->getImg(); ?>" alt="<?= $platform->getName(); ?>" class="w-16 h-16 mb-2">
                                    <h2 class="text-lg font-semibold text-gray-800"><?= $platform->getName(); ?></h2>
                                </div>
                                <div class="flex justify-between mt-1">
                                    <button class="text-white font-medium rounded-lg text-sm w-1/2 text-center h-6 mr-1 text-white bg-[#2CE6C1] hover:bg-[#BAE1FE]" @click="editPlatformId = <?= $platform->getId(); ?>; platformName = '<?= $platform->getName(); ?>'; platformDescription = '<?= $platform->getDescription(); ?>'; platformLink = '<?= $platform->getLink(); ?>'; platformImg = '<?= $platform->getImg(); ?>'; isOpen = true">
                                        Modifier
                                    </button>
                                    <form action="dashboard_controller.php" method="post" class="cursor-pointer text-white font-medium rounded-lg text-sm w-1/2 text-center h-6 bg-red-500 hover:bg-red-600">
                                        <input type="hidden" name="platform_id" value="<?= $platform->getId(); ?>">
                                        <button type="submit" name="delete_platform">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Pop-up add platfomes -->
            <div x-show="popUpAdd" x-transition:enter="transform duration-300 ease-out" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="scale-100" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Ajouter une platforme</h2>
                    <!-- Formulaire d'ajout -->
                    <form class="w-4/4 mx-auto mt-2 p-4 rounded-xl" action="dashboard_controller.php" method="post">
                        <div class="justify-cente w-2/4r">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Titre de la platforme</label>
                                <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre platforme" required>
                            </div>
                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea type="text" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre description" required></textarea>
                            </div>
                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Lien</label>
                                <input type="text" name="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre lien" required>
                            </div>
                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Image</label>
                                <input type="text" name="img" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre image en url" required>
                            </div>
                        </div>
                        <div class="flex mt-4">
                            <button type="submit" name="create_platform" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] mx-auto font-medium rounded-lg text-sm w-36 mt-2">Enregistrer</button>
                        </div>
                    </form>
                    <button class="mx-auto text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm w-36 mt-2 text-center" @click="popUpAdd = false">Fermer</button>
                </div>
            </div>
            <!-- Pop-up edit platforme -->
            <div x-show="isOpen" x-transition:enter="transform duration-300 ease-out" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="scale-100" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Modifier la plateforme</h2>
                    <!-- Formulaire de modification -->
                    <form action="dashboard_controller.php" method="post">
                        <input type="hidden" name="platform_id" value="" x-bind:value="editPlatformId">
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-900" for="name">Nom de la plateforme</label>
                            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" x-model="platformName" required>
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-900" for="description">Description</label>
                            <textarea id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model="platformDescription" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-900" for="link">Lien</label>
                            <input type="text" id="link" name="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" x-model="platformLink" required>
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-900" for="img">Image</label>
                            <input type="text" id="img" name="img" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" x-model="platformImg" required>
                        </div>
                        <button type="submit" name="update_platform" class="mx-auto text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] font-medium rounded-lg text-sm w-36 mt-4">Enregistrer</button>
                    </form>
                    <button class="mx-auto text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm w-36 mt-2" @click="isOpen = false">Fermer</button>
                </div>
            </div>


        </div>

        <div x-show="activeTab === 4">
            <?php if (empty($messagesToVerify)) : ?>
                <div class="flex justify-center">
                    <div class="w-96 mt-5">
                        <img src="https://image.noelshack.com/fichiers/2023/44/3/1698825390-undraw-feeling-blue-4b7q.png" class="w-full">
                        <p class="text-center">Il n'y a rien à voir par ici</p>
                    </div>
                </div>
            <?php else : ?>
                <!-- Messages -->
                <div class="container mx-auto mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mt-4">
                        <?php foreach ($messagesToVerify as $message) : ?>
                            <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1 cursor-pointer">
                                <div class="flex flex-col items-center">
                                    <h2 class="text-lg font-semibold text-gray-800"><?= $message->getEmail(); ?></h2>
                                    <h2 class="text-lg font-semibold text-gray-800"><?= $message->getName(); ?></h2>
                                    <p class="text-gray-500"><?= $message->getMessage(); ?></p>
                                </div>
                                <form action="dashboard_controller.php" method="post">
                                    <input type="hidden" name="message_id" value="<?= $message->getId(); ?>">
                                    <button type="submit" name="verify_message" class="cursor-pointer text-white font-medium rounded-lg text-sm w-full text-center h-6 bg-[#2CE6C1] hover:bg-[#BAE1FE]">
                                        Vérifier
                                    </button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div x-show="activeTab === 5" x-data="{ isOpen: false, username: ''}">
            <?php if (empty($usersBanned)) : ?>
                <div class="flex justify-center">
                    <div class="w-96 mt-5">
                        <img src="https://image.noelshack.com/fichiers/2023/44/3/1698825390-undraw-feeling-blue-4b7q.png" class="w-full">
                        <p class="text-center">Il n'y a rien à voir par ici</p>
                    </div>
                </div>
            <?php else : ?>
                <!-- User banned -->
                <div class="container mx-auto mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mt-4">
                        <?php foreach ($usersBanned as $ban) : ?>
                            <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1 cursor-pointer" x-data="{ xUserId: '<?= $ban->getUser()->getId(); ?>' }">
                                <div class="flex flex-col items-center">
                                    <img class="h-8 w-8 rounded-full bg-gray-50" src="<?= $ban->getUser()->getProfilPicture() ?>" alt="profil picture">
                                    <h2 class="text-lg font-semibold text-gray-800"><?= $ban->getUser()->getNickName(); ?></h2>
                                    <p class="text-gray-500">Raison :<?= $ban->getMessage(); ?></p>
                                    <p class="text-gray-500">Le : <?= formatDateDay($ban->getDate()); ?></p>
                                </div>
                                <button type="submit" name="unBanned" @click="isOpen = true; username = '<?= $ban->getUser()->getNickName(); ?>'; xUserId = '<?= $ban->getUser()->getId(); ?>'" class="cursor-pointer text-white font-medium rounded-lg text-sm w-full text-center h-6 bg-[#2CE6C1] hover:bg-[#BAE1FE]">
                                    Unban
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Pop-up unban -->
            <div x-show="isOpen" x-transition:enter="transform duration-300 ease-out" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="scale-100" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Etes-vous sûr de vouloir unban <span x-text="username"></span> ?</h2>
                    <form action="dashboard_controller.php" method="post">
                        <input type="hidden" name="ban_id" value="<?= $ban->getId(); ?>">
                        <button type="submit" name="unBan" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] font-medium rounded-lg text-sm w-36 mt-4 mx-auto">OUI</button>
                    </form>
                    <button class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm w-36 mt-2 mx-auto" @click="isOpen = false">NON</button>
                </div>
            </div>
        </div>


    </div>

</body>

</html>