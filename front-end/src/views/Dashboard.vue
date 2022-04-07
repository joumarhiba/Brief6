<template>
<div class="flex md:w-full h-5/6">
<div class="w-2/12 flex">
    <div class="flex flex-col m-auto">
    <button class="text-xl w-52 mb-2 py-2 hover:underline" @click="showRes">Réserver</button>
    <button class="text-xl w-52 py-2 hover:underline" @click="showHistorique">historique</button>
    </div>
    <router-link to="/" @click="logOut" class="flex mx-auto mb-2 self-end border-2 border-purple-700 text-purple-700 p-2 hover:text-white hover:bg-purple-700" >Log Out</router-link>
</div>
<div class="flex items-center w-10/12 bg-slate-200 overflow-auto">
    <Reservation  v-if="showSelect" />
    <Historique  v-if="showHis" />
</div>
</div>
</template>

<script>
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import Cookies from "js-cookie";
import Reservation from "../components/Reservation.vue";
import Historique from "../components/Historique.vue";

export default {
components: {
Reservation,
Historique,
},
setup() {
let showSelect = ref(true);
let showHis = ref(false);
const userInfo = ref("");
const userId = ref({
    id: "",
});

const showRes = () => {
    showSelect.value = true;
    showHis.value = false;
};
const showHistorique = () => {
    showHis.value = true;
    showSelect.value = false;
};

const logOut = () => {
    Cookies.remove("id");
};

const router = useRouter();

const user = async () => {
    const response = await fetch("http://localhost:3000/back/Client/user", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(userId.value),
    });
    const result = await response.json();
    return result;
};

onMounted(() => {
    if (Cookies.get("id")) {
    userId.value.id = Cookies.get("id");
    user().then((res) => (userInfo.value = res.data[0]));
    }
});

return {
    logOut,
    userInfo,
    userId,
    showSelect,
    showRes,
    showHistorique,
    showHis
};
},
};
</script>


