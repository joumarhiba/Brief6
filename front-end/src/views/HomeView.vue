<template>
  <div class="flex justify-center	 items-center	md:w-full h-4/5 bg-gradient-to-r from-violet-500 to-violet-700	">
    <div class="text-white text-xl">
      <router-link to="/register" class="w-28 border-2 p-4 m-4 ">Register</router-link>
      <router-link to="/login" class="w-28 border-2 py-4 px-6  m-4">Login</router-link>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: 'HomeView',
  components: {

  }
}
</script>
