<template>
  <div>
    <h2>Danh sách khóa học</h2>

    <!-- SEARCH -->
    <a-input v-model:value="search" placeholder="Tìm kiếm khóa học..." style="width: 300px; margin-bottom: 16px"
      @pressEnter="fetchCourses" />

    <!-- TABLE -->
    <a-table :columns="columns" :data-source="courses" row-key="id" :pagination="{ pageSize: 10 }" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { message } from 'ant-design-vue'



const courses = ref([])
const search = ref('')
const loading = ref(false)

const columns = [
  {
    title: 'Mã khóa học',
    dataIndex: 'course_code'
  },
  {
    title: 'Tên khóa học',
    customRender: ({ record }) => {
      return record.course_name?.split('|')[1]?.split('/')[1] || ''
    }
  },
  {
    title: 'Loại',
    dataIndex: 'course_type'
  },
  {
    title: 'Thời lượng',
    customRender: ({ record }) => {
      return `${record.course_duration} ${record.course_duration_unit}`
    }
  },
  {
    title: 'Ngôn ngữ',
    dataIndex: 'course_language'
  }
]

// fetch
const fetchCourses = async () => {
  loading.value = true

  const res = await getTeacherCourses({
    search: search.value
  })

  loading.value = false

  if (res?.data) {
    courses.value = res.data
  } else {
    message.error('Không tải được danh sách khóa học')
  }
}

onMounted(fetchCourses)
</script>
