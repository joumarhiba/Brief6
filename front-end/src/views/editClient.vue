<template>
    <div>
        <div class="flex flex-col items-center w-1/3  m-auto h-3/4 mt-14">
        <h1 class="text-xl mb-6 font-bold">Modifier un client</h1>
        <input type="text"  placeholder="entrer votre nom" class=" w-60  px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300  focus:text-gray-700  focus:border-purple-700 "   v-model="nom" >

        <div  class="my-4" >
                  <input type="text" placeholder="Entrer votre prenom" class="w-60 px-3 py-1.5 border border-solid border-gray-300" v-model="prenom">
        </div>
      <input  type="text" placeholder="Entrer votre age" class="w-60 px-3 py-1.5 border border-solid border-gray-300" v-model="profession">
        <input type="text" placeholder="Entrer votre profession" class="my-4 w-60 px-3 py-1.5 border border-solid border-gray-300" v-model="age">
        <button class=" border-2 border-purple-700 text-purple-700 p-2 hover:text-white hover:bg-purple-700 mt-4" @click="reserver">Enregister</button>
        </div>
        
        <div class="flex flex-col items-center w-1/3  m-auto h-3/4 mt-14">
            <h1 class="text-lg font-semibold mb-3">le client</h1>
            <div v-for="item in updClient" :key="item.idClient" class="border p-5">
                <p><span>Nom : </span>{{item.nom}}</p>
                <p><span>Prenom : </span>{{item.prenom}}</p>
                <p><span>age : </span>{{item.age}}</p>
                <p><span>profession: </span>{{item.profession}}</p>
            </div>
        </div>
        </div>
</template>

<script>
import { useRouter, useRoute } from 'vue-router'
import { onMounted, reactive, ref} from 'vue'
import Cookies from 'js-cookie'
export default {
    name:'editClient',
     setup(){
        const route = useRoute()
        let nom = ref('')
        let prenom = ref('')
        let age= ref('')
        let profession = ref('')
        
        const id = route.params.id

        let updClient = reactive([])

            const getClient = async()=>{
                let res = await fetch('http://localhost:3000/back/Admin/oneclient/?id='+id)
                let result = await res.json()
                return result
            }

            onMounted(()=>{
                getClient().then(result=>{
                    updClient.push(result)
                    nom.value = result.nom
                    prenom.value = result.prenom
                    age.value= result.age
                    profession.value = result.profession
                })
                
            })
             

        const router = useRouter();

        const dataUpdate = ref({
            nom: "",
            prenom: "",
            age:"",
            profession:"",
            idClient: id
        })

        const reserver = async()=>{
            dataUpdate.value.nom = nom.value
            dataUpdate.value.prenom =prenom.value
            dataUpdate.value.age = age.value
            dataUpdate.value.profession = profession.value

            await fetch("http://localhost:3000/back/Admin/Update",{
                    method:"POST",
                    headers: {'Content-Type':'application/json'},
                    body:JSON.stringify(dataUpdate.value)
            })
            .then(res=>res.json()).then(result=>console.log(result))  
            await router.push('/DbAdmin')
            
            
        }


        return{
            id,updClient,reserver,nom,prenom,profession,age,getClient,
                    }



     }
}
</script>