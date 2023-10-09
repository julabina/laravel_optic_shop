<template>
    <section class="w-full">
        <h1 class="text-2xl font-bold">Votre panier :</h1>
        <div class="flex">
            <button class="btn-primary px-2 h-7 mx-0 mr-2.5 mt-6">Mettre à jour</button>
            <button class="btn-primary px-2 h-7 mx-0 mr-2.5 mt-6">Vider le panier</button>
        </div>
        <div class="flex justify-between font-semibold mt-16 border-b-4 border-black px-1 pb-0.5">
            <p class="w-1/2">Article</p>
            <p class="w-1/6">Prix unitaire</p>
            <p class="w-1/6 text-center">Quantité</p>
            <p class="w-1/6 text-right">Montant</p>
        </div>
        <Article v-for="(article, ind) in articles" :key="'cartArticle' + ind" :article="article" />
    </section>
</template>

<script setup>
    import Article from '@/Components/CartStep/Article.vue';

    const props = defineProps({
        articles: Array,
    });
</script>