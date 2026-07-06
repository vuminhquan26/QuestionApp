<template>
  <div class="register-wrapper">
    <div class="register-card">
      <h2 class="title">Register Account</h2>

      <a-form layout="vertical" :model="form" @finish="submitForm">
        <a-form-item label="Full Name" name="name" :rules="[{ required: true }]">
          <a-input v-model:value="form.name" />
        </a-form-item>

        <a-form-item label="Email" name="email" :rules="[{ required: true }, { type: 'email' }]">
          <a-input v-model:value="form.email" />
        </a-form-item>

        <a-form-item label="Password" name="password" :rules="[{ required: true }]">
          <a-input-password v-model:value="form.password" />
        </a-form-item>

        <a-form-item label="Phone">
          <a-input v-model:value="form.phone" />
        </a-form-item>

        <a-form-item label="Gender">
          <a-select v-model:value="form.gender">
            <a-select-option value="male">Male</a-select-option>
            <a-select-option value="female">Female</a-select-option>
          </a-select>
        </a-form-item>

        <a-form-item label="Birth Date">
          <a-date-picker v-model:value="form.birth_date" style="width: 100%" />
        </a-form-item>

        <a-form-item label="School">
          <a-input v-model:value="form.school_name" />
        </a-form-item>

        <a-form-item label="City">
          <a-input v-model:value="form.city" />
        </a-form-item>

        <a-form-item label="Area">
          <a-input v-model:value="form.area" />
        </a-form-item>

        <a-form-item label="Avatar">
          <a-input v-model:value="form.avatar" />
        </a-form-item>

        <a-form-item>
          <a-button type="primary" html-type="submit" block>
            Register
          </a-button>
        </a-form-item>
      </a-form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { message } from 'ant-design-vue'
import dayjs from 'dayjs'

const form = ref({
  name: '',
  email: '',
  password: '',
  phone: '',
  gender: '',
  birth_date: null,
  school_name: '',
  city: '',
  area: '',
  avatar: ''
})

const submitForm = async () => {
  try {
    const payload = {
      ...form.value,
      birth_date: form.value.birth_date
        ? Number(dayjs(form.value.birth_date).format('YYYYMMDD'))
        : null
    }

    const res = await fetch('http://127.0.0.1:8000/api/register', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    })

    const data = await res.json()

    if (res.ok) {
      message.success('Register success')
    } else {
      message.error(data.message || 'Register failed')
    }
  } catch (e) {
    message.error('Server error')
  }
}
</script>

<style scoped>
.register-wrapper {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f5f7fa;
}

.register-card {
  width: 500px;
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.title {
  text-align: center;
  margin-bottom: 20px;
}
</style>
