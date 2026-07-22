<template>
  <div class="role-wrapper">
    <a-typography-title level="2">
      Chọn loại tài khoản
    </a-typography-title>

    <a-row :gutter="24" justify="center" class="role-list">

      <!-- STUDENT -->
      <a-col :span="6">
        <a-card
          hoverable
          class="role-card"
          @click="go('student')"
        >
          <template #cover>
            <img
              src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png"
              alt="student"
            />
          </template>

          <a-card-meta title="Student">
            <template #description>
              Học viên tham gia khóa học
            </template>
          </a-card-meta>
        </a-card>
      </a-col>

      <!-- TEACHER -->
      <a-col :span="6">
        <a-card
          hoverable
          class="role-card"
          @click="go('teacher')"
        >
          <template #cover>
            <img
              src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png"
              alt="teacher"
            />
          </template>

          <a-card-meta title="Teacher">
            <template #description>
              Giảng viên tạo khóa học
            </template>
          </a-card-meta>
        </a-card>
      </a-col>

    </a-row>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const roles = [
  {
    key: 'student',
    title: 'Student',
    description: 'Học viên tham gia khóa học',
    image: 'https://cdn-icons-png.flaticon.com/512/3135/3135755.png',
    path: '/auth/register-student'
  },
  {
    key: 'teacher',
    title: 'Teacher',
    description: 'Giảng viên tạo khóa học',
    image: 'https://cdn-icons-png.flaticon.com/512/1995/1995574.png',
    path: '/auth/register-teacher'
  }
]

// điều hướng
const go = (role) => {
  const target = roles.find(r => r.key === role)

  if (target) {
    router.push(target.path)
  }
}
</script>

<style scoped>
.role-wrapper {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: #f5f7fa;
}

.role-list {
  margin-top: 40px;
}

.role-card {
  cursor: pointer;
  transition: all 0.3s;
  border-radius: 12px;
}

.role-card:hover {
  transform: translateY(-8px);
}
</style>
