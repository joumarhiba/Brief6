<template>
  <div class="h-screen w-screen">
    <Navbar/> 
    <router-view/>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'

export default ({
  name:'App',
  components: {
      Navbar
  },
  setup() {
    
  },
})
</script>


<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');

*{
  padding: 0;
  margin: 0;
  font-family: poppins;

}
/* #app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  width: 100%;
  height: 100vh;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
} */
</style>
