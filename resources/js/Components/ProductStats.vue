<template>
    <div class="w-[820px] border border-black my-16">
        <div class="statsArray h-auto min-h-[36px] bg-black text-white text-xl">
            <p class="w-80 pl-1.5">Caractéristiques</p>
            <p class="w-[500px]">{{ product.name }}</p>
        </div>
        <!-- TELESCOPE -->
        <div v-if="category === 'telescope'">
            <div class="statsArray">
                <p class="w-80 pl-1.5">Formule optique</p>
                <p class="w-[500px]">{{ product.telescope_attribute.type === 'achromatique' || product.telescope_attribute.type === 'apochromatique' ? 'lunette ' + product.telescope_attribute.type : 'telescope' + product.telescope_attribute.type }}</p>
            </div>
            <div class="statsArray bg-grayTrans">
                <p class="w-80 pl-1.5">Diamètre</p>
                <p class="w-[500px]">{{ product.telescope_attribute.diameter }}mm</p>
            </div>
            <div class="statsArray">
                <p class="w-80 pl-1.5">Longueur focale</p>
                <p class="w-[500px]">{{ product.telescope_attribute.focalLength }}mm</p>
            </div>
            <div class="statsArray bg-grayTrans">
                <p class="w-80 pl-1.5">Rapport F/D</p>
                <p class="w-[500px]">{{ Math.round(product.telescope_attribute.focalLength / product.telescope_attribute.diameter) }}</p>
            </div>
            <div class="statsArray">
                <p class="w-80 pl-1.5">Monture</p>
                <p class="w-[500px]">{{ product.telescope_attribute.mount !== null ? product.telescope_attribute.mount : 'aucune' }}</p>
            </div>
        </div>
        <!-- OCULAIRE -->
        <div v-else-if="category === 'oculaire'">
            <div class="statsArray">
                <p class="w-80 pl-1.5">Marque</p>
                <p class="w-[500px]">{{ product.brand.name }}</p>
            </div>
            <div class="statsArray bg-grayTrans">
                <p class="w-80 pl-1.5">Modèle</p>
                <p class="w-[500px]">{{ product.ocular_attribute.model }}</p>
            </div>
            <div class="statsArray">
                <p class="w-80 pl-1.5">Longueur focal</p>
                <p class="w-[500px]">{{ product.ocular_attribute.focalLength }}mm</p>
            </div>
            <div class="statsArray bg-grayTrans">
                <p class="w-80 pl-1.5">Champs apparent</p>
                <p class="w-[500px]">{{ product.ocular_attribute.fov }}°</p>
            </div>
            <div class="statsArray">
                <p class="w-80 pl-1.5">Distance de l'oeil</p>
                <p class="w-[500px]">{{ product.ocular_attribute.eyeRelief }}mm</p>
            </div>
            <div class="statsArray bg-grayTrans">
                <p class="w-80 pl-1.5">Coulant</p>
                <p class="w-[500px]">{{ product.ocular_attribute.size + '"' }}</p>
            </div>
        </div>
        <!-- MONTURE -->
        <div v-else-if="category === 'monture'">
            <div class="statsArray">
                <p class="w-80 pl-1.5">Type</p>
                <p class="w-[500px]">{{ product.mount_attribute.type }}</p>
            </div>
            <div class="statsArray bg-grayTrans">
                <p class="w-80 pl-1.5">Capacité de charge</p>
                <p class="w-[500px]">{{ product.mount_attribute.capacity }}kg</p>
            </div>
            <div class="statsArray">
                <p class="w-80 pl-1.5">GoTo</p>
                <p class="w-[500px]">{{ product.mount_attribute.goto === true ? 'Oui' : 'Non' }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
    const props = defineProps({
        product: Object,
        category: String,
    });
</script>