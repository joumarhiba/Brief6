<template>
    <div class="flex flex-col items-center w-1/3  m-auto h-3/4	">
        <h1 class="text-xl mb-6 font-bold">PRENDRE VOTRE RENDEZ-VOUS</h1>
        <input type="date"  class=" outline-none w-60  px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300  focus:text-gray-700  focus:border-purple-700 "   :min="min" v-model="dateChoose" @change="change">

        <div  class="my-4" >
            <select name="" id="" class="outline-none w-60 px-3 py-1.5 border border-solid border-gray-300" @change="creneauSelect($event)">
                <option value="0" selected disabled hidden >Choose here</option>
                <option :value="item.id" v-for="item in creneauToShow" :key="item.id" >{{item.creneau}}</option>
            </select>
        </div>
        <input type="text" placeholder="Entrer le sujet du RDV " class="outline-none w-60 px-3 py-1.5 border border-solid border-gray-300" v-model="sujet">
        <button class=" border-2 border-purple-700 text-purple-700 p-2 hover:text-white hover:bg-purple-700 mt-4" @click="reserver">enregister le Rendez-vous</button>
    </div>
</template>

<script>
import { reactive, ref} from 'vue'
import Cookies from 'js-cookie'


export default {
    name:"Reservation",
    props:{showSelect:Boolean },
    setup(props){
        const dateChoose = ref('')
        const sujet = ref('')
        let creneauSelected  = ref('')
        
        const data = ref({
            date:""
        })    

        const creneauArray = [
            {id:1,creneau:'de 10 h à 10:30h'},
            {id:2,creneau:'de 11 h à 11:30h'},
            {id:3,creneau:'de 14 h à 14:30h'},
            {id:4,creneau:'de 15 h à 15:30h'},
            {id:5,creneau:'de 16 h à 16:30h'},
        ]

        let rdv = reactive([])

        let creneauToShow = ref([])

        const change = async ()=>{
            data.value.date = dateChoose.value
            let res = await fetch("http://localhost:3000/back/rdv/one",{
                method:"POST",
                headers: {'Content-Type':'application/json'},
                body:JSON.stringify(data.value)
            })
            .then(res=>res.json()).then(result=>{
                rdv = []
                if(result.data.length!==0){
                    result.data.forEach(element => {
                            rdv.push(element.creneau)
                    });
                }
            })
            
            
            creneauToShow.value = creneauArray.filter(
                e => !rdv.includes(e.id)
            )
        }
        
        const creneauSelect = (event)=>{
            creneauSelected  = event.target.value
        }


        const dataReservation = ref({
            sujet: "",
            date : dateChoose.value,
            creneau: creneauSelected.value,
            idClient: Cookies.get("id")
        })

        const reserver = async ()=>{
            dataReservation.value.sujet = sujet.value
            dataReservation.value.date =dateChoose.value
            dataReservation.value.creneau =creneauSelected

            await fetch("http://localhost:3000/back/rdv/add",{
                    method:"POST",
                    headers: {'Content-Type':'application/json'},
                    body:JSON.stringify(dataReservation.value)
            })
            
            dateChoose.value = ""
            sujet.value = ""
            
        }

        


        const date = new Date().toLocaleDateString()
        var result = date.split("/");

        const min = result[2]+"-"+result[1]+"-"+result[0]

        return{
            date,min,dateChoose,change,creneauToShow,creneauSelect,creneauSelected,sujet,reserver,
        }
    }
    
}
</script>
    
<style>

</style>