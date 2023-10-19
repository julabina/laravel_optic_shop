<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <DangerButton class="text-lg h-10 px-4" @click="confirmUserDeletion">Supprimer le compte</DangerButton>

    <div v-if="confirmingUserDeletion === true" class="modal-container">
        <div class="modal">
            <h2 class="text-lg font-medium text-primary text-center">
                Êtes-vous sûr de vouloir supprimer votre compte ?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. S'il vous plaît
                entrez votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.
            </p>

            <div class="mt-6">
                <InputLabel for="password" value="Mot de passe" class="sr-only" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Mot de passe"
                    @keyup.enter="deleteUser"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>

                <DangerButton
                    class="ml-3 px-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="deleteUser"
                >
                    Supprimer compte
                </DangerButton>
            </div>
        </div>
    </div>
</template>
