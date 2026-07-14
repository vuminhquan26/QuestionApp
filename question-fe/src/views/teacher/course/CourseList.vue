<template>
  <div>
    <h2>Danh sách khóa học</h2>

    <!-- SEARCH -->
    <a-input
      v-model:value="search"
      placeholder="Tìm kiếm khóa học..."
      style="width: 300px; margin-bottom: 16px"
      @pressEnter="fetchCourses"
    />

    <!-- TABLE -->
    <a-table
      :columns="columns"
      :data-source="courses"
      row-key="id"
      :pagination="{ pageSize: 10 }"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const courses = ref([])
const search = ref('')

const columns = [
  {
    title: 'Mã khóa học',
    dataIndex: 'course_code',
  },
  {
    title: 'Tên khóa học',
    customRender: ({ record }) => {
      return record.course_name.split('|')[1]?.split('/')[1] || ''
    }
  },
  {
    title: 'Loại',
    dataIndex: 'course_type'
  },
  {
    title: 'Thời lượng',
    customRender: ({ record }) => {
      return record.course_duration + ' ' + record.course_duration_unit
    }
  },
  {
    title: 'Ngôn ngữ',
    dataIndex: 'course_language'
  }
]

const fetchCourses = async () => {
  const res = await fetch(
    `http://127.0.0.1:8000/api/teacher/course?search=${search.value}`
  )
  const data = await res.json()
  courses.value = data.data
}

onMounted(fetchCourses)
</script>
