<template>
    <div :class="active === true ? 'flex justify-center items-center w-52 h-8 text-black rounded-full border border-black' : 'flex justify-center items-center w-52 h-8 text-grayTrans rounded-full border border-grayTrans'">
        <i :class="'text-xs mr-1.5 fa-solid fa-' + icon"></i>
        <p>{{ title }}</p>
    </div>
</template>

<script setup>
    const props = defineProps({
        icon: String,
        title: String,
        active: Boolean,
    });
</script>