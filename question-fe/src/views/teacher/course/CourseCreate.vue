<template>
  <div>
    <h2>Tạo khóa học</h2>

    <a-form layout="vertical" @finish="submit">
      <a-form-item label="Tên khóa học" name="name" :rules="[{ required: true }]">
        <a-input v-model:value="form.name" />
      </a-form-item>

      <a-form-item label="Mô tả">
        <a-input-textarea v-model:value="form.description" />
      </a-form-item>

      <a-button type="primary" html-type="submit">Tạo</a-button>
    </a-form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { message } from 'ant-design-vue'

const form = ref({
  name: '',
  description: ''
})

const submit = () => {
  console.log(form.value)
  message.success('Tạo khóa học thành công')
}
</script>
