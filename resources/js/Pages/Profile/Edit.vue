<template>
    <Head title="Profil" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <h1 class="text-center font-semibold text-xl my-10">Bienvenue <span class="first-letter:uppercase">{{ user.firstname }}</span> <span class="first-letter:uppercase">{{ user.lastname }}</span></h1>
        <p v-if="message.length > 0" class="text-tertiary text-center mb-8 text-lg">{{ message }}</p>
        <div class="flex justify-center w-full">
            <Link :href="route('logout')" method="post">
                <button class="btn-primary px-6 mx-0 text-xl h-10">Se deconnecter</button>
            </Link>
        </div>
        <section class="w-full flex flex-col justify-center my-14">
            <div class="flex w-full justify-center">
                <div @click="tab = 1" :class="tab === 1 ? 'flex flex-col justify-center items-center h-32 w-[400px] border-2 border-primary rounded-md m-3.5 cursor-pointer' : 'flex flex-col justify-center items-center h-32 w-[400px] border border-grayTrans rounded-md m-3.5 cursor-pointer hover:border-2'">
                    <i class="fa-solid fa-address-book text-2xl"></i>
                    <p class="text-xl mt-4">Modifier vos données personnelles</p>
                </div>
                <div @click="tab = 2" :class="tab === 2 ? 'flex flex-col justify-center items-center h-32 w-[400px] border-2 border-primary rounded-md m-3.5 cursor-pointer' : 'flex flex-col justify-center items-center h-32 w-[400px] border border-grayTrans rounded-md m-3.5 cursor-pointer hover:border-2'">
                    <i class="fa-solid fa-truck-ramp-box text-2xl"></i>
                    <p class="text-xl mt-4">Vos commandes</p>
                </div>
            </div>
            <div class="flex w-full justify-center">
                <div @click="tab = 3" :class="tab === 3 ? 'flex flex-col justify-center items-center h-32 w-[400px] border-2 border-primary rounded-md m-3.5 cursor-pointer' : 'flex flex-col justify-center items-center h-32 w-[400px] border border-grayTrans rounded-md m-3.5 cursor-pointer hover:border-2'">
                    <i class="fa-solid fa-lock text-2xl"></i>
                    <p class="text-xl mt-4">Modifier votre mot de passe</p>
                </div>
                <div @click="tab = 4" :class="tab === 4 ? 'flex flex-col justify-center items-center h-32 w-[400px] border-2 border-primary rounded-md m-3.5 cursor-pointer' : 'flex flex-col justify-center items-center h-32 w-[400px] border border-grayTrans rounded-md m-3.5 cursor-pointer hover:border-2'">
                    <i class="fa-solid fa-at text-2xl"></i>
                    <p class="text-xl mt-4">Modifier votre addresse email</p>
                </div>
            </div>
        </section>
        <div class="flex justify-center w-full">
            <DeleteUserForm class="max-w-xl" />
        </div> 

        <section class="flex flex-col items-center pt-24">
            <UpdateProfileInformationForm
            v-if="tab === 1"
                :must-verify-email="mustVerifyEmail"
                :status="status"
                :user="user"
            />
            <UpdatePasswordForm v-else-if="tab === 3" />
            <UpdateUserEmail v-else-if="tab === 4" :email="user.email" />
        </section>
        <!-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        </div>

    -->
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import DeleteUserForm from './Partials/DeleteUserForm.vue';
    import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
    import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
    import { ref } from 'vue';
    import UpdateUserEmail from './Partials/UpdateUserEmail.vue';

    const tab = ref(0);

    const props = defineProps({
        mustVerifyEmail: Boolean,
        status: String,
        user: Object,
        message: String,
    });    
</script>

