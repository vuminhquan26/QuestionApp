<template>
  <div class="min-h-screen bg-gray-100 p-6">

    <!-- TITLE -->
    <div class="mb-6">
      <h1 class="text-2xl font-semibold text-gray-800">
        Teacher Dashboard
      </h1>
      <p class="text-gray-500">
        Overview of your teaching activity
      </p>
    </div>

    <!-- STATS -->
    <a-row :gutter="[16, 16]">

      <!-- COURSES -->
      <a-col :xs="24" :md="8">
        <a-card class="rounded-xl shadow-sm hover:shadow-md transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500 text-sm">Courses</p>
              <h2 class="text-2xl font-bold text-gray-800">
                {{ stats.courses }}
              </h2>
            </div>
            <div class="text-blue-500 text-3xl">📘</div>
          </div>
        </a-card>
      </a-col>

      <!-- STUDENTS -->
      <a-col :xs="24" :md="8">
        <a-card class="rounded-xl shadow-sm hover:shadow-md transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500 text-sm">Students</p>
              <h2 class="text-2xl font-bold text-gray-800">
                {{ stats.students }}
              </h2>
            </div>
            <div class="text-green-500 text-3xl">👨‍🎓</div>
          </div>
        </a-card>
      </a-col>

      <!-- EXAMS -->
      <a-col :xs="24" :md="8">
        <a-card class="rounded-xl shadow-sm hover:shadow-md transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500 text-sm">Exams</p>
              <h2 class="text-2xl font-bold text-gray-800">
                {{ stats.exams }}
              </h2>
            </div>
            <div class="text-purple-500 text-3xl">📝</div>
          </div>
        </a-card>
      </a-col>

    </a-row>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getTeacherDashboard } from '@/services/dashboardService'

// state
const dashboard = ref(null)
const loading = ref(false)

const stats = ref({
  courses: 0,
  students: 0,
  exams: 0
})

// fetch data
const fetchDashboard = async () => {
  try {
    loading.value = true

    const res = await getTeacherDashboard()

    dashboard.value = res.data

    // map data
    stats.value = {
      courses: res.data?.courses ?? 0,
      students: res.data?.students ?? 0,
      exams: res.data?.exams ?? 0
    }

  } catch (err) {
    console.error('Dashboard error:', err)
  } finally {
    loading.value = false
  }
}

// lifecycle
onMounted(fetchDashboard)
</script>
