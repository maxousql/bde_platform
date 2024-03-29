<nav class="bg-[#092A43]">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <img class="h-8 w-auto" src="img/logobeede.png" alt="BEEDE">
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="/"
                            class="<?= $currentPage === 'home' ? 'bg-gray-900 text-white block rounded-md px-3 py-2  font-medium"' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?>  rounded-md px-3 py-2 text-sm font-medium">Accueil</a>
                        <a href="/events"
                            class="<?= $currentPage === 'events' ? 'bg-gray-900 text-white block rounded-md px-3 py-2  font-medium"' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Évenements</a>
                        <?php
                        if ($_SESSION['role'] === 2) {
                            echo '<a href="/admin_user" class="' . ($currentPage === 'admin_user' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white') . ' rounded-md px-3 py-2 text-sm font-medium">Gestion utilisateurs</a>';
                            echo '<a href="/admin_events" class="' . ($currentPage === 'admin_events' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white') . ' rounded-md px-3 py-2 text-sm font-medium">Gestion événements</a>';
                        } elseif ($_SESSION['role'] === 3) {
                            echo '<a href="/admin_events" class="' . ($currentPage === 'admin_events' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white') . ' rounded-md px-3 py-2 text-sm font-medium">Gestion événements</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <?php
                if (isset($_SESSION['email'])) {
                    echo '<a href="/mesreservation"
                    class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <img class="h-6 w-6 color:white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" src="img/logobillet.png" alt="">
                    </a>';
                }
                ?>

                <!-- Profile dropdown -->
                <div class="relative ml-3">

                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '<div>
                        <a class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="img/logouser.jpg" alt="">
                        </a>
                    </div>';
                        echo '<div class="transition ease-out duration-100 opacity-0 scale-95     absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" id="profile-menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                        tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a href="/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-0">Votre profil</a>
                        <a href="/mesfavoris" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-1">Vos favoris</a>
                        <a href="/process_logout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-2">Se déconnecter</a>
                    </div>';
                    } else {
                        echo '<div>
                        <a href="/login" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                             aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <img class="h-8 w-8 rounded-full" src="img/logouser.jpg" alt="">
                        </a>
                    </div>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="hidden sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="/" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium"
                aria-current="page">Accueil</a>
            <a href="events"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Évenements</a>
            <?php if ($_SESSION['role'] === 2) {
                echo '<a href="/admin_user"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Gestion
                utilisateurs</a>
                <a href="admin_events"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Gestion
                événements</a>';
                if ($_SESSION['role'] === 3) {
                    echo '<a href="admin_events"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Gestion
                événements</a>';
                }
            } ?>


        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function () {
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !expanded);
            mobileMenu.classList.toggle('hidden');
        });

        // const menuburger = document.getElementById('mobile-menu');
        // document.getElementById("mobile-menu").addEventListener("click", function () {
        //     menuburger.classList.toggle("hidden")
        // });

        //userprofile
        const profileMenu = document.getElementById("profile-menu")
        document.getElementById("user-menu-button").addEventListener("click", function () {
            //opacité
            profileMenu.classList.toggle("opacity-0")
            profileMenu.classList.toggle("opacity-100")
            //taille
            profileMenu.classList.toggle("scale-95")
            profileMenu.classList.toggle("scale-100")
            //effet d'animation
            //--- ouvrir
            profileMenu.classList.toggle("duration-100")
            profileMenu.classList.toggle("ease-out")
            //--- fermer
            profileMenu.classList.toggle("duration-75")
            profileMenu.classList.toggle("ease-in")

        })
    });
</script>