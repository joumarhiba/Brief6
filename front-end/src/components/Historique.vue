<template>
<div class="flex flex-col items-center m-auto overflow-auto w-3/6 h-4/5"
>
<div class="flex flex-col items-center  h-1/3 overflow-auto border border-gray-800">
    <h1 class="underline decoration-1 text-lg font-semibold	 mb-4">les rendez-vous futurs</h1>
    <table class="table-fixed w-4/5 text-center ">
    <thead class=" border-collapse	">
        <tr>
        <th>sujet</th>
        <th>date</th>
        <th>creneau</th>
        <th></th>
        </tr>
    </thead>
    <tbody class="">
        <tr v-for="item in futureRdvList" :key="item.id">
        <td class="w-20">{{ item["sujet"] }}</td>
        <td>{{ item["date"] }}</td>
        <td>{{ item["creneau"] }}</td>
        <td class="flex justify-around">
            <span class="hover:cursor-pointer hover:text-gray-500 s"><router-link :to="{name:'edit' , params: {id: item.idRdv}}">Edit</router-link></span>
            <span class="hover:cursor-pointer" @click="deleteRdv(item.idRdv)"
            >Delete</span
            >
        </td>
        </tr>
    </tbody>
    </table>
</div>
<div class="flex flex-col items-center h-1/3 overflow-auto border border-gray-800">
    <h1 class="underline decoration-1 text-lg font-semibold	mb-4">les rendez-vous d'aujourd'hui</h1>

    <table class="table-fixed w-4/5 text-center">
    <thead>
        <tr>
        <th>sujet</th>
        <th>date</th>
        <th>creneau</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="item in todayRdvList" :key="item.id">
        <td class="w-20">{{ item["sujet"] }}</td>
        <td>{{ item["date"] }}</td>
        <td>{{ item["creneau"] }}</td>
        </tr>
    </tbody>
    </table>
</div>

<div class="flex flex-col items-center h-1/3 overflow-auto border border-gray-800">
    <h1 class="underline decoration-1 text-lg font-semibold	mb-4">rendez-vous passées</h1>
    <table class="table-fixed w-4/5 text-center">
    <thead>
        <tr>
        <th>sujet</th>
        <th>date</th>
        <th>creneau</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="item in historiqueRdv" :key="item.id">
        <td class="w-20">{{ item["sujet"] }}</td>
        <td>{{ item["date"] }}</td>
        <td>{{ item["creneau"] }}</td>
        </tr>
    </tbody>
    </table>
</div>
</div>
</template>

<script>
import { reactive, ref, onMounted } from "vue";
import Cookies from "js-cookie";

export default {
name: "Historique",
props: { showHis: Boolean },
setup(props) {
const data = ref({
    idClient: "",
});

let historiqueRdv = reactive([]);
let todayRdvList = reactive([]);
let futureRdvList = reactive([]);

data.value.idClient = Cookies.get("id");

const hisRdv = async () => {
    const response = await fetch("http://localhost:3000/back/rdv/historique", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data.value),
    })
    .then((res) => res.json())
    .then((result) => {
        if (result.data.length !== 0) {
        result.data.forEach((element) => {
            historiqueRdv.push(element);
        });
        }
    });
};
const todayRdv = async () => {
    const response = await fetch("http://localhost:3000/back/rdv/todayRdv", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data.value),
    })
    .then((res) => res.json())
    .then((result) => {
        if (result.data.length !== 0) {
        result.data.forEach((element) => {
            todayRdvList.push(element);
        });
        }
    });
};
const futureRdv = async () => {
    const response = await fetch("http://localhost:3000/back/rdv/futureRdv", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data.value),
    })
    .then((res) => res.json())
    .then((result) => {
        if (result.data.length !== 0) {
        result.data.forEach((element) => {
            futureRdvList.push(element);
        });
        }
    });
};



onMounted(() => {
    hisRdv();
    todayRdv();
    futureRdv();
});

const deleteRdv = async (id) => {
    let response = await fetch("http://localhost:3000/back/rdv/removeRdv", {
    method: "POST",
    body: JSON.stringify({ idRdv: id }),
    });
    let json = await response.json();
    console.log(json);

    for (let index = 0; index < futureRdvList.length; index++) {
    if (futureRdvList[index].idRdv == id) {
        futureRdvList.splice(index, 1);
    }
    }
};

return {
    hisRdv,
    historiqueRdv,
    todayRdvList,
    futureRdvList,
    deleteRdv,
};
},
};
</script>

<style></style>
