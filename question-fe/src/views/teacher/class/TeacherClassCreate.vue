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
import { message } from 'ant-design-vue'
import dayjs from 'dayjs'


const router = useRouter()

const form = reactive({
  name: '',
  class_code: '',
  start_date: null,
  description: '',
  syllabus_id: 'DEFAULT'
})

const loading = reactive({ value: false })

const handleSubmit = async () => {
  loading.value = true

  const payload = {
    ...form,
    start_date: form.start_date
      ? dayjs(form.start_date).format('YYYY-MM-DD')
      : null
  }

  const res = await createClass(payload)

  loading.value = false

  if (res?.status) {
    message.success('Tạo lớp thành công')
    router.push('/teacher/classes')
  } else {
    message.error(res?.message || 'Tạo lớp thất bại')
  }
}
</script>
