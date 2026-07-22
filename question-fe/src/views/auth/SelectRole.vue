<template>
  <div class="h-screen flex flex-col items-center justify-center">
    <h2 class="mb-4 text-xl">Chọn vai trò</h2>

    <button @click="chooseRole('Student')">Student</button>
    <button @click="chooseRole('Teacher')">Teacher</button>
  </div>
</template>
<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const chooseRole = async (role) => {
  const token = localStorage.getItem('token')

  await fetch('http://localhost:8000/api/auth/social-login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Authorization: `Bearer ${token}`
    },
    body: JSON.stringify({ role })
  })

  if (role === 'student') router.push('/student')
  if (role === 'teacher') router.push('/teacher')
}
</script>
