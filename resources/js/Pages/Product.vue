<template>
    <Head :title="category" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
</script>