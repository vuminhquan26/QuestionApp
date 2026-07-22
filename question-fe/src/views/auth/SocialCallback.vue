<script setup>
import { onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

onMounted(() => {
  const token = route.query.token

  if (!token) {
    router.push('/auth/login')
    return
  }

  localStorage.setItem('token', token)

  router.push('/select-role')
})
</script>

<template>
  <div class="flex items-center justify-center h-screen">
    <p>Logging in...</p>
  </div>
</template>
