<template>
    <Head :title="category" />

    <AuthenticatedLayout>
        <template #header>
        </template>

        <div class="flex flex-col mx-auto w-[1480px] min-h-screen">
            <section class="flex justify-between w-full mt-4 mb-20">
                <CartStep :active="step >= 1 ? true : false" title="Panier" icon="shopping-cart" />
                <CartStep :active="step >= 2 ? true : false" title="Coordonnées" icon="person" />
                <CartStep :active="step >= 3 ? true : false" title="Livraison" icon="truck" />
                <CartStep :active="step >= 4 ? true : false" title="Paiement" icon="credit-card" />
                <CartStep :active="step >= 5 ? true : false" title="Confirmation" icon="check" />
            </section>
            <p v-if="articles.length === 0" class="flex items-center justify-center w-full pt-40">Votre panier est vide.</p>
            <List v-else-if="step === 1" :articles="articles" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import CartStep from '@/Components/CartStep.vue';
    import List from '@/Components/CartStep/List.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { ref } from 'vue';

    const step = ref(1);
    const props = defineProps({
        articles: Array,
    });
</script>