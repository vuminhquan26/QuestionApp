<template>
  <div class="student-page">

    <!-- HEADER -->
    <div class="header">
      <h2>Danh sách học viên</h2>

      <a-input v-model:value="keyword" placeholder="Tìm theo tên hoặc email..." style="width: 250px" allow-clear />
    </div>

    <!-- TABLE -->
    <a-table :columns="columns" :data-source="filteredStudents" row-key="id" bordered>
      <!-- ACTION -->
      <template #bodyCell="{ column, record }">
        <template v-if="column.key === 'action'">
          <a @click="view(record)">Xem</a>
          <span> | </span>
          <a style="color:red" @click="remove(record.id)">Xóa</a>
        </template>
      </template>
    </a-table>

  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { message, Modal } from 'ant-design-vue'



const students = ref([])
const keyword = ref('')
const loading = ref(false)

const columns = [
  {
    title: 'Tên',
    dataIndex: 'name'
  },
  {
    title: 'Email',
    dataIndex: 'email'
  },
  {
    title: 'Hành động',
    key: 'action'
  }
]

// filter FE
const filteredStudents = computed(() => {
  if (!keyword.value) return students.value

  return students.value.filter(s =>
    s.name?.toLowerCase().includes(keyword.value.toLowerCase()) ||
    s.email?.toLowerCase().includes(keyword.value.toLowerCase())
  )
})

// fetch
const fetchStudents = async () => {
  loading.value = true

  const res = await getStudents()

  loading.value = false

  if (res?.data) {
    students.value = res.data
  } else {
    message.error('Không tải được danh sách học viên')
  }
}

// view
const view = (record) => {
  message.info(`Xem ${record.name}`)
}

// delete
const remove = (id) => {
  Modal.confirm({
    title: 'Xác nhận xóa?',
    content: 'Bạn có chắc muốn xóa học viên này?',
    okText: 'Xóa',
    okType: 'danger',
    cancelText: 'Hủy',
    onOk: async () => {
      const res = await deleteStudent(id)

      if (res?.status) {
        message.success('Đã xóa học viên')
        fetchStudents()
      } else {
        message.error(res?.message || 'Xóa thất bại')
      }
    }
  })
}

onMounted(fetchStudents)
</script>


<style scoped>
.student-page {
  padding: 10px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
</style>
