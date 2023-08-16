<template>
    <div class="sticky flex flex-col items-center bg-primary -top-32 z-20">
        <section class="flex justify-between items-center w-[1480px] h-32">
            <p class="font-bold text-3xl text-white uppercase">Laravel optique shop</p>
            <div class="flex">
                <div class="flex flex-col">
                    <input type="text" id="" class="h-10 w-80 rounded border-none bg-searchInput text-white text-sm pl-4 placeholder:text-gray-400" placeholder="Rechercher">
                    <span class="text-xs text-white pt-0.5 h-1 text-error"></span>
                </div>
                <div class="flex justify-center items-center h-10 w-10 bg-searchBtn rounded ml-1 cursor-pointer">
                    <i class="fa-solid fa-magnifying-glass text-white text-xl"></i>
                </div>
            </div>
            <div class="flex border-l border-white border-opacity-50">
                <div class="flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-home"></i>
                    <p class="uppercase">Accueil</p>
                </div>
                <div class="flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-user"></i>
                    <p class="uppercase">Connexion</p>
                </div>
                <div class="flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-pen"></i>
                    <p class="uppercase">Contact</p>
                </div>
                <div class="relative flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <p class="uppercase">600.00 €</p>
                    <p class="flex justify-center items-center absolute w-4 h-4 bg-tertiary rounded-full top-0 right-4 text-[0.65rem] font-bold text-white">10</p>
                </div>
            </div>
        </section>
        <section>

        </section>
    </div>
</template>

<script setup>

</script>