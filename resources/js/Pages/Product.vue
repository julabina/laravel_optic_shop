<template>
    <Head :title="category" />

    <AuthenticatedLayout>
        <template #header>
        </template>
        
        <div class="flex flex-col mx-auto w-[1480px]">
            <section class="mt-10">
                <Link :href="route('product.list', { cat: category })" class="mt-8 mb-2.5 cursor-pointer transition-opacity hover:transition-opacity hover:opacity-70">
                    <p>{{ '< retour' }}</p>
                </Link>
                <div class="flex justify-between w-full">
                    <div class="flex justify-between w-[640px] border-b border-gray-300">
                        <div class="flex justify-center items-center w-full h-[500px] cursor-zoom-in">
                            <img :src="'/products/' + mainPicture" :alt="'photo de ' + product.name" class="h-[400px] w-[400px] object-cover">
                        </div>
                        <div v-if="product.picture.length > 1" class="flex flex-col mt-10">
                            <div @click="updateMainPicture(ind)" v-for="(picture, ind) in product.picture" :key="'productPicture' + ind" class="mx-10 my-5 w-20 h-20">
                                <div :class="mainPictureIndex === ind ? 'absolute w-20 h-20 cursor-pointer bg-black bg-opacity-50' : 'absolute w-20 h-20 cursor-pointer transition-all hover:transition-all hover:bg-black hover:bg-opacity-30'"></div>
                                <img :src="'/products/' + picture.path" :alt="'miniature de la photo ' + ind + ' de ' + product.name" class="h-20 w-20 object-cover">
                            </div>
                        </div>
                    </div>
                    <div class="w-[840px] border-l border-b border-gray-300 pt-2.5 pl-10">
                        <h1 class="w-4/5 font-bold text-3xl leading-6">{{ product.name }}</h1>
                        <div class="flex">
                            <p class="mt-14 mb-5 text-4xl font-bold">
                                {{ price.toFixed(2) }} € <span v-if="priceWithoutDiscount !== null" class="ml-5 text-3xl line-through decoration-4 decoration-black text-tertiary">{{ priceWithoutDiscount.toFixed(2) }} €</span>
                            </p>
                        </div>
                        <p :class="product.stock > 0 ? 'flex justify-center items-center rounded w-20 h-6 bg-greenValidate' : 'flex justify-center items-center rounded w-20 h-6 bg-tertiary'">{{ product.stock > 0 ? 'En stock' : 'Rupture' }}</p>
                        <div class="flex my-12">
                            <div class="flex">
                                <button @click="product.stock > 0 && inputValue--" :class="inputValue === 1 || inputValue === 0 ? 'bg-gray-100 h-14 w-14 font-bold text-2xl pb-.5 py-0 opacity-50 pointer-events-none' : 'bg-gray-200 bg-opacity-70 h-14 w-14 font-bold text-2xl pb-.5 py-0 transition-colors hover:transition-colors hover:bg-gray-300'">-</button>
                                <p :class="product.stock === 0 ? 'flex items-center justify-center h-14 w-28 text-center border border-gray-200 text-gray-500 select-none' : 'flex items-center justify-center h-14 w-28 text-center border border-gray-200 select-none'">{{ inputValue }}</p>
                                <button @click="product.stock > 0 && inputValue++" :class="inputValue === product.stock ? 'bg-gray-100 h-14 w-14 font-bold text-2xl pb-.5 py-0 opacity-50 pointer-events-none' : 'bg-gray-200 bg-opacity-70 h-14 w-14 font-bold text-2xl pb-.5 py-0 transition-colors hover:transition-colors hover:bg-gray-300'">+</button>
                            </div>
                            <button class="btn-primary h-14 ml-5 w-screen text-xl tracking-widest">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="flex flex-col items-center w-full bg-grayTrans my-10 rounded p-10">
                <div class="flex justify-between w-[900px]">
                    <div @click="currentTab = 1" :class="currentTab === 1 ? 'px-8 pt-3.5 pb-3 cursor-pointer select-none text-2xl uppercase bg-primary text-white rounded-sm' : 'px-8 pt-3.5 pb-3 cursor-pointer select-none text-2xl uppercase'">Description</div>
                    <div @click="currentTab = 2" :class="currentTab === 2 ? 'px-8 pt-3.5 pb-3 cursor-pointer select-none text-2xl uppercase bg-primary text-white rounded-sm' : 'px-8 pt-3.5 pb-3 cursor-pointer select-none text-2xl uppercase'">Caractéristiques</div>
                    <div @click="currentTab = 3" :class="currentTab === 3 ? 'px-8 pt-3.5 pb-3 cursor-pointer select-none text-2xl uppercase bg-primary text-white rounded-sm' : 'px-8 pt-3.5 pb-3 cursor-pointer select-none text-2xl uppercase'">Commentaire</div>
                </div>
                <div v-if="currentTab === 1" class="flex flex-col items-center">
                    <h2 class="w-full underline font-bold text-xl mt-10 mb-6">Tout savoir sur {{ product.name }}</h2>
                    <div v-for="(desc, ind) in product.descriptions" :key="'productDescription' + ind" class="">
                        <p v-if="desc.description !== null" class="w-full leading-5 my-4 text-lg">{{ desc.description }}</p>
                        <img v-else :src="'/products/' + desc.picturePath" :alt="'photo de presentation de ' + product.name" class="my-6 max-w-[900px]">
                    </div>
                </div>
                <div v-if="currentTab === 2" class="flex flex-col items-center">
                    <ProductStats :product="product" :category="category"/>
                </div>
                <div v-if="currentTab === 3" class="flex flex-col items-center"></div>
            </section>
        </div>
        
    </AuthenticatedLayout>
</template>

<script setup>
    import ProductStats from '@/Components/ProductStats.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        product: Object,
        category: String,
    });

    const priceWithoutDiscount = ref(null);
    const price = ref(0);
    const inputValue = ref(1);
    const mainPicture = ref(null);
    const mainPictureIndex = ref(0);
    const currentTab = ref(1);

    onMounted(() => {
        if (props.product.onDiscount === true) {
            price.value = props.product.price - ((props.product.price / 100) * props.product.discountValue);
            priceWithoutDiscount.value = props.product.price;
        } else {
            price.value = props.product.price;
        }

        if (props.product.stock === 0) {
            inputValue.value = 0;
        }

        mainPicture.value = props.product.picture[0].path;
    });
    console.log(props.product);

    const updateMainPicture = (index) => {
        if (mainPictureIndex !== index) {
            mainPictureIndex.value = index;
            mainPicture.value = props.product.picture[index].path;
        }
    };
</script>
