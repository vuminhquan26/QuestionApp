<template>
  <div class="home">
    <!-- HERO -->
    <section class="hero">
      <div class="hero-content">
        <h1>Học lập trình online</h1>
        <p>Hơn 100+ khóa học chất lượng</p>
      </div>
    </section>

    <!-- FEATURED -->
    <section>
      <h2>Khoá Học Nổi Bật </h2>
      <a-row :gutter="16">
        <a-col v-for="course in courses" :key="course.id" :span="6">
          <a-card hoverable>
            <template #cover>
              <img src="@/assets/laravel-featured.png" />
            </template>
            <a-card-meta :title="course.course_name">
              <template #description>
                {{ course.description }}
              </template>
            </a-card-meta>
          </a-card>
        </a-col>
      </a-row>
    </section>

    <!-- CATEGORY -->
    <section>
      <h2>Campus</h2>
      <a-row :gutter="16">
        <a-col :span="8">
          <a-card hoverable>
            <template #cover>
              <!-- <img src="@/assets/frontend.png" /> -->
            </template>
            <a-card-meta title="Frontend" description="Học lập trình Frontend" />
          </a-card>
        </a-col>
        <a-col :span="8">
          <a-card hoverable>
            <template #cover>
              <!-- <img src="@/assets/backend.png" /> -->
            </template>
            <a-card-meta title="Backend" description="Học lập trình Backend" />
          </a-card>
        </a-col>
        <a-col :span="8">
          <a-card hoverable>
            <template #cover>
              <!-- <img src="@/assets/mobile.png" /> -->
            </template>
            <a-card-meta title="Mobile" description="Học lập trình Mobile" />
          </a-card>
        </a-col>
      </a-row>
    </section>

    <!-- COURSE LIST -->
    <section>
      <h2>Môn Học Nổi Bật</h2>
      <a-row :gutter="16">
        <a-col v-for="subject in subjects" :key="subject.id" :span="6">
          <a-card hoverable>
            <template #cover>
              <img src="@/assets/monhoc.png" width="100%" height="100%"   />
            </template>
            <a-card-meta class="card-meta" :title="subject.name">
              <template #description>
                {{ subject.description }}
              </template>
            </a-card-meta>
          </a-card>
        </a-col>
      </a-row>
    </section>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'

const subjects = ref([])
const fetchSubjects = async () => {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/subject')
    const result = await response.json()

    subjects.value = result.data
  } catch (error) {
    console.error('Error fetch subjects:', error)
  }
}

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
  fetchSubjects()
  fetchCourses()
})
</script>
<style scoped>
.home {
  display: flex;
  flex-direction: column;
  gap: 40px;
}

.hero {
  padding: 60px 20px;
  background: #f0f2f5;
  border-radius: 8px;
  text-align: center;
}

.home {
  display: flex;
  flex-direction: column;
  gap: 40px;
}

/* HERO IMAGE */
.hero {
  height: 300px;
  background-image: url('@/assets/banner.png');
  background-size: cover;
  background-position: center;
  position: relative;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* overlay làm chữ dễ đọc */
.hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  border-radius: 8px;
}

/* text nằm trên ảnh */
.hero-content {
  position: relative;
  color: #fff;
  text-align: center;
}
.card-meta {
  font-size: 15px;
}
</style>
