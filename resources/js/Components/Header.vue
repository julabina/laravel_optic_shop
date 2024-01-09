<template>
    <section class="flex justify-between items-center w-[1480px] h-32">
        <Link :href="route('home')">
            <p class="font-bold text-3xl text-white uppercase">Laravel optique shop</p>
        </Link>
        <div class="flex">
            <div class="flex flex-col">
                <input type="text" id="" class="h-10 w-80 rounded border-none bg-searchInput text-white text-sm pl-4 placeholder:text-gray-400" placeholder="Rechercher">
                <span class="text-xs pt-0.5 h-1 text-error"></span>
            </div>
            <div class="flex justify-center items-center h-10 w-10 bg-searchBtn rounded ml-1 cursor-pointer">
                <i class="fa-solid fa-magnifying-glass text-white text-xl"></i>
            </div>
        </div>
        <div class="flex border-l border-white border-opacity-50">
            <Link :href="route('home')">
                <div class="flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-home"></i>
                    <p class="uppercase">Accueil</p>
                </div>
            </Link>
            <Link :href="route('profile.edit')" v-if="$page.props.auth.user">
                <div class="flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-user"></i>
                    <p class="uppercase">Profil</p>
                </div>
            </Link>
            <Link :href="route('login')" v-else >
                <div class="flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-user"></i>
                    <p class="uppercase">Connexion</p>
                </div>
            </Link>
            <Link :href="route('home')">
                <div class="flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-pen"></i>
                    <p class="uppercase">Contact</p>
                </div>
            </Link>
            <Link :href="route('cart.show')">
                <div class="relative flex flex-col items-center justify-between py-1 border-r border-white border-opacity-50 h-12 w-24 text-sm text-white cursor-pointer transition-colors hover:transition-colors hover:text-tertiary">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <p class="uppercase">{{ headCart.total.toFixed(2) }} €</p>
                    <p class="flex justify-center items-center absolute w-4 h-4 bg-tertiary rounded-full top-0 right-4 text-[0.65rem] font-bold text-white">{{ headCart.count }}</p>
                </div>
            </Link>
        </div>
    </section>
    <section class="relative flex justify-center items-center bg-black w-full h-10 border-y-2 border-white text-white">
        <div class="w-[1480px] flex items-center justify-center">
            <div v-if="scrollPosition > 120" class="flex items-center justify-between pr-7 pl-7 w-full">
                <Link :href="route('home')" class="uppercase block font-semibold cursor-pointer text-white">Laravel optic shop</Link>
                <div class="flex">
                    <p class="flex justify-center items-center w-4 h-4 mr-1 bg-tertiary rounded-full top-0 right-4 text-[0.65rem] font-bold text-white">10</p>
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            <nav class="absolute flex items-center h-9">
                <Link :href="route('product.list', { cat: 'telescope' })" class="flex items-center h-full px-5 hover:bg-primary">Télescopes</Link>
                <Link :href="route('product.list', { cat: 'oculaire' })" class="flex items-center h-full px-5 hover:bg-primary">Oculaires</Link>
                <Link :href="route('product.list', { cat: 'monture' })" class="flex items-center h-full px-5 hover:bg-primary">Montures</Link>
                <Link :href="route('product.discountList')" class="flex items-center h-full px-5 hover:bg-primary">Promotions</Link>
            </nav>
        </div>
    </section>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
    import { onMounted, ref, onBeforeUnmount } from 'vue';

    const scrollPosition = ref(0);
    const headCart = reactive({
        count: 0,
        total: 0,
    });

    onMounted(() => {
        const cookies = document.cookie.split(';');

        for (let index = 0; index < cookies.length; index++) {
            const cArr = cookies[index].split('=');
            
            if (cArr[0].replace(' ', '') === "laravel_optique_cart") {
                const decodedCookie = decodeURIComponent(cArr[1]);

                const cart = decodedCookie.split(' ');
                let count = 0;
                let total = 0;

                for (let i = 0; i < cart.length; i++) {
                    const article = cart[i].split(",");

                    const aCount = parseInt(article[1]);
                   
                    count += aCount;                  
                    total += parseFloat(article[2]) * aCount;                  
                }

                headCart.count = count;
                headCart.total = total;
            }
        }

        window.addEventListener('scroll', function () {
            scrollPosition.value = window.scrollY;
        })
    });
    
    onBeforeUnmount(() => {
        window.removeEventListener('scroll', function () {
            scrollPosition.value = window.scrollY;
        })
    });
</script>