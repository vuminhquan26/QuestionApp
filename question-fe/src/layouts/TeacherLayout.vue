<template>
  <a-layout style="min-height: 100vh">

    <!-- SIDEBAR -->
    <a-layout-sider collapsible v-model:collapsed="collapsed">
      <div class="logo">TEACHER</div>

      <a-menu theme="dark" mode="inline" :selectedKeys="[selectedKey]">
        <a-menu-item key="dashboard" @click="go('/teacher/dashboard')">
          Dashboard
        </a-menu-item>

        <a-menu-item key="courses" @click="go('/teacher/courses')">
          Courses
        </a-menu-item>

        <a-menu-item key="students" @click="go('/teacher/students')">
          Students
        </a-menu-item>
      </a-menu>
    </a-layout-sider>

    <!-- MAIN -->
    <a-layout>

      <!-- HEADER -->
      <a-layout-header class="header">
        <div class="right">
          <span class="username">Teacher</span>
          <a-button type="link" @click="logout">Logout</a-button>
        </div>
      </a-layout-header>

      <!-- CONTENT -->
      <a-layout-content class="content">
        <router-view />
      </a-layout-content>

    </a-layout>

  </a-layout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const collapsed = ref(false)
const router = useRouter()
const route = useRoute()

const go = (path) => {
  router.push(path)
}

// highlight menu theo route
const selectedKey = computed(() => {
  if (route.path.includes('dashboard')) return 'dashboard'
  if (route.path.includes('courses')) return 'courses'
  if (route.path.includes('students')) return 'students'
  return ''
})

const logout = () => {
  localStorage.removeItem('token')
  localStorage.removeItem('role')
  router.push('/auth/login')
}
</script>

<style scoped>
.logo {
  height: 32px;
  margin: 16px;
  color: #fff;
  text-align: center;
  font-weight: bold;
}

.header {
  background: #fff;
  padding: 0 20px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.right {
  display: flex;
  align-items: center;
  gap: 10px;
}

.username {
  font-weight: 500;
}

.content {
  margin: 20px;
  background: #fff;
  padding: 20px;
  min-height: 280px;
}
</style>
