<?php
// Obtenez l'URL actuelle
$currentUrl = $_SERVER['REQUEST_URI'];

// Utilisez parse_url pour obtenir le chemin de l'URL
$urlInfo = parse_url($currentUrl);

// Utilisez pathinfo pour obtenir le nom du fichier .php
$currentPage = pathinfo($urlInfo['path'], PATHINFO_FILENAME);

// Utilisez cette variable pour générer le code JavaScript
echo '<script>var currentPage = "' . $currentPage . '";</script>';

if (isset($_SESSION['user'])) {

    $affich_users = $bdd->prepare('SELECT * FROM users WHERE id=?');
    $affich_users->execute(array($_SESSION['user']));
    $affichage = $affich_users->fetch();
}
?>

<!-- Nav for mobil-->
<div>
    <div x-data="{ open: false }">
        <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden w-full">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="open = true">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <a href="/ressources/views/profil.php?user=<?= $affichage['id'] ?>" class="flex items-center gap-x-4 py-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-50">
                    <img class="h-8 w-8 rounded-full bg-gray-50" src="<?= $affichage['profilPicture'] ?>" alt="">
                </a>
            <?php
            }
            ?>
            <?php
            if (empty($_SESSION['user'])) {
            ?>
                <a href="/ressources/views/login.php" class="flex items-center gap-x-4 py-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-50">
                    <img class="h-8 w-8 rounded-full bg-gray-50" src="https://image.noelshack.com/fichiers/2023/39/4/1695926885-efficincy-non-connecte.png" alt="">
                </a>
            <?php
            }
            ?>
        </div>
        <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="open" x-cloak>
            <div class="fixed inset-0 bg-gray-900/80"></div>
            <div class="fixed inset-0 flex">
                <div class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" class="-m-2.5 p-2.5" @click="open = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-2">
                        <div class="flex h-16 shrink-0 items-center">
                            <a href="../../../index.php">
                                <img class="h-8 w-auto" src="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" alt="Your Company">
                            </a>
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-1">

                                        <li>
                                            <a href="/ressources/views/forum.php" x-bind:class="{ 'text-[#364BFF] hover:text-[#364BFF] bg-gray-50': currentPage === 'forum', 'text-gray-400 hover:text-[#31ABFF] hover:bg-gray-50': currentPage !== 'forum' }" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg class="h-6 w-6 shrink-0" :class="{ 'text-[#364BFF]': currentPage === 'forum' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                </svg>
                                                Forum
                                            </a>
                                        </li>

                                        <?php
                                        if (isset($_SESSION['user']) &&  $affichage['role'] == 1) {
                                        ?>
                                            <a href="/ressources/views/dashboard.php" x-bind:class="{ 'text-[#364BFF] hover:text-[#364BFF] bg-gray-50': currentPage === 'dashboard', 'text-gray-400 hover:text-[#31ABFF] hover:bg-gray-50': currentPage !== 'dashboard' }" class="group flex gap-x-1 rounded-md text-sm leading-6 font-semibold p-2">
                                                <span class="h-8 w-8 shrink-0 material-symbols-outlined" :class="{ 'text-[#364BFF]': currentPage === 'dashboard' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    dashboard
                                                </span>
                                                Dashboard
                                            </a>
                                        <?php }
                                        if (isset($_SESSION['user'])) {
                                        ?>
                                            <a href="/ressources/views/logout.php"><button type="submit" value="logout" class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-full px-5 py-2.5 text-center mr-4">Deconnexion</button></a>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div x-data="{ isSmall: true, currentPage: currentPage }">
        <!-- Small sidebar -->
        <div x-show="isSmall" x-transition:enter="transition-transform transition-opacity ease-in-out duration-300" x-transition:enter-start="transform translate-x-[-100%] opacity-0" x-transition:enter-end="transform translate-x-0 opacity-100" x-transition:leave="transition-transform transition-opacity ease-in-out duration-300" x-transition:leave-start="transform translate-x-0 opacity-100" x-transition:leave-end="transform translate-x-[100%] opacity-0" class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-20 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
                <div class="flex h-16 shrink-0 items-center">
                    <a href="../../../index.php">
                        <img class="h-8 w-auto" src="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" alt="Your Company">
                    </a>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">

                                <a href="/ressources/views/forum.php" x-bind:class="{ 'bg-gray-50 text-indigo-600': currentPage === 'forum.php', 'text-gray-400 hover:text-[#31ABFF] hover:bg-gray-50': currentPage !== 'forum.php' }" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <svg class="h-8 w-8 shrink-0" x-bind:class="{ 'text-[#364BFF]': currentPage === 'forum' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                </a>
                        </li>
                        <?php
                        if (isset($_SESSION['user']) && $affichage['role'] == 1) {
                        ?>
                            <li>
                                <div class="text-xs font-semibold leading-6 text-gray-400 text-center">Admin</div>
                                <a href="/ressources/views/dashboard.php" x-bind:class="{ 'bg-gray-50 text-indigo-600 ': currentPage === 'dashboard', 'text-gray-400 hover:text-[#31ABFF] hover:bg-gray-50': currentPage !== 'dashboard' }" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <span class="h-8 w-8 shrink-0 material-symbols-outlined" style="font-size: 36px;" x-bind:class="{ 'text-[#364BFF]': currentPage === 'dashboard' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        dashboard
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    </li>
                    <li class="mt-auto">
                        <a x-on:click="isSmall = false" class="cursor-pointer text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md text-sm leading-6 font-semibold text-center">
                            <span class="h-8 w-8 shrink-0 text-gray-400 group-hover:text-[#31ABFF] material-symbols-outlined" style="font-size: 36px;">
                                arrow_forward
                            </span>
                        </a>
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <a href="/ressources/views/profil.php?user=<?= $affichage['id'] ?>" class="flex items-center gap-x-4 py-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-50">
                                <img class="h-8 w-8 rounded-full bg-gray-50" src="<?= $affichage['profilPicture'] ?>" alt="">
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (empty($_SESSION['user'])) {
                        ?>
                            <a href="/ressources/views/login.php" class="flex items-center gap-x-4 py-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-50">
                                <img class="h-8 w-8 rounded-full bg-gray-50" src="https://image.noelshack.com/fichiers/2023/39/4/1695926885-efficincy-non-connecte.png" alt="">
                            </a>
                        <?php
                        }
                        ?>
                    </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- big sidebar -->
        <!-- Static sidebar for desktop -->
        <div x-show="!isSmall" x-transition:enter="transition-transform transition-opacity ease-in-out duration-300" x-transition:enter-start="transform translate-x-[-100%] opacity-0" x-transition:enter-end="transform translate-x-0 opacity-100" x-transition:leave="transition-transform transition-opacity ease-in-out duration-300" x-transition:leave-start="transform translate-x-0 opacity-100" x-transition:leave-end="transform translate-x-[100%] opacity-0" class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-40 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
                <div class="flex h-16 shrink-0 items-center">
                    <a href="../../../index.php">
                        <img class="h-8 w-auto" src="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" alt="Your Company">
                    </a>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="../../../index.php" x-bind:class="{ 'text-[#364BFF] hover:text-[#364BFF] bg-gray-50': currentPage === 'index' || currentPage === '', 'text-gray-400': currentPage !== 'index' && currentPage !== '' }" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold hover:text-[#31ABFF] hover:bg-gray-50">
                                        <svg class="h-6 w-6 shrink-0" :class="{ 'text-[#364BFF]': currentPage === 'index' || currentPage === '' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                        Accueil
                                    </a>
                                </li>
                                <li>
                                    <a href="/ressources/views/decouvrir.php" x-bind:class="{ 'text-[#364BFF] hover:text-[#364BFF] bg-gray-50': currentPage === 'decouvrir', 'text-gray-400 hover:text-[#31ABFF] hover:bg-gray-50': currentPage !== 'decouvrir' }" class="group flex gap-x-1 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0" :class="{ 'text-[#364BFF]': currentPage === 'decouvrir' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                        </svg>
                                        Découvrir
                                    </a>
                                </li>
                                <li>
                                    <a href="/ressources/views/forum.php" x-bind:class="{ 'text-[#364BFF] hover:text-[#364BFF] bg-gray-50': currentPage === 'forum', 'text-gray-400 hover:text-[#31ABFF] hover:bg-gray-50': currentPage !== 'forum' }" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0" :class="{ 'text-[#364BFF]': currentPage === 'forum' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        Forum
                                    </a>
                                </li>
                                <li>
                                    <a href="/ressources/views/creation_fiche.php" x-bind:class="{ 'text-[#364BFF] hover:text-[#364BFF] bg-gray-50': currentPage === 'creation_fiche', 'text-gray-400 hover:text-[#31ABFF] hover:bg-gray-50': currentPage !== 'fiche' }" class="group flex gap-x-1 rounded-md text-sm leading-6 font-semibold p-2">
                                        <span class="h-8 w-8 shrink-0  material-symbols-outlined" :class="{ 'text-[#364BFF]': currentPage === 'creation_fiche' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            add
                                        </span>
                                        Fiche
                                    </a>
                                </li>
                                <?php
                                if (isset($_SESSION['user']) && $affichage['role'] == 1) {
                                ?>
                                    <a href="/ressources/views/dashboard.php" x-bind:class="{ 'text-[#364BFF] hover:text-[#364BFF] bg-gray-50': currentPage === 'dashboard', 'text-gray-400 hover:text-[#31ABFF] hover:bg-gray-50': currentPage !== 'dashboard' }" class="group flex gap-x-1 rounded-md text-sm leading-6 font-semibold p-2">
                                        <span class="h-8 w-8 shrink-0 material-symbols-outlined" :class="{ 'text-[#364BFF]': currentPage === 'dashboard' }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            dashboard
                                        </span>
                                        Dashboard
                                    </a>
                                <?php } ?>
                        </li>
                    </ul>
                    </li>
                    <li class="mt-auto">
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <a href="/ressources/views/logout.php"><button type="submit" value="logout" class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-auto mb-4">Deconnexion</button></a>
                        <?php
                        }
                        ?>
                        <a x-on:click="isSmall = true" class="cursor-pointer text-gray-700 hover:text-[#31ABFF] hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-center">
                            <span class="h-8 w-8 shrink-0 text-gray-400 group-hover:text-[#31ABFF] material-symbols-outlined">
                                arrow_back
                            </span>
                        </a>
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <a href="/ressources/views/profil.php?user=<?= $affichage['id'] ?>" class="flex items-center gap-x-4 py-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-50">
                                <img class="h-8 w-8 rounded-full bg-gray-50" src="<?= $affichage['profilPicture'] ?>" alt="">
                                <span class="sr-only">Votre profile</span>
                                <span aria-hidden="true"><?= $affichage['nickname'] ?></span>
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (empty($_SESSION['user'])) {
                        ?>
                            <a href="/ressources/views/login.php" class="flex items-center gap-x-4 py-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-50">
                                <img class="h-8 w-8 rounded-full bg-gray-50" src="https://image.noelshack.com/fichiers/2023/39/4/1695926885-efficincy-non-connecte.png" alt="">
                                <span class="sr-only">Votre profile</span>
                                <span aria-hidden="true">Connexion</span>
                            </a>
                        <?php
                        }
                        ?>
                    </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>