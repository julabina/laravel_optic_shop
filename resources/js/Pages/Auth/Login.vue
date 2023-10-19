<template>
    <Head title="Connexion" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <section class="w-full flex justify-center min-h-screen">
            
            <form @submit.prevent="submit" class="w-72">
                <h1 class="font-bold text-2xl text-center mt-14 mb-16">Se connecter</h1>
                <div>
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

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                </div>

                <button class="w-full btn-primary mt-6 text-xl h-10" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Se connecter
                </button>

                <div class="flex flex-col items-end justify-end mt-4">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mb-2"
                    >
                        Mot de passe oublié ?
                    </Link>
                    <Link :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Pas encore de compte ?
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

    defineProps({
        canResetPassword: {
            type: Boolean,
        },
        status: {
            type: String,
        },
    });

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };
</script>
