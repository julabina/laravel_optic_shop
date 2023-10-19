<template>
    <Head title="S'enregistrer" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <section class="w-full flex justify-center min-h-screen">
            
            <form @submit.prevent="submit" class="w-72">
                <h1 class="font-bold text-2xl text-center mt-14 mb-12">S' enregistrer</h1>
                <div class="mt-4">
                    <InputLabel class="font-semibold" for="firstname" value="Prenom" />

                    <input
                        id="firstname"
                        type="text"
                        class="mt-1 block w-full h-9"
                        v-model="form.firstname"
                        required
                        autofocus
                        autocomplete="firstname"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mt-4">
                    <InputLabel class="font-semibold" for="lastname" value="Nom" />

                    <input
                        id="lastname"
                        type="text"
                        class="mt-1 block w-full h-9"
                        v-model="form.lastname"
                        required
                        autofocus
                        autocomplete="lastname"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mt-4">
                    <InputLabel class="font-semibold" for="email" value="Email" />

                    <input
                        id="email"
                        type="email"
                        class="mt-1 block w-full h-9"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel class="font-semibold" for="password" value="Mot de passe" />

                    <input
                        id="password"
                        type="password"
                        class="mt-1 block w-full h-9"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel class="font-semibold" for="password_confirmation" value="Confirmer mot de passe" />

                    <input
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full h-9"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <button class="w-full btn-primary mt-10 text-xl h-10" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    S' enregistrer
                </button>

                <div class="flex flex-col items-end justify-end mt-4">
                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Deja un compte ?
                    </Link>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import Checkbox from '@/Components/Checkbox.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';

    defineProps({
        canResetPassword: {
            type: Boolean,
        },
        status: {
            type: String,
        },
    });

    const form = useForm({
        firstname: '',
        lastname: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>

<!-- <script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full h-9"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full h-9"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full h-9"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full h-9"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
 -->