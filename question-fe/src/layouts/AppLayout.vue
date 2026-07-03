<template>
  <a-layout>
    <!-- HEADER -->
    <a-layout-header class="header">
      <div class="logo" />

      <a-menu v-model:selectedKeys="selectedKeys" theme="dark" mode="horizontal" @click="onClick">
        <a-menu-item key="/dashboard"> Dashboard </a-menu-item>
        <a-menu-item key="/list"> Danh sách Câu Hỏi </a-menu-item>
        <a-menu-item key="/create"> Tạo Câu Hỏi Mới </a-menu-item>
      </a-menu>
    </a-layout-header>

    <!-- BODY -->
    <a-layout>
      <!-- SIDEBAR -->
      <a-layout-sider width="200" style="background: #fff">
        <a-menu
          v-model:selectedKeys="selectedKeys2"
          v-model:openKeys="openKeys"
          mode="inline"
          style="height: 100%; border-right: 0"
        >
          <a-sub-menu key="sub1">
            <template #title>
              <span>
                <UserOutlined />
                Lọc Và Tìm kiếm
              </span>
            </template>

            <a-menu-item key="1">Lọc theo loại câu hỏi</a-menu-item>
            <a-menu-item key="2">Tìm kiếm câu hỏi</a-menu-item>
            <a-menu-item key="3">Câu hỏi mới nhất</a-menu-item>
            <a-menu-item key="4">Câu hỏi đã xoá</a-menu-item>
          </a-sub-menu>
        </a-menu>
      </a-layout-sider>

      <!-- CONTENT (QUAN TRỌNG) -->
      <a-layout style="padding: 0 24px 24px">
        <a-layout-content
          :style="{
            background: '#fff',
            padding: '24px',
            margin: 0,
            minHeight: '280px',
          }"
        >
          <!-- PAGE RENDER HERE -->
          <router-view />
        </a-layout-content>
      </a-layout>
    </a-layout>
  </a-layout>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { UserOutlined } from '@ant-design/icons-vue'

const router = useRouter()
const route = useRoute()

const selectedKeys = ref<string[]>([])

const selectedKeys2 = ref<string[]>(['1'])
const openKeys = ref<string[]>(['sub1'])

// click menu
const onClick = (e: any) => {
  router.push(e.key)
}

// sync menu theo route
watch(
  () => route.path,
  (path) => {
    selectedKeys.value = [path]
  },
  { immediate: true },
)
console.log('HEADER MOUNT')
</script>

<style scoped>
.logo {
  width: 120px;
  height: 31px;
  margin: 16px 24px 16px 0;
  float: left;
  background: rgba(255, 255, 255, 0.3);
}
</style>
