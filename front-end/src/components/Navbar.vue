<template>
    <nav class="h-max md:h-16 flex flex-col md:justify-around md:flex-row md:items-center pl-3 md:pl-0">
        <h1 class="text-xl font-semibold tracking-widest"><span class="text-violet-700 text-2xl font-bold	">A</span>rch.</h1> 
        <ul class="w-1/4 flex flex-col md:flex-row justify-center md:justify-around font-bold">
            <li><router-link to="/" class="hover:text-indigo-600">Home</router-link></li>
            <li><router-link to="/login" class="hover:text-indigo-600">Login</router-link></li>
            <li><router-link to="/loginAdmin" class="hover:text-indigo-600">Admin</router-link></li>
        </ul>
    </nav>
</template>

<script>
export default {
    name:"Navbar",

}
</script>

<style>

</style>