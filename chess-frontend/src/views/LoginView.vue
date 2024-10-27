<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const username = ref('')
const password = ref('')

async function login() {
  try {
    const response = await axios.post('http://127.0.0.1:81/api/users/login', {
      username: username.value,
      password: password.value
    })
    console.log(response)
    const token = response.data.token
    console.log(token)
    localStorage.setItem('jwt', token)

    router.push({
      name: 'userPage'
    })
  } catch (error) {
    console.error('Login failed:', error)
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
