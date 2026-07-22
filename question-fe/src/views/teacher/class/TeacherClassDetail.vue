<template>
  <div class="wrapper">
    <div class="page-header">
      <div class="page-title">{{ detail.name }}</div>
      <div class="page-sub">Chi tiết lớp học</div>
    </div>

    <div class="card">
      <a-tabs>

        <a-tab-pane key="1" tab="Thông tin">
          <p class="info-item"><span>Mã lớp:</span> {{ detail.class_code }}</p>
          <p class="info-item"><span>Mô tả:</span> {{ detail.description }}</p>
        </a-tab-pane>

        <a-tab-pane key="2" tab="Sinh viên">
          <a-table :dataSource="students" :columns="columns" :pagination="pagination" rowKey="id" bordered
            @change="handleTableChange" />
        </a-tab-pane>

      </a-tabs>
    </div>
  </div>
</template>
<style scoped>
.wrapper {
  padding: 25px;
  background: #f5f7fa;
  min-height: 100vh;
}

/* HEADER */
.page-header {
  margin-bottom: 20px;
}

.page-title {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 5px;
}

.page-sub {
  color: #888;
  font-size: 13px;
}

/* CARD */
.card {
  background: #fff;
  border-radius: 16px;
  padding: 20px;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
  margin-bottom: 20px;
}

/* INFO TEXT */
.info-item {
  margin-bottom: 10px;
  font-size: 14px;
}

.info-item span {
  font-weight: 600;
}

/* TABS */
:deep(.ant-tabs-nav) {
  margin-bottom: 20px;
}

:deep(.ant-tabs-tab) {
  font-weight: 500;
}

:deep(.ant-tabs-tab-active) {
  color: #1677ff !important;
}

/* TABLE */
:deep(.ant-table) {
  border-radius: 12px;
  overflow: hidden;
}

:deep(.ant-table-thead > tr > th) {
  background: #fafafa;
  font-weight: 600;
}

:deep(.ant-table-tbody > tr:hover > td) {
  background: #e6f4ff;
}

/* BUTTON (nếu sau này dùng) */
.btn {
  margin-top: 10px;
}
</style>
<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const detail = ref({})
const students = ref([])

const token = localStorage.getItem('token')

// pagination
const pagination = ref({
  current: 1,
  pageSize: 20,
  total: 0
})

// columns
const columns = [
  { title: 'ID', dataIndex: 'id' },
  { title: 'Tên', dataIndex: 'name' },
  { title: 'Email', dataIndex: 'email' }
]

// handle đổi page
const handleTableChange = (pag) => {
  pagination.value.current = pag.current
  fetchStudents()
}

// API chi tiết lớp
const fetchDetail = async () => {
  const res = await fetch(
    `http://127.0.0.1:8000/api/teacher/classes/${route.params.id}`,
    {
      headers: { Authorization: `Bearer ${token}` }
    }
  )
  const data = await res.json()
  detail.value = data.data
}
// API students
const fetchStudents = async () => {
  const res = await fetch(
    `http://127.0.0.1:8000/api/teacher/classes/${route.params.id}/students?page=${pagination.value.current}`,
    {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json'
      }
    }
  )

  const result = await res.json()

  console.log('students API:', result)


  students.value = result.data.data
  pagination.value.total = result.data.total
  pagination.value.current = result.data.current_page
}
// chuyển trang
const goSession = () => {
  router.push(`/teacher/classes/${route.params.id}/sessions`)
}

// mount
onMounted(async () => {
  await fetchDetail()
  await fetchStudents()
})
</script>
