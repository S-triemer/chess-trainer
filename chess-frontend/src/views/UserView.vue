<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'

const userData = ref(null)

onMounted(async () => {
  try {
    const token = localStorage.getItem('jwt')
    const response = await axios.get('http://127.0.0.1:81/api/user', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    console.log(response)
    userData.value = response.data
    console.log(userData.value.user)
  } catch (error) {
    console.error('Failed to fetch user data:', error)
    window.location.href = '/login'
  }
})
</script>

<template>
  <div>
    <h1>User Profile</h1>
    <p v-if="userData">Welcome, {{ userData.user.username }}</p>
    <p v-else>Loading...</p>
  </div>
</template>
