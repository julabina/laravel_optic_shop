<template>
    <article class="flex flex-col items-center w-[302px] border">
        <Link :href="route('product.show', { cat: product.category, id: product.id })" class="flex flex-col items-center">
            <h2 class="text-center px-6 mt-1 mb-4 h-10 leading-5 font-bold">{{ product.name }}</h2>
            <img :src="'/products/' + product.picture[0].path" :alt="'Photo de ' + product.name" class="object-cover object-center w-64 h-64">
        </Link>
        <p class="text-tertiary font-bold mt-4"><span v-if="product.onDiscount === true" class="absolute text-xs text-black -ml-9 mt-1">-{{ product.discountValue }}%</span>{{ product.onDiscount === false ? product.price.toFixed(2) : (product.price - ((product.price / 100)*product.discountValue)).toFixed(2) }} €</p>
        <div class="flex mt-2 mb-3">
            <button @click="product.stock > 0 && inputValue--" :class="inputValue === 1 || inputValue === 0 ? 'bg-gray-100 h-8 w-8 font-bold text-xl pb-2 py-0 leading-normal opacity-50 pointer-events-none' : 'bg-gray-200 bg-opacity-70 h-8 w-8 font-bold text-xl pb-2 py-0 leading-normal transition-colors hover:transition-colors hover:bg-gray-300'">-</button>
            <p :class="product.stock === 0 ? 'flex items-center justify-center h-8 w-12 text-center mx-4 border border-gray-200 text-gray-500 select-none' : 'flex items-center justify-center h-8 w-12 text-center mx-4 border border-black select-none'">{{ inputValue }}</p>
            <button @click="product.stock > 0 && inputValue++" :class="inputValue === product.stock ? 'bg-gray-100 h-8 w-8 font-bold text-xl pb-2 py-0 leading-normal opacity-50 pointer-events-none' : 'bg-gray-200 bg-opacity-70 h-8 w-8 font-bold text-xl pb-2 py-0 leading-normal transition-colors hover:transition-colors hover:bg-gray-300'">+</button>
        </div>
        <div class="mb-4">
            <Link :href="route('product.show', { cat: product.category, id: product.id })">
                <button class="btn-primary w-20">Infos</button>
            </Link>
            <button @click="product.stock > 0 && addToCart()" :class="product.stock === 0 ? 'h-9 w-20 bg-black bg-opacity-50 text-white rounded-sm uppercase cursor-not-allowed font-semibold text-xs tracking-wider mx-1 transition-colors' : 'h-9 w-20 bg-black text-white rounded-sm uppercase font-semibold text-xs tracking-wider mx-1 transition-colors hover:transition-colors hover:bg-primary'">Acheter</button>
        </div>
    </article>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const inputValue = ref(1);

    const props = defineProps({
        product: Object,
    });

    onMounted(() => {
        if (props.product.stock === 0) {
            inputValue.value = 0;
        }
    });

    const addToCart = () => {

    };
</script>