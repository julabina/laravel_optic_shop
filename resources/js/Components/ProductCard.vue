<template>
    <article class="flex flex-col items-center w-[302px] border mx-2.5">
        <Link :href="route('product.show', { cat: product.category, id: product.id })" class="flex flex-col items-center">
            <h2 class="text-center px-6 mt-1 mb-4 h-10 leading-5 font-bold">{{ product.name }}</h2>
            <img :src="'/products/' + product.picture[0].path" :alt="'Photo de ' + product.name" class="object-cover object-center w-64 h-64">
        </Link>
        <p class="text-tertiary font-bold mt-4"><span class="absolute text-xs text-black -ml-9 mt-1">-{{ product.discountValue }}%</span>{{ price.toFixed(2) }} €</p>
        <div class="flex mt-2 mb-3">
            <button @click="inputValue--" :class="inputValue === 1 ? 'bg-gray-100 h-8 w-8 font-bold text-xl pb-2 py-0 leading-normal opacity-50 pointer-events-none' : 'bg-gray-200 bg-opacity-70 h-8 w-8 font-bold text-xl pb-2 py-0 leading-normal transition-colors hover:transition-colors hover:bg-gray-300'">-</button>
            <p class="flex items-center justify-center h-8 w-12 text-center mx-4 border border-black select-none">{{ inputValue }}</p>
            <button @click="inputValue++" :class="inputValue === product.stock ? 'bg-gray-100 h-8 w-8 font-bold text-xl pb-2 py-0 leading-normal opacity-50 pointer-events-none' : 'bg-gray-200 bg-opacity-70 h-8 w-8 font-bold text-xl pb-2 py-0 leading-normal transition-colors hover:transition-colors hover:bg-gray-300'">+</button>
        </div>
        <div class="mb-4">
            <Link :href="route('product.show', { cat: product.category, id: product.id })">
                <button class="btn-primary w-20">Infos</button>
            </Link>
            <button class="h-9 w-20 bg-black text-white rounded-sm uppercase font-semibold text-xs tracking-wider mx-1 transition-colors hover:transition-colors hover:bg-primary">Acheter</button>
        </div>
    </article>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const inputValue = ref(1);
    const price = ref(0);
    const discount = ref(false);

    const props = defineProps({
        product: Object,
    });
    
    onMounted(() => {
        console.log(props.product);
        if (props.product.onDiscount === true) {
            discount.value = true;
            price.value = props.product.price - ((props.product.price / 100)*props.product.discountValue);
        } else {
            price.value = props.product.price;
        }
    });
</script>