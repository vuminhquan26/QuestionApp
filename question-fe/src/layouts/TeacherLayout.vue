<template>
  <a-layout class="min-h-screen">

    <!-- SIDEBAR -->
    <a-layout-sider collapsible v-model:collapsed="collapsed" class="!bg-[#001529]">
      <div class="h-14 flex items-center justify-center text-white font-bold text-lg">
        🎓 {{ collapsed ? 'T' : 'Teacher' }}
      </div>

      <a-menu theme="dark" mode="inline" :selectedKeys="[selectedKey]">
        <a-menu-item key="/teacher/dashboard" @click="go('/teacher/dashboard')">
          📊 Dashboard
        </a-menu-item>

        <a-menu-item key="/teacher/classes" @click="go('/teacher/classes')">
          🏫 Classes
        </a-menu-item>

        <a-menu-item key="/teacher/courses" @click="go('/teacher/courses')">
          📘 Courses
        </a-menu-item>

        <a-menu-item key="/teacher/students" @click="go('/teacher/students')">
          👨‍🎓 Students
        </a-menu-item>
      </a-menu>
    </a-layout-sider>

    <!-- MAIN -->
    <a-layout>

      <!-- HEADER -->
      <a-layout-header class="bg-white px-6 flex justify-between items-center shadow-sm">

        <h2 class="font-semibold text-gray-700">
          {{ pageTitle }}
        </h2>

        <div class="flex items-center gap-4">
          <span class="text-gray-600">👤 Teacher</span>

          <a-button type="primary" danger @click="logout">
            Logout
          </a-button>
        </div>

      </a-layout-header>

      <!-- CONTENT -->
      <a-layout-content class="p-6 bg-gray-100">

        <div class="bg-white p-6 rounded-xl shadow-sm min-h-[300px]">
          <router-view />
        </div>

      </a-layout-content>

    </a-layout>

  </a-layout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
// title tự động theo route name
const pageTitle = computed(() => {
  return route.name || 'Dashboard'
})
const collapsed = ref(false)
const router = useRouter()
const route = useRoute()

// 🔹 Navigate
const go = (path) => {
  if (route.path !== path) {
    router.push(path)
  }
}

// 🔹 Highlight menu chuẩn (fix lỗi nested route)
const selectedKey = computed(() => {
  if (route.path.startsWith('/teacher/dashboard')) return '/teacher/dashboard'
  if (route.path.startsWith('/teacher/classes')) return '/teacher/classes'
  if (route.path.startsWith('/teacher/courses')) return '/teacher/courses'
  if (route.path.startsWith('/teacher/students')) return '/teacher/students'
  return ''
})

// 🔹 Logout chuẩn hơn
const logout = () => {
  localStorage.clear()
  router.replace('/auth/login')
}
</script>

<style scoped>
.logo {
  height: 32px;
  margin: 16px;
  color: #fff;
  text-align: center;
  font-weight: bold;
  font-size: 16px;
}

.header {
  background: #fff;
  padding: 0 20px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  border-bottom: 1px solid #f0f0f0;
}

.right {
  display: flex;
  align-items: center;
  gap: 12px;
}

.username {
  font-weight: 500;
}

.content {
  margin: 20px;
  background: #fff;
  padding: 20px;
  min-height: 280px;
  border-radius: 8px;
}
</style>
