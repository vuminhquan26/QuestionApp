<template>
  <div class="teacher-dashboard">
    <h1>Teacher Dashboard</h1>

    <a-row :gutter="16">
      <a-col :span="8">
        <a-card>
          <h3>Tổng khóa học</h3>
          <p>{{ stats.courses }}</p>
        </a-card>
      </a-col>

      <a-col :span="8">
        <a-card>
          <h3>Học viên</h3>
          <p>{{ stats.students }}</p>
        </a-card>
      </a-col>

      <a-col :span="8">
        <a-card>
          <h3>Bài kiểm tra</h3>
          <p>{{ stats.exams }}</p>
        </a-card>
      </a-col>
    </a-row>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const stats = ref({
  courses: 0,
  students: 0,
  exams: 0
})

onMounted(() => {
  // fake data (sau này gọi API)
  stats.value = {
    courses: 5,
    students: 120,
    exams: 20
  }
})
</script>
