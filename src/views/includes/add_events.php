<?php
global $pdo;
$data = $pdo->query("SELECT id_categorie, nom_categorie FROM categorie_event")->fetchAll();
?>

<div class="bg-gray-900 h-screen flex flex-col items-center justify-center text-center">
    <div class="text-white">
        <h1 class="text-4xl font-bold">Ajouter un évenement</h1>
    </div>
    <div class="mt-8">
        <form action="/process_addevent" method="POST" class="flex flex-col items-center" style="width: 500px" enctype="multipart/form-data">
            <input type="text" style="width: 500px" name="nom_event" placeholder="Nom de l'évenement" class="py-2 px-4 bg-gray-800 text-white rounded-md focus:outline-none mb-4" required />
            <textarea name="description_event" placeholder="Description de l'évenement" rows="5" class="py-2 px-4 bg-gray-800 text-white rounded-md focus:outline-none mb-4 resize-none w-full" required></textarea>
            <input style="width: 500px" type="text" name="adresse" placeholder="Adresse" class="py-2 px-4 bg-gray-800 text-white rounded-md focus:outline-none mb-4" required />
            <div style="width: 500px" class="bg-white p7 rounded w-9/12 mx-auto" style="width: 500px">
                <div x-data="dataFileDnD()" class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                    <div x-ref="dnd" class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                        <input name="photo_Event" accept="image/*" type="file" class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer" @change="addFiles($event)" @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');" @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');" @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');" title="" />

                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="m-0">Veuillez sélectionner 1 seule photo</p>
                        </div>
                    </div>

                    <template x-if="files.length > 0">
                        <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-6" @drop.prevent="drop($event)" @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                            <template x-for="(_, index) in Array.from({ length: files.length })">
                                <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none" style="padding-top: 100%;" @dragstart="dragstart($event)" @dragend="fileDragging = null" :class="{'border-blue-600': fileDragging == index}" draggable="true" :data-index="index">
                                    <button class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button" @click="remove(index)">
                                        <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                    <template x-if="files[index].type.includes('audio/')">
                                        <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                        </svg>
                                    </template>
                                    <template x-if="files[index].type.includes('application/') || files[index].type === ''">
                                        <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </template>
                                    <template x-if="files[index].type.includes('image/')">
                                        <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview" x-bind:src="loadFile(files[index])" />
                                    </template>
                                    <template x-if="files[index].type.includes('video/')">
                                        <video class="absolute inset-0 object-cover w-full h-full border-4 border-white pointer-events-none preview">
                                            <fileDragging x-bind:src="loadFile(files[index])" type="video/mp4">
                                        </video>
                                    </template>

                                    <div class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                                        <span class="w-full font-bold text-gray-900 truncate" x-text="files[index].name">Loading</span>
                                        <span class="text-xs text-gray-900" x-text="humanFileSize(files[index].size)">...</span>
                                    </div>

                                    <div class="absolute inset-0 z-40 transition-colors duration-300" @dragenter="dragenter($event)" @dragleave="fileDropping = null" :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
            <script src="https://unpkg.com/create-file-list"></script>
            <script>
                function dataFileDnD() {
                    return {
                        files: [],
                        fileDragging: null,
                        fileDropping: null,
                        humanFileSize(size) {
                            const i = Math.floor(Math.log(size) / Math.log(1024));
                            return (
                                (size / Math.pow(1024, i)).toFixed(2) * 1 +
                                " " + ["B", "kB", "MB", "GB", "TB"][i]
                            );
                        },
                        remove(index) {
                            let files = [...this.files];
                            files.splice(index, 1);

                            this.files = createFileList(files);
                        },
                        drop(e) {
                            let removed, add;
                            let files = [...this.files];

                            removed = files.splice(this.fileDragging, 1);
                            files.splice(this.fileDropping, 0, ...removed);

                            this.files = createFileList(files);

                            this.fileDropping = null;
                            this.fileDragging = null;
                        },
                        dragenter(e) {
                            let targetElem = e.target.closest("[draggable]");

                            this.fileDropping = targetElem.getAttribute("data-index");
                        },
                        dragstart(e) {
                            this.fileDragging = e.target
                                .closest("[draggable]")
                                .getAttribute("data-index");
                            e.dataTransfer.effectAllowed = "move";
                        },
                        loadFile(file) {
                            const preview = document.querySelectorAll(".preview");
                            const blobUrl = URL.createObjectURL(file);

                            preview.forEach(elem => {
                                elem.onload = () => {
                                    URL.revokeObjectURL(elem.src); // free memory
                                };
                            });

                            return blobUrl;
                        },
                        addFiles(e) {
                            const filesArray = Array.from(e.target.files);
                            this.files = filesArray;
                        }
                    };
                }
            </script>

            <div style="padding-top: 20px; ">
                <input type="number" step="0.01" name="prix" placeholder="Prix" class="py-2 px-4 bg-gray-800 text-white rounded-md focus:outline-none mb-4" required />
                <input type="date" name="date_evenement" class="py-2 px-4 bg-gray-800 text-white rounded-md focus:outline-none mb-4" required />
                <input type="time" name="heure_evenement" class="py-2 px-4 bg-gray-800 text-white rounded-md focus:outline-none mb-4" required />
            </div>
            <select name="id_categorie" autocomplete="country-name" class="py-2 px-4 bg-gray-800 text-white rounded-md focus:outline-none mb-4 resize-none w-full" style="border-top-width: 0px; margin-top: 16px;"">
                    <option value="" disabled selected>Choisissez catégorie</option>
                        <?php foreach ($data as $row) : ?>
                            <option value=" <?= $row['id_categorie'] ?>"><?= $row['nom_categorie'] ?></option>
            <?php endforeach; ?>
            </select>
            <button type="submit" class="bg-[#FAC042] py-2 px-4 text-white rounded-md hover:bg-blue-600 focus:outline-none">Publier</button>
        </form>
    </div>

</div>
