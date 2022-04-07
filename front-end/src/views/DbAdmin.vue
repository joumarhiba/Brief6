<template>
<div>

      <h2 class=" my-16 decoration-1 text-lg font-bold mb-4">Les Réservations des Rendez-vous </h2>
      <AllClient  />
   
</div>

</template>
<script>
import AllClient from '@/components/AllClient.vue'
export default {
    name:'DbAdmin',
    components:{
        AllClient,
    },
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
    },
    onClick(e){
        e.preventDefault();
    },
    created() {
        this.clients =  this.showClients()
        // this.showhistory=  this.showhistory()
    },

    async deleteClient(idClient){
          const response = await fetch("http://localhost:3000/back/Admin/delete", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({"idClient":idClient})
            });
            const result = await response.json();
            console.log(result)
        
    },

    updateClient(idClient){

        // this.$router.push(`/editClient/${idClient}`)
         fetch(`http://localhost:3000/back/Admin/oneClient`,{
             method : 'POST',
             headers : {
                 'Content-type' : 'application/json',
                 'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token',
            },
             body :JSON.stringify(),
         })
     .then(res=>{res.json()
        console.log(res);
     })
    .catch(err=>console.error(err))
    },
   
}
    }
    
</script>

<style>
h2{
    padding-bottom: 10px;
    margin-left: 27%;
}
.container {
	max-width: 1000px;
	margin-right: auto;
	margin-left: 20%;
	display: flex;
	justify-content: center;
	min-height: 100vh;
}

.table {
	width: 80%;
}

.table-header {
	display: flex;
	width: 100%;
	background: #000;
    padding: 5px;
}

.table-row {
	display: flex;
	width: 80%;
	
}

.table-data,
.header__item {
	flex: 1 1 20%;
	text-align: center;
}

.header__item {
	text-transform: uppercase;
}

.filter__link {
	color: white;
	text-decoration: none;
	position: relative;
	display: inline-block;
	
    }
.filter__link:after {
		content: "";
		position: absolute;
		color: white;

		transform: translateY(-50%);
	}
button{
    width: 10%;
    background-color:rgb(139,92,246);
    color: #fff;
    border: none;
    padding: 2px;
}
.flex{
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    padding: 20px 0;
}
.options{
     width: 10%;
    background-color:rgb(139,92,246);
    color: #fff;
    border: none;
    padding: 2px;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
}
@media screen and (max-width : 840px) {
    h2{
        font-size: 1.2em;
    }
    .header__item{
        font-size: .9em;
    }
}	
@media screen and (max-width : 660px) {
    h2{
        padding: 30px 0;
        font-size: 1.1em;
        margin-left: 20%;
    }
    .header__item{
        font-size: .8em;
    }
    button{
        height: 40px;
         margin: 20px 0 0;
    }
}	
@media screen and (max-width : 525px) {
    h2{
        font-size: 1em;
    }
    .header__item{
        font-size: .72em;
    }
    button{
        height: 40px;
         margin: 20px 0 0;
         width: 13%;
    }
    .table-row{
         overflow: scroll;
    }
}
@media screen and (max-width : 423px) {
    h2{
        padding: 30px 0;
        font-size: .83em;
        margin-left: 16%;
    }
    .table-header{
        padding: 3px;
    }
    .header__item{
        font-size: .67em;
        text-transform: none;
    }
    button{
        height: 30px;
         margin: 24px 0 0;
         font-size:.76em;
    }
    .container{
        margin-left: 14%;
    }
}		
@media screen and (max-width : 335px) {
    h2{
        padding: 30px 0;
        font-size: .7em;
        margin-left: 20%;
    }
    .table-header{
        padding: 3px;
    }
    .header__item{
        font-size: .67em;
        text-transform: none;
    }
    button{
        height: 27px;
         margin: 24px 0 0;
         font-size:.7em;
    }
    .container{
        margin-left: 14%;
    }
    .options{
     width: 10%;
    background-color:rgb(139,92,246);
    color: #fff;
    border: none;
    padding: 2px;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
}
}

</style>