<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen">
            <!-- Page Heading -->
            <header v-if="$slots.header" class="sticky flex flex-col items-center bg-primary -top-32 z-20">
                <Header/>
                <slot name="header" />
            </header>

            <!-- Page Content -->
            <main class="">
                <slot />
            </main>
            <Footer/>
        </div>
    </div>
</template>
