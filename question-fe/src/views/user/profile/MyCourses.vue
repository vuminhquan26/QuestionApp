<template>
  <div class="my-courses">

<!-- TITLE -->
<h1>Khóa học của tôi</h1>

<!-- EMPTY (nếu chưa có khóa học) -->
<a-empty v-if="courses.length === 0" description="Bạn chưa có khóa học nào" />

<!-- COURSE LIST -->
<a-row v-else :gutter="[16,16]">
  <a-col v-for="course in courses" :key="course.id" :xs="24" :sm="12" :md="8" :lg="6">
    <a-card hoverable class="course-card">

      <!-- IMAGE -->
      <template #cover>
        <img :src="course.image" />
      </template>

      <!-- INFO -->
      <a-card-meta :title="course.title">
        <template #description>
          <p>{{ course.author }}</p>
        </template>
      </a-card-meta>

      <!-- PROGRESS -->
      <div class="progress">
        <a-progress :percent="course.progress" size="small" />
      </div>

      <!-- ACTION -->
      <a-button type="primary" block @click="goToLearning(course.id)">
        Tiếp tục học
      </a-button>

    </a-card>
  </a-col>
</a-row>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// fake data (sau này replace API)
const courses = ref([
  {
    id: 1,
    title: 'Vue 3 từ cơ bản đến nâng cao',
    author: 'Nguyễn Văn A',
    image: '@/assets/vue.png',
    progress: 30
  },
  {
    id: 2,
    title: 'Laravel API chuyên sâu',
    author: 'Trần Văn B',
    image: '@/assets/laravel-featured.png',
    progress: 70
  }
])

const goToLearning = (id) => {
  router.push(`/user/learning/${id}`)
}
</script>

<style scoped>
.my-courses {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.course-card {
  border-radius: 8px;
}

.progress {
  margin: 12px 0;
}
</style>
