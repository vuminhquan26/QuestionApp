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
        <a-col v-for="campus in campus" :key="campus.id" :span="6">
          <a-card hoverable>
            <template #cover>
              <img src="@/assets/campus.png" width="100%" height="100%" />
            </template>
            <a-card-meta :title="campus.campus_desc">
              <template #description>
                {{ campus.description }}
              </template>
            </a-card-meta>
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
              <img src="@/assets/monhoc.png" width="100%" height="100%" />
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
import { message } from 'ant-design-vue'


import banner from '@/assets/banner.png'
import courseImg from '@/assets/laravel-featured.png'
import campusImg from '@/assets/campus.png'
import subjectImg from '@/assets/monhoc.png'

// state
const subjects = ref([])
const courses = ref([])
const campus = ref([])
const loading = ref(false)

const fetchData = async () => {
  loading.value = true

  const [courseRes, subjectRes, campusRes] = await Promise.all([
    getCourses(),
    getSubjects(),
    getCampuses()
  ])

  loading.value = false

  if (courseRes?.data) courses.value = courseRes.data
  else message.error('Lỗi load courses')

  if (subjectRes?.data) subjects.value = subjectRes.data
  else message.error('Lỗi load subjects')

  if (campusRes?.data) campus.value = campusRes.data
  else message.error('Lỗi load campus')
}

onMounted(() => {
  fetchData()
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
