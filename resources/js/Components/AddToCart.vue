<template>
    <div v-if="toggleModal === true" class="modal-container">
        <div class="modal p-0 w-[500px]">
            <div class="flex items-center justify-center text-white bg-primary w-full h-12">
                <p class="uppercase">{{ product[1] }} article<span v-if="product[1] > 1">s</span> ajouté<span v-if="product[1] > 1">s</span> au panier</p>
            </div>
            <div class="flex flex-col items-center py-6">
                <h2 class="font-bold text-3xl w-4/5 leading-9 text-center">{{ product[0].name }}</h2>
                <p class="w-3/5 border-b border-grayTrans text-center pb-10 my-8">Prix unitaire: <span class="text-tertiary font-bold text-lg">{{ price.toFixed(2) }} €</span></p>
                <p class="w-3/5 text-center">Prix total: <span class="text-tertiary font-bold text-lg">{{ (price * product[1]).toFixed(2) }} €</span></p>
                <div class="flex justify-between w-4/5 mt-8">
                    <button @click="toggleModal = false" class="btn-primary px-3">Continuer les achats</button>
                    <button class="btn-primary px-3 bg-tertiary">Votre panier</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref } from 'vue';

    const toggleModal = ref(true);
    const price = ref(0);

    const props = defineProps({
        product: Array,
    });

    onMounted(() => {
        if (props.product[0].onDiscount === true) {
            const discount = (props.product[0].price / 100) * props.product[0].discountValue;

            price.value = props.product[0].price - discount;
        } else {
            price.value = props.product[0].price;
        }
    });
</script>