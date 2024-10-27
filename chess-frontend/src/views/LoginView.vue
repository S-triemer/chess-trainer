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
  <div class="flex items-center justify-center min-h-screen bg-slate-950">
    <div class="w-full max-w-md p-8 space-y-6 bg-slate-800 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center text-white">Login</h2>
      <form @submit.prevent="login" class="space-y-4">
        <div>
          <label for="username" class="block text-sm font-medium text-gray-300">Username</label>
          <input
            id="username"
            v-model="username"
            placeholder="Enter your username"
            required
            class="w-full px-4 py-2 mt-1 border border-gray-600 bg-gray-700 text-gray-100 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          />
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
          <input
            id="password"
            v-model="password"
            type="password"
            placeholder="Enter your password"
            required
            class="w-full px-4 py-2 mt-1 border border-gray-600 bg-gray-700 text-gray-100 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          />
        </div>
        <button
          type="submit"
          class="w-full px-4 py-2 font-semibold text-white bg-indigo-700 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Login
        </button>
        <div class="text-indigo-400 text-center underline">Not registered yet?</div>
      </form>
    </div>
  </div>
</template>
