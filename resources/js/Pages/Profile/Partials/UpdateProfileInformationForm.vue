<template>
    <h2 class="text-3xl font-semibold text-center mb-24">Modifier vos infos personnelles</h2>
    <div class="w-[630px] border-b border-grayTrans pb-20 mb-16">
        <h3 class="text-md font-semibold mb-5">Vos coordonnées :</h3>
        <div class="flex w-full">
            <div class="flex flex-col w-[300px]">
                <label for="userAddressProfilFormLastname" class="mt-5 mb-0.5">Nom</label>
                <input v-model="address.lastname" type="text" id="userAddressProfilFormLastname">
            </div>
            <div class="flex flex-col w-[300px] ml-[30px]">
                <label for="userAddressProfilFormFirstname" class="mt-5 mb-0.5">Prenom</label>
                <input v-model="address.firstname" type="text" id="userAddressProfilFormFirstname">
            </div>
        </div>
        <div class="flex w-full">
            <div class="flex flex-col w-[300px]">
                <label for="userAddressProfilFormAddress" class="mt-5 mb-0.5">Adresse</label>
                <input v-model="address.address" type="text" id="userAddressProfilFormAddress">
            </div>
            <div class="flex flex-col w-[300px] ml-[30px]">
                <label for="userAddressProfilFormAddressComp" class="mt-5 mb-0.5">Complément d'adresse</label>
                <input v-model="address.addressComp" type="text" id="userAddressProfilFormAddressComp">
            </div>
        </div>
        <div class="flex w-full">
            <div class="flex flex-col w-[300px]">
                <label for="userAddressProfilFormPostal" class="mt-5 mb-0.5">Code postal</label>
                <input v-model="address.postal" type="text" id="userAddressProfilFormPostal">
            </div>
            <div class="flex flex-col w-[300px] ml-[30px]">
                <label for="userAddressProfilFormCity" class="mt-5 mb-0.5">Ville</label>
                <input v-model="address.city" type="text" id="userAddressProfilFormCity">
            </div>
        </div>
        <div class="flex w-full">
            <div class="flex flex-col w-[300px]">
                <label for="userAddressProfilFormMobile" class="mt-5 mb-0.5">Mobile</label>
                <input v-model="address.tel" type="text" id="userAddressProfilFormMobile">
            </div>
        </div>
    </div>

    <div class="w-[630px] border-b border-grayTrans pb-20 mb-16">
        <h3 class="text-md font-semibold mb-5">Votre status :</h3>
        <div class="flex items-center mt-12">
            <input class="ml-1" type="checkbox" v-model="isPro" id="isProForm">
            <label class="ml-1.5" for="isProForm">Vous êtes un professionnel.</label>
        </div>
        <div v-if="isPro === true" class="mt-5">
            <div class="flex items-center">
                <input class="ml-1" type="checkbox" v-model="proInfos.vatfree" id="vatFreeForm">
                <label class="ml-1.5" for="vatFreeForm">Vous ne facturez pas la TVA.</label>
            </div>
            <div class="flex w-full">
                <div class="flex flex-col w-[300px]">
                    <label for="userIsProForm" class="mt-5 mb-0.5">Nom de la société</label>
                    <input v-model="proInfos.name" type="text" id="userIsProForm">
                </div>
                <div class="flex flex-col w-[300px] ml-[30px]">
                    <label for="userIsProForm" class="mt-5 mb-0.5">Télécopie</label>
                    <input v-model="proInfos.fax" type="text" id="userIsProForm">
                </div>
            </div>
            <div class="flex w-full">
                <div class="flex flex-col w-[300px]">
                    <label for="userIsProForm" class="mt-5 mb-0.5">N° de SIRET</label>
                    <input v-model="proInfos.siret" type="text" id="userIsProForm">
                </div>
                <div v-if="proInfos.vatfree === false" class="flex flex-col w-[300px] ml-[30px]">
                    <label for="userIsProForm" class="mt-5 mb-0.5">N° de TVA intra-communautaire</label>
                    <input v-model="proInfos.vat" type="text" id="userIsProForm">
                </div>
            </div>
        </div>
    </div>

    <div class="w-[630px] pb-20 mb-12">
        <h3 class="text-md font-semibold mb-5">Adresse de livraison :</h3>
        <div class="flex items-center mt-12">
            <input class="ml-1" type="checkbox" v-model="sameDeliveyAddress" id="isDeleveryAdressSame">
            <label class="ml-1.5" for="isDeleveryAdressSame">Utiliser la même adresse pour la livraison.</label>
        </div>

        <div v-if="sameDeliveyAddress === false">
            <div class="flex w-full">
                <div class="flex flex-col w-[300px]">
                    <label for="userDeliveryAddressProfilFormAddress" class="mt-5 mb-0.5">Adresse</label>
                    <input v-model="deliveryAddress.address" type="text" id="userDeliveryAddressProfilFormAddress">
                </div>
                <div class="flex flex-col w-[300px] ml-[30px]">
                    <label for="userDeliveryAddressProfilFormAddressComp" class="mt-5 mb-0.5">Complément d'adresse</label>
                    <input v-model="deliveryAddress.addressComp" type="text" id="userDeliveryAddressProfilFormAddressComp">
                </div>
            </div>
            <div class="flex w-full">
                <div class="flex flex-col w-[300px]">
                    <label for="userDeliveryAddressProfilFormPostal" class="mt-5 mb-0.5">Code postal</label>
                    <input v-model="deliveryAddress.postal" type="text" id="userDeliveryAddressProfilFormPostal">
                </div>
                <div class="flex flex-col w-[300px] ml-[30px]">
                    <label for="userDeliveryAddressProfilFormCity" class="mt-5 mb-0.5">Ville</label>
                    <input v-model="deliveryAddress.city" type="text" id="userDeliveryAddressProfilFormCity">
                </div>
            </div>
        </div>
        <div v-else-if="sameDeliveyAddress === true" class="w-1/2 mx-auto mt-12 italic text-gray-700">
            <p>{{ address.address }}</p>
            <p>{{ address.addressComp }}</p>
            <p>{{ address.postal }} {{ address.city }}</p>
        </div>
    </div>

    <button @click="submit" class="btn-primary text-xl px-6 h-12">Modifier</button>
</template>

<script setup>
    import { onMounted, reactive, ref} from 'vue';

    const props = defineProps({
        mustVerifyEmail: Boolean,
        status: String,
        user: Object,
    });

    const isPro = ref(false);
    const sameDeliveyAddress = ref(true);

    const address = reactive({
        firstname: "",
        lastname: "",
        address: "",
        addressComp: "",
        postal: "",
        city: "",
        tel: "",
    });

    const proInfos = reactive({
        name: "",
        fax: "",
        siret: "",
        vatfree: false,
        vat: "",
    });

    const deliveryAddress = reactive({
        address: "",
        addressComp: "",
        postal: "",
        city: "",
    });

    onMounted(() => {
        if (props.user.address !== null) {
            
        }

        if (props.user.company !== null) {
            
        }
    });

    const submit = () => {
        console.log("test");
    };
</script>
