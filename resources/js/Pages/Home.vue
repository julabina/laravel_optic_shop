<template>
    <Head title="accueil" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <section class="relative bg-primary bg-opacity-20 h-[550px] w-full z-10">
            <img :src="carouselPosition === 1 ? '/images/c1.webp' : carouselPosition === 2 ? '/images/c2.webp' : '/images/c3.webp'" alt="dynamic carousel picture" class="h-[550px] object-center object-cover w-full">
            <div class="absolute flex justify-between items-center h-[550px] w-full z-30 top-0">
                <button @click="handleCarousel('down')"><i class="fa-solid fa-chevron-left flex items-center justify-center bg-white bg-opacity-30 rounded-r border border-black w-10 h-10 text-2xl transition-all hover:transition-all hover:text-white hover:bg-opacity-60 hover:border-white"></i></button>
                <button @click="handleCarousel('up')"><i class="fa-solid fa-chevron-right flex items-center justify-center bg-white bg-opacity-30 rounded-l border border-black w-10 h-10 text-2xl transition-all hover:transition-all hover:text-white hover:bg-opacity-60 hover:border-white"></i></button>
            </div>
            <div class="absolute flex justify-center bottom-8 w-full z-40">
                <button @click="carouselPosition = 1" :class="carouselPosition === 1 ? 'h-2.5 w-2.5 mx-1.5 p-1 cursor-pointer bg-white rounded-full' : 'h-2.5 w-2.5 mx-1.5 p-1 cursor-pointer bg-white bg-opacity-30 rounded-full'"></button>
                <button @click="carouselPosition = 2" :class="carouselPosition === 2 ? 'h-2.5 w-2.5 mx-1.5 p-1 cursor-pointer bg-white rounded-full' : 'h-2.5 w-2.5 mx-1.5 p-1 cursor-pointer bg-white bg-opacity-30 rounded-full'"></button>
                <button @click="carouselPosition = 3" :class="carouselPosition === 3 ? 'h-2.5 w-2.5 mx-1.5 p-1 cursor-pointer bg-white rounded-full' : 'h-2.5 w-2.5 mx-1.5 p-1 cursor-pointer bg-white bg-opacity-30 rounded-full'"></button>
            </div>
        </section>     
        
        <section class="flex flex-col items-center mt-16">
            <h1 class="text-3xl font-bold mb-11 text-center uppercase">Nos catégories</h1>
            <div class="flex justify-center w-full">
                <Link :href="route('product.list', { cat: 'telescope' })">
                    <button class="w-80 border border-black border-opacity-20 rounded mx-2.5 bg-white transition-all hover:transition-all hover:bg-primary hover:shadow-lg hover:shadow-gray-500 hover:text-white">
                        <h2 class="font-bold text-3xl my-6">Télescopes</h2>
                        <img src="/images/telescope.webp" alt="télescope category" class="h-96 object-center object-cover w-full border-t border-black border-opacity-20">
                    </button>
                </Link>
                <Link :href="route('product.list', { cat: 'oculaire' })">
                    <button class="w-80 border border-black border-opacity-20 rounded mx-2.5 bg-white transition-all hover:transition-all hover:bg-primary hover:shadow-lg hover:shadow-gray-500 hover:text-white">
                        <h2 class="font-bold text-3xl my-6">Oculaires</h2>
                        <img src="/images/oculaire.webp" alt="télescope category" class="h-96 object-center object-cover w-full border-t border-black border-opacity-20">
                    </button>
                </Link>
                <Link :href="route('product.list', { cat: 'monture' })">
                    <button class="w-80 border border-black border-opacity-20 rounded mx-2.5 bg-white transition-all hover:transition-all hover:bg-primary hover:shadow-lg hover:shadow-gray-500 hover:text-white">
                        <h2 class="font-bold text-3xl my-6">Montures</h2>
                        <img src="/images/monture.webp" alt="télescope category" class="h-96 object-center object-cover w-full border-t border-black border-opacity-20">
                    </button>
                </Link>
            </div>
        </section>

        <section class="flex flex-col items-center mt-16">
            <h1 class="text-3xl font-bold mb-11 text-center uppercase">Nos promotions</h1>
            <div class="flex justify-center w-full">
                <ProductCard v-for="(product, ind) in discountProducts" :key="'discountHome' + ind" :product="product" />
            </div>
            <h3 class="mt-9 text-2xl font-medium text-tertiary">Et bien d'autre encore !</h3>
            <Link :href="route('product.discountList')">
                <button class="btn-primary text-lg px-5 h-12 mt-6">Voir toutes les promotions</button>
            </Link>
        </section>
        
        <section class="flex flex-col items-center mt-16 mb-16">
            <h1 class="text-3xl font-bold mb-11 text-center uppercase">Nos partenaires</h1>
            <div class="flex items-center h-24">
                <a href="https://www.telescopes-et-accessoires.fr/PBSCCatalog.asp?BrandID=317068" rel="nooponer" target="_blank">
                    <img src="/images/brands/skywatcher.svg" alt="" class="h-20 mb-5">
                </a>
                <a href="https://www.telescopes-et-accessoires.fr/PBSCCatalog.asp?BrandID=318499" rel="nooponer" target="_blank">
                    <img src="/images/brands/celestron.svg" alt="" class="h-6 mx-5">
                </a>
                <a href="https://www.telescopes-et-accessoires.fr/PBSCCatalog.asp?BrandID=319358" rel="nooponer" target="_blank">
                    <img src="/images/brands/es.svg" alt="" class="h-14 mx-5">
                </a>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
    import ProductCard from '@/Components/ProductCard.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { ref } from 'vue';

    const carouselPosition = ref(1);

    const props = defineProps({
        discountProducts: Array,
    });

    const handleCarousel = (action) => {
        if (action === 'up') {
            if (carouselPosition.value > 2) {
                carouselPosition.value = 1;
            } else {
                carouselPosition.value = carouselPosition.value + 1;
            }
        } else {
            if (carouselPosition.value === 1) {
                carouselPosition.value = 3;
            } else {
                carouselPosition.value = carouselPosition.value - 1;
            }
        }
    };
</script>