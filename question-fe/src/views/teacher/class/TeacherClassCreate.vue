<template>
  <div>
    <h2>Tạo lớp học</h2>

    <a-form :model="form" @finish="handleSubmit">
      <a-form-item label="Tên lớp" name="name" required>
        <a-input v-model:value="form.name" />
      </a-form-item>

      <a-form-item label="Mã lớp" name="class_code" required>
        <a-input v-model:value="form.class_code" />
      </a-form-item>

      <a-form-item label="Ngày bắt đầu">
        <a-date-picker v-model:value="form.start_date" />
      </a-form-item>

      <a-form-item label="Mô tả">
        <a-input v-model:value="form.description" />
      </a-form-item>

      <a-button type="primary" html-type="submit">Tạo</a-button>
    </a-form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = reactive({
  name: '',
  class_code: '',
  start_date: '',
  description: '',
  syllabus_id: 'DEFAULT'
})

const handleSubmit = async () => {
  try {
    const token = localStorage.getItem('token')

    if (!token) {
      throw new Error('Chưa đăng nhập')
    }

    const res = await fetch('http://127.0.0.1:8000/api/teacher/classes', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      body: JSON.stringify(form)
    })

    const data = await res.json()

    if (!res.ok) {
      throw new Error(data.message || 'Tạo lớp thất bại')
    }

    router.push('/teacher/classes')

  } catch (err) {
    console.error(err)
  }
}
</script>
