<template>
  <div class="profile">

<!-- TITLE -->
<h1>Thông tin cá nhân</h1>

<a-row :gutter="24">

  <!-- LEFT: AVATAR -->
  <a-col :xs="24" :md="8">
    <a-card class="avatar-card">
      <div class="avatar-wrapper">
        <a-avatar :size="120" :src="user.avatar" />
        <a-button type="link">Đổi ảnh</a-button>
      </div>
    </a-card>
  </a-col>

  <!-- RIGHT: FORM -->
  <a-col :xs="24" :md="16">
    <a-card>
      <a-form layout="vertical">

        <a-form-item label="Họ tên">
          <a-input v-model:value="user.name" />
        </a-form-item>

        <a-form-item label="Email">
          <a-input v-model:value="user.email" disabled />
        </a-form-item>

        <a-form-item label="Số điện thoại">
          <a-input v-model:value="user.phone" />
        </a-form-item>

        <a-form-item label="Giới thiệu">
          <a-textarea v-model:value="user.bio" rows="4" />
        </a-form-item>

        <a-button type="primary" @click="updateProfile">
          Cập nhật
        </a-button>

      </a-form>
    </a-card>
  </a-col>

</a-row>

  </div>
</template>

<script setup>
import { ref } from 'vue'

// fake data
const user = ref({
  name: 'Nguyễn Văn A',
  email: 'user@gmail.com',
  phone: '0123456789',
  bio: 'Lập trình viên yêu thích Vue & Laravel',
  avatar: 'https://via.placeholder.com/120'
})

const updateProfile = () => {
  console.log('Updated:', user.value)
  // sau này call API
}
</script>

<style scoped>
.profile {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.avatar-card {
  text-align: center;
}

.avatar-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
}
</style>
