<script setup>
    import { router, useForm } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const toggleConfirEmailModal = ref(false);
    const confirmPwd = ref("");
    const modalError = ref('');

    const form = useForm({
        email: "",
    });

    const props = defineProps({
        email: String,
    });

    onMounted(() => {
        form.email = props.email;
    });

    const submit = () => {
        modalError.value = "";

        if (confirmPwd.value.length > 0) {
            router.visit(route('profile.updateMail'), {
                method: 'put',
                data: {
                    password: confirmPwd.value,
                    email: form.email,
                }
            })
        } else {
            modalError.value = "Mot de passe requis.";
        }
    };

    const toggleConfirm = () => {
        if (form.email !== props.email) {   
            toggleConfirEmailModal.value = true;
        }
    };
</script>

<template>
    <h2 class="text-3xl font-semibold text-center mb-24">Modifier votre adresse email</h2>
    <form @submit.prevent="toggleConfirm" class="mt-6 space-y-6">
        <div class="flex flex-col w-[400px]">
            <label class="mb-1" for="updateEmail">Email</label>
            <input v-model="form.email" type="email" id="updateEmail">
        </div>

        <div class="flex justify-center">
            <button class="btn-primary text-xl px-6 h-10 mt-10" type="submit">Modifier</button>
        </div>
    </form>

    <div v-if="toggleConfirEmailModal === true" class="modal-container">
        <div class="modal">
            <h2 class="mb-6 text-lg font-medium text-primary text-center">Vous souhaitez changer votre adresse email ?</h2>
            <p class="mt-1 text-sm text-gray-600">Modifier {{ props.email }} par {{ form.email }}</p>
            <p class="mt-1 text-sm text-gray-600">Pour changer votre adresse email, veuillez confirmer votre mot de passe</p>
            
            <div class="flex flex-col mt-6">
                <label for="updateEmailModal">Mot de passe</label>
                <input v-model="confirmPwd" type="password" id="updateEmailModal">
                <p class="text-tertiary text-sm pl-0.5">{{ modalError }}</p>
            </div>

            <div class="flex justify-end mt-12">
                <button @click="toggleConfirEmailModal = false" class="btn-primary px-2">Annuler</button>
                <button @click="submit" class="btn-primary px-2">Modifier</button>
            </div>
        </div>
    </div>
</template>
