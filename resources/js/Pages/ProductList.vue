<template>
    <Head :title="category" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <div class="flex mx-auto w-[1480px]">
            <section class="w-52 my-5 mb-3 p-2 mr-7">
                <div v-if="category === 'oculaire'" class="border-b py-2">
                    <button @click="toggleRadioCheck" class="btn-primary mb-5 w-44">Sélectionner {{ toggleModelBrand ? 'marque' : 'modèle' }}</button>
                </div>
                <div class="border-b py-2">
                    <h2 class="uppercase font-bold text-lg text-primary tracking-wider mb-2">Marque</h2>
                    <div v-for="(brand, ind) in brands" :key="'brand' + ind" class="flex items-center cursor-pointer">
                        <input v-if="toggleModelBrand" @change="modelsChecked = 'default'" v-model="brandsChecked[0]" :value="brand" type="radio" name="checkBrandForModelsChoice" :id="'checkboxForBrand' + brand" class="w-3.5 h-3.5 rounded-full border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
                        <input v-else v-model="brandsChecked" :value="brand" type="checkbox" :id="'checkboxForBrand' + brand" class="w-3.5 h-3.5 rounded-sm border-2 border-gray-400 cursor-pointer checked:bg-tertiary focus:checked:bg-tertiary checked:hover:bg-tertiary checked:hover:bg-opacity-80">
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
                <div v-if="category === 'oculaire' && toggleModelBrand" class="border-b py-2">
                    <h2 class="uppercase font-bold text-lg text-primary tracking-wider mb-2">Modèle</h2>
                    <select v-model="modelsChecked" class="mb-2 text-xs w-44">
                        <option value="default">Tous les modèles</option>
                        <option v-if="brandsChecked[0] === 'skywatcher'" value="Super Plössl">Super Plössl</option>
                        <option v-if="brandsChecked[0] === 'televue'" value="Plössl">Plössl</option>
                        <option v-if="brandsChecked[0] === 'televue'" value="DeLite">DeLite</option>
                        <option v-if="brandsChecked[0] === 'televue'" value="Ethos">Ethos</option>
                        <option v-if="brandsChecked[0] === 'televue'" value="Nagler">Nagler</option>
                        <option v-if="brandsChecked[0] === 'televue'" value="Delos">Delos</option>
                        <option v-if="brandsChecked[0] === 'celestron'" value="X-cel">X-Cel</option>
                        <option v-if="brandsChecked[0] === 'celestron'" value="Luminos">Luminos</option>
                        <option v-if="brandsChecked[0] === 'orion'" value="edge-On">Edge-On</option>
                        <option v-if="brandsChecked[0] === 'orion'" value="Lanthanum">Lanthanum</option>
                        <option v-if="brandsChecked[0] === 'pentax'" value="XW">XW</option>
                        <option v-if="brandsChecked[0] === 'explore Scientific'" value="68°">68°</option>
                        <option v-if="brandsChecked[0] === 'explore Scientific'" value="82°">82°</option>
                        <option v-if="brandsChecked[0] === 'explore Scientific'" value="100°">100°</option>
                        <option v-if="brandsChecked[0] === 'baader'" value="Hyperion">Hyperion</option>
                    </select>
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
                <h1 class="first-letter:uppercase text-3xl trac">{{ category === 'telescope' ? 'Télescopes et Lunettes astronomiques' : category + 's' }}</h1>
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
                        <p class="">Aucun<span v-if="category === 'monture'">e</span> {{ category === 'telescope' ? 'télescope' : category }} ne correspond à la recherche</p>
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
    import { Head, Link, router } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const optionSelected = ref('alphaAsc');
    const productsFiltered = ref([]);
    const brands = ref([]);
    const brandsChecked = ref([]);
    const modelsChecked = ref('default');
    const types = ref([]);
    const typesChecked = ref([]);
    const onStock = ref(false);
    const withGoto = ref('all');
    const toggleModelBrand = ref(false);

    const props = defineProps({
        category: String,
        products: Array,
        filterBrands: Array,
        filterOnStock: Boolean,
        filterOther: Array,
        lastSee: Array,
        newAddToCart: Array,
    });

    onMounted(() => {
        productsFiltered.value = props.products.sort((a, b) => (a.name > b.name));
        toggleModelBrand.value = false;

        if (props.category === 'telescope') {
            brands.value = ['skywatcher', 'takahashi', 'celestron', 'unistellar'];
            types.value = ['achromatique', 'apochromatique', 'newton', 'maksutov', 'edge HD', 'schmidt-Cassegrain'];
            if (props.filterOther.length > 0) {
                typesChecked.value = props.filterOther[0];
            }
        } else if (props.category === 'oculaire') {
            brands.value = ['skywatcher', 'televue', 'celestron', 'orion', 'pentax', 'explore Scientific', 'baader']
        } else {
            brands.value = ['skywatcher', '10Micron', 'celestron', 'orion']
            types.value = ['azimutale', 'equatoriale'];
            if (props.filterOther[0] !== undefined) {
                typesChecked.value = props.filterOther[0];
            }
            if (props.filterOther[1] !== undefined && (props.filterOther[1] === 'with' || props.filterOther[1] === 'not')) {
                withGoto.value = props.filterOther[1];
            }
        }

        if (props.filterBrands && props.filterBrands.length > 0) {
            brandsChecked.value = props.filterBrands;
        }

        if (props.filterOnStock) {
            onStock.value = props.filterOnStock;
        }

        if (props.category === 'oculaire' && props.filterOther.length > 0 && (props.filterOther[0] !== '' || props.filterOther[0] !== 'default')) {
            modelsChecked.value = props.filterOther[0];
            toggleModelBrand.value = true;
        }
    });

    const toggleRadioCheck = () => {
        brandsChecked.value = [];
        modelsChecked.value = "default";
        toggleModelBrand.value = !toggleModelBrand.value;
    };
    
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
        let other = [];
        if (props.category === 'telescope') {
            other.push(typesChecked.value);
        } else if (props.category === 'oculaire') {
            other.push(modelsChecked.value);
        } else {
            other.push(typesChecked.value);
            other.push(withGoto.value);
        }

        router.visit(route('product.filter', { cat: props.category, filterBrand: brandsChecked.value, onStock: onStock.value, other: other }), {
            method: 'post',
        });
    };
</script>