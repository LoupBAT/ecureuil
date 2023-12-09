<footer class="bg-gray-900 h-fit mt-8" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="mx-auto w-full px-6 pb-2 pt-2">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xlg:col-span-2">
                <div class="md:grid md:grid-cols-2 md:gap-8 block m-auto">
                    <div>
                        <img class="lg:ml-32 lg:w-36 w-20 m-auto" src="https://image.noelshack.com/fichiers/2023/39/3/1695825191-logo-efficiency-blanc.png" alt="">
                    </div>
                </div>
            </div>
            <div class="mt-4 lg:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-white">Contactez-nous</h3>
                <p class="mt-2 text-sm leading-6 text-gray-300">Besoin d'informations ? Envoyez-nous un message :</p>
                <form class="mt-2" action="ressources/views/footer_controller.php" method="post">
                    <div class="sm:flex sm:max-w-md">
                        <input type="email" name="email" autocomplete="email" required class="mr-2 w-full min-w-0 appearance-none rounded-md border-0 bg-white/5 px-3 py-1.5 text-base text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:w-64 sm:text-sm sm:leading-6 xl:w-full my-2" placeholder="Votre email">
                        <input type="text" name="name" autocomplete="name" required class="mr-2 w-full min-w-0 appearance-none rounded-md border-0 bg-white/5 px-3 py-1.5 text-base text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:w-64 sm:text-sm sm:leading-6 xl:w-full my-2" placeholder="Votre nom">
                    </div>
                    <div class="sm:flex sm:max-w-md">
                        <input type="text" name="message" id="message" required class="w-full min-w-0 appearance-none rounded-md border-0 bg-white/5 px-3 py-1.5 text-base text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:w-64 sm:text-sm sm:leading-6 xl:w-full" placeholder="Votre message">
                        <div class="mt-2 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
                            <button type="submit" name="submit" class="flex w-full items-center justify-center rounded-md bg-[#2CE6C1] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#73E4E0] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Envoyer</button>
                        </div>
                    </div>
                    <input type="hidden" name="redirect_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                </form>
            </div>
        </div>
        <div class="mt-4 border-t border-white/10 pt-2">
            <p class="ml-32 mt-8 text-xs leading-5 text-gray-400 md:order-1 md:mt-0">&copy; 2023 Efficiency, Inc. All rights reserved.</p>
        </div>
    </div>
</footer>