<script setup>
import axios from 'axios'
import { ref } from 'vue'

const username = ref('')
const password = ref('')

async function login() {
  try {
    const response = await axios.post('http://127.0.0.1:81/api/users/login', {
      username: username.value,
      password: password.value
    })
    console.log(response)
    //const token = response.data.token
    //localStorage.setItem('jwt', token) // Store JWT
    //this.$router.push('/user') // Redirect to user page
    console.log('logged in')
  } catch (error) {
    console.error('Login failed:', error)
    // Handle error (e.g., show message)
  }
}
</script>

<template>
  <form @submit.prevent="login">
    <input v-model="username" placeholder="Username" required />
    <input v-model="password" type="password" placeholder="Password" required />
    <button type="submit">Login</button>
  </form>
</template>
