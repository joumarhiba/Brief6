<template>
    <div class="flex justify-center	 items-center md:w-full h-4/5 bg-gradient-to-r from-violet-400 to-violet-800 font-mono">
        
        <form  class=" w-2/6 h-1/3	" @submit.prevent="submit">
            <div class="flex justify-around  mb-3" >
                <div class="flex flex-col">
                    <label class="text-white">Nom : </label>
                    <input v-model="data.nom" type="text" class="outline-none border-2 border-purple-700 h-10 pl-1 p-5" placeholder="Entrer votre nom">
                    <p>{{ error.nom }}</p>
                </div>
                <div class="flex flex-col">
                    <label class="text-white">Prenom : </label>
                    <input v-model="data.prenom" type="text" class="outline-none border-2 border-purple-700 h-10 pl-1 p-5" placeholder="Entrer votre prenom">
                    <p>{{ error.prenom }}</p>
                </div>
            </div>
            <div class="flex justify-around mb-2">
                <div class="flex flex-col">
                    <label class="text-white">Age: </label>
                    <input v-model="data.age" type="number" class="outline-none border-2 border-purple-700 h-10 pl-1 p-5" placeholder="Entrer votre age">
                    <p>{{ error.age }}</p>
                </div>
                <div class="flex flex-col">
                    <label class="text-white">Profession : </label>
                    <input v-model="data.profession" type="text" class="outline-none border-2 border-purple-700 h-10 pl-1 p-5" placeholder="Entrer votre profession">
                    <p>{{ error.profession }}</p>
                </div>
            </div>
            <div class="flex mt-6 mx-14">
                <button  class="outline-none border-2 text-white px-4 py-2" >Submit</button>
            </div>
            <div class="w-max mx-14 mt-2 ">
                <p class="text-white">Do you have a reference? <router-link to="/login" class="text-blue-400 hover:underline"> Login Here</router-link></p>
                </div>
                <p>{{reference}}</p>
        </form>
        
    </div>
</template>

<script>
import { ref } from 'vue'   
import { useRouter } from 'vue-router'   
import firebase from 'firebase/compat/app'; 

export default {
    name: 'RegisterView',
    setup() {
        let reference = ref('')
        const error = ref({
            nom: "",
            age : "",
            prenom: "",
            profession:""
        })
        const data = ref({
            nom : "",
            prenom: "",
            age : "",
            profession:""
        })
        const router = useRouter();
        const submit = async () =>{
            if(data.value.nom.length && data.value.prenom.length && data.value.age && data.value.profession.length ){
                let res = await fetch("http://localhost:3000/back/client/add",{
                    method:"POST",
                    headers: {'Content-Type':'application/json'},
                    body:JSON.stringify(data.value)
                })
                let json = await res.json()
                reference.value = await json.reference  
                await router.push('/dashboard')          
            }else{
                if(!data.value.nom.length){
                     error.value.prenom = "Entrer votre prenom"
                }
                if(!data.value.prenom.length){
                    error.value.prenom = "Entrer votre prenom"
                }if(!data.value.age){
                    error.value.age = "Entrer votre age"
                }if(!data.value.profession.length){
                    error.value.profession = "Entrer votre profession"
                }
            }
            
        }
        
        return{
            data,submit,error,reference
        }
    }
}
</script>