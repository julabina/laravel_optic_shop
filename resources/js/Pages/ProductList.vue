<template>
    <Head :title="category" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <div class="flex mx-auto w-[1480px]">
            <section class="w-52 my-5 mb-3 p-2 mr-7">
                <div class="border-b py-2">
                    <h2 class="uppercase font-bold text-lg text-primary tracking-wider mb-2">Marque</h2>
                    <div v-for="(brand, ind) in brands" :key="'brand' + ind" class="flex items-center cursor-pointer">
                        <input v-model="brandsChecked" :value="brand" type="checkbox" :id="'checkboxForBrand' + brand" class="w-3.5 h-3.5 rounded-sm border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label :for="'checkboxForBrand' + brand" class="ml-1.5 cursor-pointer"><p class="first-letter:uppercase">{{ brand }}</p></label>
                    </div>
                </div>
                <div v-if="category !== 'oculaire'" class="border-b py-2">
                    <h2 class="uppercase font-bold text-lg text-primary tracking-wider mb-2">Type</h2>
                    <div v-for="(type, ind) in types" :key="'type' + ind" class="flex items-center cursor-pointer">
                        <input v-model="typesChecked" :value="type" type="checkbox" :id="'checkboxForType' + type" class="w-3.5 h-3.5 rounded-sm border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label :for="'checkboxForType' + type" class="ml-1.5 cursor-pointer"><p class="first-letter:uppercase">{{ type }}</p></label>
                    </div>
                </div>
                <div v-if="category === 'monture'" class="border-b py-2">
                    <h2 class="uppercase font-bold text-lg text-primary tracking-wider mb-2">Goto</h2>
                    <div class="flex items-center cursor-pointer">
                        <input v-model="withGoto" type="radio" id="radioForGoto1" value="all" name="radioGoto" class="w-3.5 h-3.5 rounded-full border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label for="radioForGoto1" class="ml-1.5 cursor-pointer"><p class="first-letter:uppercase">Tous</p></label>
                    </div>
                    <div class="flex items-center cursor-pointer">
                        <input v-model="withGoto" type="radio" id="radioForGoto2" value="with" name="radioGoto" class="w-3.5 h-3.5 rounded-full border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label for="radioForGoto2" class="ml-1.5 cursor-pointer"><p class="first-letter:uppercase">Avec</p></label>
                    </div>
                    <div class="flex items-center cursor-pointer">
                        <input v-model="withGoto" type="radio" id="radioForGoto3" value="not" name="radioGoto" class="w-3.5 h-3.5 rounded-full border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label for="radioForGoto3" class="ml-1.5 cursor-pointer"><p class="first-letter:uppercase">Sans</p></label>
                    </div>
                </div>
                <div class="border-b py-2">
                    <h2 class="uppercase font-bold text-lg text-primary tracking-wider mb-2">En stock</h2>
                    <div class="flex items-center cursor-pointer">
                        <input v-model="onStock" type="checkbox" id="checkboxForOnStock" class="w-3.5 h-3.5 rounded-sm border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <label for="checkboxForOnStock" class="ml-1.5 cursor-pointer"><p class="first-letter:uppercase">Produits en stock</p></label>
                    </div>
                </div>
                <div class="flex flex-col border-b pt-4 pb-4">
                    <button @click="filter" class="btn-primary mb-5 w-44">Filtrer</button>
                    <Link :href="route('product.list', { cat: category })" class="w-44">
                        <button class="btn-primary w-44">Réinitialiser filtres</button>
                    </Link>
                </div>
            </section>
            <section class="w-[1250px] mt-5">
                <h1 class="first-letter:uppercase text-3xl trac">{{ category === 'telescope' ? 'Télescopes et Lunettes astronomiques' : category }}</h1>
                <select @change="sortProducts" v-model="optionSelected" class="border border-black h-7 w-96 pl-2.5 mt-5 mb-12 py-0 text-sm font-light">
                    <option value="alphaAsc">Trier par ordre alphabétique croissant</option>
                    <option value="alphaDesc">Trier par ordre alphabétique décroissant</option>
                    <option value="priceAsc">Trier par prix croissant</option>
                    <option value="priceDesc">Trier par prix décroissant</option>
                </select>
                <div class="">
                    <div class="flex flex-wrap gap-y-6 gap-x-3 w-full">
                        <ProductCard v-for="(product, ind) in productsFiltered" :key="'productList' + ind" :product="product" />
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import ProductCard from '@/Components/ProductCard.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const optionSelected = ref('alphaAsc');
    const productsFiltered = ref([]);
    const brands = ref([]);
    const brandsChecked = ref([]);
    const types = ref([]);
    const typesChecked = ref([]);
    const onStock = ref(false);
    const withGoto = ref('all')

    const props = defineProps({
        category: String,
        products: Array,
        filterBrands: Array,
        filterOnStock: Boolean,
    });

    onMounted(() => {
        productsFiltered.value = props.products.sort((a, b) => (a.name > b.name));

        if (props.category === 'telescope') {
            brands.value = ['skywatcher', 'takahashi', 'celestron', 'unistellar'];
            types.value = ['achromatique', 'apochromatique', 'newton', 'maksutov', 'edge HD', 'schmidt-Cassegrain'];
        } else if (props.category === 'oculaire') {
            brands.value = ['skywatcher', 'televue', 'celestron', 'orion', 'pentax', 'explore Scientific', 'baader']
        } else {
            brands.value = ['skywatcher', '10Micron', 'celestron', 'orion']
            types.value = ['azimutale', 'equatorial'];
        }

        if (props.filterBrands && props.filterBrands.length > 0) {
            brandsChecked.value = props.filterBrands;
        }

        if (props.filterOnStock) {
            onStock.value = props.filterOnStock;
        }
    });
    
    const sortProducts = () => {
        if (optionSelected.value === 'alphaAsc') {
            productsFiltered.value = props.products.sort((a, b) => (a.name > b.name));
        } else if (optionSelected.value === 'alphaDesc') {
            productsFiltered.value = props.products.sort((a, b) => (b.name > a.name));
        } else if (optionSelected.value === 'priceAsc') {
            productsFiltered.value = props.products.sort((a, b) => a.price - b.price);
        } else if (optionSelected.value === 'priceDesc') {
            productsFiltered.value = props.products.sort((a, b) => b.price - a.price);
        }
    };

    const filter = () => {
        router.visit(route('product.filter', { cat: props.category, filterBrand: brandsChecked.value, onStock: onStock.value }), {
            method: 'post',
        });
    };
</script>