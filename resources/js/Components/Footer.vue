<template>
    <footer class="flex justify-center h-80 bg-primary text-white pt-16 mt-16">
        <div class="flex justify-between w-[1480px]">
            <Link :href="route('home')"><h2 class="text-3xl font-medium uppercase w-56">Laravel optic shop</h2></Link>   
            <section class="flex">
                <div class="text-left leading-6 w-56 ml-10">
                    <h3 class="w-full border-b border-white pb-0.5 mb-2.5 uppercase font-semibold">Information</h3>
                    <ul class="text-sm">
                        <Link href="">
                            <li class="first-letter:uppercase transition-colors hover:text-gray-400 hover:transition-colors">à propos</li>
                        </Link>
                        <Link href="">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Dépot distant du projet</li>
                        </Link>
                        <a href="https://www.telescopes-et-accessoires.fr/" rel="nooponer" target="_blank">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Optique Unterlinden</li>
                        </a>
                        <Link href="">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Contact</li>
                        </Link>
                    </ul>
                </div>
                <div class="text-left leading-6 w-56 ml-10">
                    <h3 class="w-full border-b border-white pb-0.5 mb-2.5 uppercase font-semibold">Nos produits</h3>
                    <ul class="text-sm">
                        <Link :href="route('product.list', { cat: 'telescope' })">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Télescopes</li>
                        </Link>
                        <Link :href="route('product.list', { cat: 'oculaire' })">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Oculaires</li>
                        </Link>
                        <Link :href="route('product.list', { cat: 'monture' })">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Montures</li>
                        </Link>
                        <Link :href="route('product.discountList')">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Promotions</li>
                        </Link>
                    </ul>
                </div>
                <div class="text-left leading-6 w-56 ml-10">
                    <h3 class="w-full border-b border-white pb-0.5 mb-2.5 uppercase font-semibold">Mentions légales</h3>
                    <ul class="text-sm">
                        <Link :href="route('legals.show')">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Mentions légales</li>
                        </Link>
                        <Link :href="route('legals.cgu')">
                            <li class="transition-colors hover:text-gray-400 hover:transition-colors">Condition générales d'utilisation</li>
                        </Link>
                    </ul>
                </div>
            </section>
        </div>
    </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';


</script>