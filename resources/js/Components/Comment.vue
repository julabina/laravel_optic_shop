<template>
    <article class="w-[600px] p-5 rounded-md bg-white mb-5">
        <div v-if="toggleUpdate === true" class="mb-5">
            <textarea v-model="commentPutText" class="w-full resize-y min-h-[40px] max-h-[180px]"></textarea>
            <p v-if="putCommentError.length > 0" class="text-error text-center">{{ putCommentError }}</p>
            <button @click="updateComment" class="btn-primary w-full mx-0 mt-1.5">Modifier</button>
        </div>
        <p v-else class="pb-5">{{ comment.content }}</p>
        <div class="flex justify-between border-t border-grayTrans pt-2">
            <div class="text-xs text-gray-400">
                <p>{{ commentUpdated ? 'Modifié' : 'Ajouté' }} le {{ commentDate }}</p>
                <p>À {{ commentHour }}</p>
                <p>Par <span class="first-letter:uppercase">{{ comment.user.firstname }}</span> <span class="first-letter:uppercase">{{ comment.user.lastname[0] }}</span>.</p>
            </div>
            <div v-if="$page.props.auth.user.id === comment.user_id" class="flex items-center">
                <button @click="toggleUpdate = !toggleUpdate" class="btn-primary px-1.5 py-1 h-auto font-normal">{{ toggleUpdate ? 'Annuler' : 'Modifier' }}</button>
                <button @click="toggleModalDelete = true" class="btn-primary px-1.5 py-1 h-auto font-normal">Supprimer</button>
            </div>
        </div>
    </article>
    <div v-if="toggleModalDelete === true" class="modal-container">
        <div class="modal">
            <p>Supprimer ce commentaire ?</p>
            <div class="flex justify-center mt-7">
                <button @click="toggleModalDelete = false" class="btn-primary px-3">Non</button>
                <button @click="deleteComment" class="btn-primary px-3">Oui</button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { router } from '@inertiajs/vue3';
    import { onMounted, ref } from 'vue';

    const props = defineProps({
        comment: Object,
        category: String,
    });

    const commentDate = ref('');
    const commentHour = ref('');
    const commentUpdated = ref(false);
    const toggleModalDelete = ref(false);
    const toggleUpdate = ref(false);
    const commentPutText = ref('');
    const putCommentError = ref('');

    onMounted(() => {
        if (props.comment.created_at === props.comment.updated_at) {
            const createdDate = new Date(props.comment.created_at);
            commentDate.value = createdDate.toLocaleDateString();
            commentHour.value = createdDate.toLocaleTimeString();
        } else {
            commentUpdated.value = false;
            const createdDate = new Date(props.comment.updated_at);
            commentDate.value = createdDate.toLocaleDateString();
            commentHour.value = createdDate.toLocaleTimeString();
        }

        commentPutText.value = props.comment.content;
    });

    const deleteComment = () => {
        router.visit(route('comment.delete', { cat: props.category, id: props.comment.id }), {
            method: 'delete',
        });
    };

    const updateComment = () => {
        putCommentError.value = '';

        if (commentPutText.value === '') {
            return putCommentError.value = 'Le commentaire ne doit pas être vide.';
        } else if (commentPutText.value.length > 254) {
            return putCommentError.value = 'Le commentaire ne doit pas dépasser 254 caractères (' + commentPutText.value.length + ' actuellement).';
        } else {
            return router.visit(route('comment.edit', { cat: props.category , id: props.comment.id }), {
                method: 'put',
                data: { content: commentPutText.value },
            });
        }
    };
</script>