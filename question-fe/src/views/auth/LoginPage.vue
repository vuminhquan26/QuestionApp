<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-[900px] bg-white rounded-2xl shadow-xl overflow-hidden flex">

      <!-- LEFT -->
      <div class="w-1/2 bg-blue-50 flex items-center justify-center p-8">
        <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" class="w-64" />
      </div>
      <!-- RIGHT -->
      <div class="w-1/2 p-10 flex flex-col justify-center">

        <div class="mb-6">
          <h2 class="text-2xl font-semibold text-gray-800">
            Welcome Back 👋
          </h2>
          <p class="text-gray-500 mt-1">
            Please login to your account
          </p>
        </div>

        <a-form :model="form" @finish="onFinish" layout="vertical">

          <a-form-item name="email" label="Email" :rules="[{ required: true, message: 'Please input email' }]">
            <a-input v-model:value="form.email" placeholder="Enter your email" size="large" />
          </a-form-item>

          <a-form-item name="password" label="Password" :rules="[{ required: true, message: 'Please input password' }]">
            <a-input-password v-model:value="form.password" placeholder="Enter your password" size="large" />
          </a-form-item>

          <div class="flex justify-between items-center mb-4">
            <router-link to="/auth/register" class="text-blue-500 hover:underline text-sm">
              Create account
            </router-link>
          </div>

          <a-button type="primary" html-type="submit" block size="large" class="h-11 rounded-lg">
            Login
          </a-button>
          <!-- Divider -->
          <div class="my-5 flex items-center">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="px-3 text-gray-400 text-sm">OR</span>
            <div class="flex-1 h-px bg-gray-200"></div>
          </div>

          <!-- Social login -->
          <div class="social-wrapper">

            <button class="social-btn" @click="loginGoogle">
              <img src="https://www.svgrepo.com/show/475656/google-color.svg" />
              <span>Continue with Google</span>
            </button>
            <button class="social-btn" @click="loginFacebook">
              <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" />
              <span>Continue with Facebook</span>
            </button>
          </div>
        </a-form>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { login } from '../../services/auth'

const router = useRouter()

const form = ref({
  email: '',
  password: ''
})

const loginGoogle = () => {
  window.location.href = 'http://localhost:8000/api/auth/social/google/redirect'
}

const loginFacebook = () => {
  window.location.href = 'http://localhost:8000/api/auth/social/facebook/redirect'
}

// xử lý login
const onFinish = async () => {
  try {
    const role = await login(form.value.email, form.value.password) // gọi service

    // redirect theo role
    switch (role) {
      case 'admin':
        router.push('/admin')
        break
      case 'teacher':
        router.push('/teacher')
        break
      case 'student':
        router.push('/student')
        break
      default:
        alert('Role không hợp lệ')
    }

  } catch (err) {
    alert(err.message) // hiển thị lỗi từ service
  }
}
</script>

<style scoped>
.login-wrapper {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f5f7fa;
}

.login-card {
  display: flex;
  width: 800px;
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.login-image {
  flex: 1;
  background: #e6f0ff;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-image img {
  width: 70%;
}

.login-form {
  flex: 1;
  padding: 40px;
}

.title {
  font-size: 24px;
  font-weight: 600;
}

.subtitle {
  color: #888;
  margin-bottom: 25px;
}

.register {
  margin-bottom: 10px;
}

.register-link {
  color: #0099ff;
  text-decoration: none;
}

.social-btn {
  width: 100%;
  height: 44px;
  border: 1px solid #d9d9d9;
  border-radius: 8px;
  background: #fff;
  margin-bottom: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;

  cursor: pointer;
  transition: all 0.2s ease;
}

.social-btn:hover {
  background: #f5f5f5;
}

.social-btn img {
  width: 20px;
  height: 20px;
  object-fit: contain;
}

.social-btn span {
  white-space: nowrap;
  /* tránh xuống dòng lỗi */
  font-size: 14px;
  color: #333;
}
</style>
