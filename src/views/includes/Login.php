<section class="bg-gray-50 min-h-screen-custom flex items-center justify-center">
    <!-- login container -->
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
        <!-- form -->
        <div class="md:w-1/2 px-8 md:px-16">
            <h2 class="font-bold text-2xl text-[#002D74]">Connexion</h2>
            <p class="text-xs mt-4 mb-4 text-[#002D74]">Si vous êtes déjà membre, connectez-vous facilement</p>

            <form method="POST" action="/process_login" class="flex flex-col gap-4">
                <?php if ($_GET['error'] === 'user_not_found') {
                    echo '<p class="text-xs text-[#002D74]">Cette adresse mail est invalide !</p>';
                } ?>
                <input class="p-2 rounded-xl border" type="email" name="email" id="email" placeholder="Adresse email">
                <div class="relative">
                    <?php if ($_GET['error'] === 'password') {
                        echo '<p class="text-xs mb-4 text-[#002D74]">Mot de passe incorrect !</p>';
                    } ?>
                    <input class="p-2 rounded-xl border w-full" type="password" name="password" id="password" placeholder="Mot de passe">
                </div>
                <button class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300" name="valid_login">Connexion</button>
            </form>

            <div class="mt-3 text-xs flex justify-between items-center text-[#002D74]">
                <p>Vous n'avez pas de compte ?</p>
                <a href="/register" class="hover:scale-110 duration-300 text-sky-400">Inscrivez-vous</a>
            </div>
        </div>

        <!-- image -->
        <div class="md:block hidden w-1/2">
            <img class="rounded-2xl" src="./img/background.jpg">
        </div>
    </div>
</section>