<template>
  <div class="login-wrapper">
    <div class="login-card">

      <!-- LEFT -->
      <div class="login-image">
        <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" />
      </div>

      <!-- RIGHT -->
      <div class="login-form">
        <h2 class="title">Welcome Back</h2>
        <p class="subtitle">Please login to your account</p>
        <a-form :model="form" @finish="onFinish">

          <a-form-item
            name="email"
            :rules="[{ required: true, message: 'Please input email' }]"
          >
            <a-input v-model:value="form.email" placeholder="Email" />
          </a-form-item>

          <a-form-item
            name="password"
            :rules="[{ required: true, message: 'Please input password' }]"
          >
            <a-input-password
              v-model:value="form.password"
              placeholder="Password"
            />
          </a-form-item>

          <div class="register">
            <router-link to="/auth/register" class="register-link">
              Register
            </router-link>
          </div>

          <a-button type="primary" html-type="submit" block>
            Login
          </a-button>

        </a-form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { message } from 'ant-design-vue'
import { useRouter } from 'vue-router'
import api from '@/utils/axios'

const router = useRouter()
const form = reactive({
  email: '',
  password: ''
})

const onFinish = async () => {
  try {
    const res = await api.post('/auth/login', form)
    const data = res.data

    console.log('LOGIN RESPONSE:', data)

    if (data.status) {
      const token = data.access_token
      const role = data.data.role.toLowerCase()

      // lưu
      localStorage.setItem('token', token)
      localStorage.setItem('role', role)

      message.success('Login success')

      // redirect
      if (role === 'admin') {
        router.push('/admin')
      } else if (role === 'teacher') {
        router.push('/teacher')
      } else {
        router.push('/student')
      }

    } else {
      message.error(data.message)
    }

  } catch (e) {
    console.error(e)
    message.error('Server error')
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
</style>
