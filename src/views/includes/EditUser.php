<section class="min-h-screen-custom flex items-center justify-center mt-12">
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
        <div class="px-8 md:px-16">
            <h2 class="font-bold text-2xl text-[#002D74]">Modifier l'utilisateur</h2>
            <form method="post" class="flex flex-col mt-2">
                <label>Nom</label>
                <input class="p-2 mb-4 rounded-xl border" type="text" name="name" placeholder="Nom" value="<?= $userData['nom'] ?>">
                <label for="name">Prénom</label>
                <input class="p-2 mb-4 rounded-xl border w-full" type="text" name="firstname" placeholder="Prénom" value="<?= $userData['prenom'] ?>">
                <label>Ecole</label>
                <select class=" p-2 mb-4 rounded-xl border w-full" name="school">
                    <option value="" disabled selected>ESGI</option>
                    <option value="">
                    </option>
                </select>
                <label>Promotion</label>
                <select class="p-2 mb-4 rounded-xl border w-full" name="promotion">
                    <option value="" disabled selected>B3 IW</option>

                    <option value="">
                    </option>
                </select>
                <label>Adresse email</label>
                <input class="p-2 mb-4 rounded-xl border w-full" type="email" name="email" placeholder="Adresse email" value="<?= $userData['email'] ?>">
                <div class=" relative">
                </div>
                <label>Mot de passe</label>
                <input class="p-2 mb-4 rounded-xl border w-full" type="password" name="password" placeholder="Mot de passe">
                <div class=" relative">
                </div>
                <a href="/processUpdateUser?id_user=<?php $row[" id_utilisateur"] ?>" class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">Valider</a>
            </form>
        </div>
    </div>
</section>