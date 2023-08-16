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
                <button @click="carouselPosition = 1" :class="carouselPosition === 1 ? 'h-2.5 w-2.5 mx-1.5 cursor-pointer bg-white rounded-full' : 'h-2.5 w-2.5 mx-1.5 cursor-pointer bg-white bg-opacity-30 rounded-full'"></button>
                <button @click="carouselPosition = 2" :class="carouselPosition === 2 ? 'h-2.5 w-2.5 mx-1.5 cursor-pointer bg-white rounded-full' : 'h-2.5 w-2.5 mx-1.5 cursor-pointer bg-white bg-opacity-30 rounded-full'"></button>
                <button @click="carouselPosition = 3" :class="carouselPosition === 3 ? 'h-2.5 w-2.5 mx-1.5 cursor-pointer bg-white rounded-full' : 'h-2.5 w-2.5 mx-1.5 cursor-pointer bg-white bg-opacity-30 rounded-full'"></button>
            </div>
        </section>            
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { ref } from 'vue';

    const carouselPosition = ref(1);

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