<template>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="login-image">
        <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" />
      </div>

      <div class="login-form">
        <h2 class="title">Welcome Back</h2>
        <p class="subtitle">Please login to your account</p>

        <a-form :model="form" @finish="onFinish">
          <a-form-item name="email" :rules="[{ required: true }]">
            <a-input v-model:value="form.email" placeholder="Email" />
          </a-form-item>

          <a-form-item name="password" :rules="[{ required: true }]">
            <a-input-password v-model:value="form.password" placeholder="Password" />
          </a-form-item>

          <div class="remember">
            <a-checkbox v-model:checked="form.remember">Remember me</a-checkbox>
          </div>
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

const router = useRouter()

const form = reactive({
  email: '',
  password: '',
  remember: true
})

const onFinish = async () => {
  try {
    const res = await fetch('http://127.0.0.1:8000/api/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        email: form.email,
        password: form.password
      })
    })

    const data = await res.json()

    if (data.status) {
      const role = data.data.role
      localStorage.setItem('token', data.token)
      localStorage.setItem('role', role)

      message.success('Login success')
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
    message.error('Server error')
  }
}
</script>
<style
  scoped>

  /* FULL SCREEN CENTER */
  .login-wrapper {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f5f7fa;
  }

  /* CARD */
  .login-card {
    display: flex;
    width: 800px;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }

  /* LEFT IMAGE */
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

  /* RIGHT FORM */
  .login-form {
    flex: 1;
    padding: 40px;
  }

  .title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 5px;
  }

  .subtitle {
    color: #888;
    margin-bottom: 25px;
  }

  .remember {
    margin-bottom: 15px;
  }
  .register-link {
  text-decoration: none;
  color: inherit;
  cursor: pointer;
  color: #0099ff;
}
</style>
