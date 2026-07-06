<template>
  <div class="course-list">

<!-- TITLE -->
<h1>Danh sách khóa học</h1>

<!-- FILTER -->
<div class="filter">
  <a-input-search
    placeholder="Tìm khóa học..."
    style="width: 300px"
  />


</div>

<!-- COURSE GRID -->
<a-row :gutter="[16,16]">
  <a-col v-for="course in courses" :key="course.id" :xs="24" :sm="12" :md="8" :lg="6">
    <a-card hoverable class="course-card">
      <template #cover>
        <img src="@/assets/vue.png" />
      </template>

      <a-card-meta :title="course.course_name">
        <template #description>
          {{ course.description }}
        </template>
      </a-card-meta>
    </a-card>
  </a-col>
</a-row>

<!-- PAGINATION -->
<!-- <div class="pagination">
  <a-pagination :total="50" :pageSize="8" />
</div> -->

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
const courses = ref([])
const fetchCourses = async () => {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/course')
    const result = await response.json()
    courses.value = result.data
  } catch (error) {
    console.error('Error fetch courses:', error)
  }
}
onMounted(() => {
  fetchCourses()
})
</script>

<style scoped>
.course-list {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.filter {
  display: flex;
  gap: 16px;
}

.course-card {
  border-radius: 8px;
}

.pagination {
  text-align: center;
}
</style>
