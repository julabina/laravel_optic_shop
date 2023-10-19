<script setup>
    import InputError from '@/Components/InputError.vue';
    import { useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';

    const passwordInput = ref(null);
    const currentPasswordInput = ref(null);

    const form = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const updatePassword = () => {
        form.put(route('password.update'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: () => {
                if (form.errors.password) {
                    form.reset('password', 'password_confirmation');
                    passwordInput.value.focus();
                }
                if (form.errors.current_password) {
                    form.reset('current_password');
                    currentPasswordInput.value.focus();
                }
            },
        });
    };
</script>

<template>
    <h2 class="text-3xl font-semibold text-center mb-24">Modifier votre mot de passe</h2>
    <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
        <div class="flex flex-col">
            <label class="mb-1" for="current_password">Mot de passe actuel</label>

            <input
                id="current_password"
                ref="currentPasswordInput"
                v-model="form.current_password"
                type="password"
                class="w-[400px]"
                autocomplete="current-password"
            />

            <InputError :message="form.errors.current_password" class="mt-2" />
        </div>

        <div class="flex flex-col">
            <label class="mb-1" for="password">Nouveau mot de passe</label>

            <input
                id="password"
                ref="passwordInput"
                v-model="form.password"
                type="password"
                class="w-[400px]"
                autocomplete="new-password"
            />

            <InputError :message="form.errors.password" class="mt-2" />
        </div>

        <div class="flex flex-col">
            <label class="mb-1" for="password_confirmation">Confirmer mot de passe</label>

            <input
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                class="w-[400px]"
                autocomplete="new-password"
            />

            <InputError :message="form.errors.password_confirmation" class="mt-2" />
        </div>

        <div class="flex items-center justify-center gap-4">
            <button class="btn-primary text-xl px-6 h-10 mt-10" :disabled="form.processing">Modifier</button>

            <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0"
            >
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
            </Transition>
        </div>
    </form>
</template>
