<template>
    <Head title="Promotions" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <div class="flex mx-auto w-[1480px]">
            <section class="w-52 my-5 mb-3 p-2 mr-7">
                <div class="border-b py-2">
                    <h2 class="uppercase font-bold text-lg text-primary tracking-wider mb-2">Catégorie</h2>
                    <div class="flex items-center cursor-pointer">
                        <input v-model="categorieChecked" value="telescope" type="checkbox" id="checkboxForDiscountCatTelescope" class="w-3.5 h-3.5 rounded-sm border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label for="checkboxForDiscountCatTelescope" class="ml-1.5 cursor-pointer">Télescope</label>
                    </div>
                    <div class="flex items-center cursor-pointer">
                        <input v-model="categorieChecked" value="oculaire" type="checkbox" id="checkboxForDiscountCatOcular" class="w-3.5 h-3.5 rounded-sm border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label for="checkboxForDiscountCatOcular" class="ml-1.5 cursor-pointer">Oculaire</label>
                    </div>
                    <div class="flex items-center cursor-pointer">
                        <input v-model="categorieChecked" value="monture" type="checkbox" id="checkboxForDiscountCatMount" class="w-3.5 h-3.5 rounded-sm border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label for="checkboxForDiscountCatMount" class="ml-1.5 cursor-pointer">Monture</label>
                    </div>
                </div>                          
                <div class="flex flex-col border-b pt-4 pb-4">
                    <button @click="filter" class="btn-primary mb-5 w-44">Filtrer</button>
                    <button @click="reinit" class="btn-primary w-44">Réinitialiser filtres</button>
                </div>
            </section>
            <section class="w-[1250px] mt-5">
                <h1 class="first-letter:uppercase text-3xl trac">Promotions</h1>
                <select @change="sortProducts" v-if="products.length > 0" v-model="optionSelected" class="border border-black h-7 w-96 pl-2.5 mt-5 mb-12 py-0 text-sm font-light">
                    <option value="alphaAsc">Trier par ordre alphabétique croissant</option>
                    <option value="alphaDesc">Trier par ordre alphabétique décroissant</option>
                    <option value="priceAsc">Trier par prix croissant</option>
                    <option value="priceDesc">Trier par prix décroissant</option>
                </select>
                <div class="w-full">
                    <div v-if="products.length > 0" class="flex flex-wrap gap-y-6 gap-x-3 w-full">
                        <ProductCard v-for="(product, ind) in productsFiltered" :key="'productList' + ind" :product="product" />
                    </div>
                    <div v-else class="flex justify-center w-full text-2xl mt-40">
                        <p class="">Aucun produit ne correspond à la recherche</p>
                    </div>
                </div>
                <div class="border-t py-4 mt-20 pt-16">
                    <h2 class="text-3xl mb-12">articles vus récemment</h2>
                    <div class="flex flex-wrap gap-y-6 gap-x-3 w-full">
                        <ProductCard v-for="(see, ind) in lastSee" :key="'productLastSee' + ind" :product="see" />
                    </div>
                </div>
            </section>
            <AddToCart v-if="newAddToCart.length > 0" :product="newAddToCart" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import AddToCart from '@/Components/AddToCart.vue';
    import ProductCard from '@/Components/ProductCard.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const optionSelected = ref('alphaAsc');
    const productsFiltered = ref([]);
    const productsBeforeSorted = ref([]);
    const categorieChecked = ref([]);

    const props = defineProps({
        products: Array,
        lastSee: Array,
        newAddToCart: Array,
    });

    onMounted(() => {
        productsBeforeSorted.value = props.products;

        sortProducts();
    });
    
    const sortProducts = () => {
        if (optionSelected.value === 'alphaAsc') {
            productsFiltered.value = productsBeforeSorted.value.sort((a, b) => (a.name > b.name));
        } else if (optionSelected.value === 'alphaDesc') {
            productsFiltered.value = productsBeforeSorted.value.sort((a, b) => (b.name > a.name));
        } else if (optionSelected.value === 'priceAsc') {
            productsFiltered.value = productsBeforeSorted.value.sort((a, b) => a.price - b.price);
        } else if (optionSelected.value === 'priceDesc') {
            productsFiltered.value = productsBeforeSorted.value.sort((a, b) => b.price - a.price);
        }
    };

    const filter = () => {
        let arr = [];

        props.products.forEach(el => {
            if (categorieChecked.value.includes(el.category)) {
                arr.push(el);
           } 
        });

        productsBeforeSorted.value = arr;
        
        sortProducts();
    };
    
    const reinit = () => {
        productsBeforeSorted.value = props.products;

        sortProducts();
    };
</script>