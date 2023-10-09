<template>
    <article class="flex justify-between p-2 h-28 border-b-4 border-black">
        <div class="flex items-center w-1/2">
            <img class="h-24 w-24" :src="'/products/' + article[0].picture[0].path" :alt="'photo de ' + article[0].name">
            <p class="h-24 ml-8 text-lg pr-2">{{ article[0].name }}</p>
        </div>
        <div class="flex items-center w-1/6 px-1.5">
            <p class="font-semibold">{{ article[0].price.toFixed(2) }} €</p>
        </div>
        <div class="flex items-center justify-center w-1/6">
            <div class="flex">
                <button class="btn-primary h-8 w-8 p-0 m-0 text-lg rounded-none">-</button>
                <p class="flex items-center justify-center h-8 w-8 border-y border-grayTrans text-xs">{{ count }}</p>
                <button class="btn-primary h-8 w-8 p-0 m-0 text-lg rounded-none">+</button>
                <button class="ml-1.5 transition-opacity hover:transition-opacity hover:opacity-60"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        </div>
        <div class="flex items-center justify-end w-1/6 pr-1">
            <p class="text-tertiary font-semibold text-lg">{{ (article[0].price * count).toFixed(2) }} €</p>
        </div>
    </article>    
</template>

<script setup>
    import { onMounted, ref } from 'vue';

    console.log(props.article);
    const count = ref(0);

    const props = defineProps({
        article: Array,
    });

    onMounted(() => {
        count.value = props.article[1];
    });
</script>