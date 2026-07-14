<template>
  <div>
    <h2>{{ detail.name }}</h2>

    <a-tabs>
      <!-- INFO -->
      <a-tab-pane key="1" tab="Thông tin">
        <p>Mã lớp: {{ detail.class_code }}</p>
        <p>Mô tả: {{ detail.description }}</p>
      </a-tab-pane>

      <!-- COURSE -->
      <a-tab-pane key="2" tab="Course">
        <a-select
          style="width:300px"
          placeholder="Chọn course"
          @change="attachCourse"
        >
          <a-select-option
            v-for="c in courses"
            :key="c.id"
            :value="c.id"
          >
            {{ parseName(c.course_name) }}
          </a-select-option>
        </a-select>

        <ul>
          <li v-for="c in detail.courses" :key="c.id">
            {{ c.course_code }}
          </li>
        </ul>
      </a-tab-pane>

      <!-- SESSION -->
      <a-tab-pane key="3" tab="Session">
        <a-button @click="goSession">Quản lý buổi học</a-button>
      </a-tab-pane>
    </a-tabs>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const detail = ref({})
const courses = ref([])

const fetchDetail = async () => {
  const res = await fetch(`/api/teacher/classes/${route.params.id}`)
  const data = await res.json()
  detail.value = data.data
}

const fetchCourses = async () => {
  const res = await fetch('/api/teacher/course')
  const data = await res.json()
  courses.value = data.data
}

const attachCourse = async (courseId) => {
  const course = courses.value.find(c => c.id === courseId)

  await fetch(`/api/teacher/classes/${route.params.id}/courses`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      course_id: course.id,
      course_code: course.course_code
    })
  })

  fetchDetail()
}

const parseName = (str) => {
  return str.split('|')[1]?.split('/')[1] || ''
}

const goSession = () => {
  router.push(`/teacher/classes/${route.params.id}/sessions`)
}

onMounted(() => {
  fetchDetail()
  fetchCourses()
})
</script>
