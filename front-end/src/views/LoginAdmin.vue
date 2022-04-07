<template>
<div class="flex justify-center	 items-center md:w-full h-4/5 bg-gradient-to-r from-violet-400 to-violet-800 font-mono">
        <form class="w-1/6 h-2/6 " @submit.prevent="submit">
            <div class="m-auto flex flex-col mb-4">
                <label for="" class="text-slate-200 text-xl">Reference: </label>
                <input v-model="data.reference" type="text" class="outline-none border-2 border-purple-700 h-10 pl-1 " placeholder="Entrer votre reference">
            </div>
            <button  class="w-24 text-base border-2 p-2 text-slate-100 hover:bg-white hover:text-purple-700 mb-2" >Submit</button>
            <p class="text-white">Need a reference? <router-link to="/register" class="text-blue-400 hover:underline">Register Here</router-link></p>
        </form>
    </div>
</template>

<script>
import { ref ,onMounted } from 'vue'   
import { useRouter } from 'vue-router'   
import Cookies from 'js-cookie'

export default {
    name: 'loginAdmin',
    setup() {
        const data = ref({
            reference : "",
        })
        const router = useRouter();
        const submit = async() =>{
            if(data.value.reference.length){
                let response = await fetch("http://localhost:3000/back/Admin/loginAdmin",{
                method:"POST",
                headers: {'Content-Type':'application/json'},
                body:JSON.stringify(data.value)
                })
                let result = await response.json()
                console.log(result.reference)
                if(result.reference == "admin"){
                    Cookies.set('id',result.reference)
                    await router.push('/DbAdmin')
                }
                else{
                    console.log("hello no login for admin ");
                }
                
            }
        }
        
        onMounted(()=>{
            if(Cookies.get("id")){
                router.push('/DbAdmin')
            }
        })

        return{
            data,submit
        }
    }
}

</script>

