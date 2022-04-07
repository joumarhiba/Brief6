<template>
  <div class="flex flex-col items-center m-auto overflow-auto w-3/6 h-4/5">
    <div
      class="
        flex flex-col
        items-center
        h-1/3
        overflow-auto
        border border-gray-800
      "
    >
      <h1 @click="showClients()" class=" mx-2 underline decoration-1 text-lg font-semibold mb-4 cursor-pointer w-3/12">
        Afficher Tous les clients
      </h1>
      <table class="table-fixed w-4/5 text-center">
        <thead class="border-collapse">
          <tr>
            <th>Nom</th>
            <th>prenom</th>
            <th></th>
          </tr>
        </thead>
        <tbody >
          <tr v-for="client in clients" :key="client">
            <td class="w-20">{{ client.nom }}</td>
            <td>{{ client.prenom }}</td>
            <td class="flex justify-around">
              <span class="outline-none hover:cursor-pointer hover:text-gray-500 s"
                ><router-link
                  :to="{ name: 'editClient', params: { id: client.idClient } }"
                  >Edit</router-link
                ></span
              >
              <span class="hover:cursor-pointer"  @click="deleteClient(client.idClient)"
                >Delete</span
              >
            </td>
          </tr>
        </tbody>
      </table>
    </div>
 
        <tr v-for="item in historiqueRdv" :key="item.id">
        <td class="w-20">{{ item["sujet"] }}</td>
        <td>{{ item["date"] }}</td>
        <td>{{ item["creneau"] }}</td>
        </tr>

  </div>
</template>

<script>
import { reactive, ref, onMounted } from "vue";
import Cookies from "js-cookie";

export default {
  name: "AllClient",
     data(){
        return{
            clients : [],
     
        }
    },
    props:{
        nom :String
    },
   
    methods:{
        
       showClients(){   
     fetch(`http://localhost:3000/back/Admin/allC`)
     .then(res=>res.json())
    .then(result=>this.clients=result["clients"])
    .then((result) => {
        if (result.data > 0) {
        result.data.forEach((element) => {
            showClients.push(element);
        });
        }
    });
      
    },
     
    onClick(e){
        e.preventDefault();
    },


     async deleteClient(idClient){
          const response = await fetch("http://localhost:3000/back/Admin/delete", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({"idClient":idClient})
            });
            const result = await response.json();
            console.log(result)


            for(let i =0 ; i<this.clients.length; i++){
                 if (this.clients[i].idClient == idClient) {
                this.clients.splice(i, 1);
    }
            }
       
    },
  
    }


}
</script>

<style></style>
