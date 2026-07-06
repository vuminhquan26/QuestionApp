<template>
  <div class="course-page">

    <!-- HEADER -->
    <div class="header">
      <h2>Danh sách khóa học</h2>
      <a-button type="primary" @click="goCreate">
        + Tạo khóa học
      </a-button>
    </div>

    <!-- TABLE -->
    <a-table
      :columns="columns"
      :data-source="courses"
      row-key="id"
      bordered
    />

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const courses = ref([])

const goCreate = () => {
  router.push('/teacher/courses/create')
}

const columns = [
  {
    title: 'Tên khóa học',
    dataIndex: 'name'
  },
  {
    title: 'Số học viên',
    dataIndex: 'students'
  },
  {
    title: 'Trạng thái',
    dataIndex: 'status',
    customRender: ({ text }) => {
      return text === 'active'
        ? '🟢 Hoạt động'
        : '🔴 Tạm dừng'
    }
  },
  {
    title: 'Hành động',
    key: 'action',
    customRender: ({ record }) => {
      return [
        <a onClick={() => edit(record.id)}>Sửa</a>,
        <span> | </span>,
        <a style="color:red" onClick={() => remove(record.id)}>Xóa</a>
      ]
    }
  }
]

const edit = (id) => {
  router.push(`/teacher/courses/edit/${id}`)
}

const remove = (id) => {
  console.log('delete', id)
}

onMounted(() => {
  courses.value = [
    { id: 1, name: 'Vue Basic', students: 50, status: 'active' },
    { id: 2, name: 'Laravel API', students: 70, status: 'inactive' }
  ]
})
</script>

<style scoped>
.course-page {
  padding: 10px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
</style>
