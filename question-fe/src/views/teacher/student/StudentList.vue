<template>
  <div class="student-page">

    <!-- HEADER -->
    <div class="header">
      <h2>Danh sách học viên</h2>

      <a-input
        v-model:value="keyword"
        placeholder="Tìm theo tên hoặc email..."
        style="width: 250px"
        allow-clear
      />
    </div>

    <!-- TABLE -->
    <a-table
      :columns="columns"
      :data-source="filteredStudents"
      row-key="id"
      bordered
    >
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
import { message } from 'ant-design-vue'

const students = ref([])
const keyword = ref('')

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

// 🔍 filter search
const filteredStudents = computed(() => {
  if (!keyword.value) return students.value

  return students.value.filter(s =>
    s.name.toLowerCase().includes(keyword.value.toLowerCase()) ||
    s.email.toLowerCase().includes(keyword.value.toLowerCase())
  )
})

const view = (record) => {
  console.log('view', record)
  message.info(`Xem ${record.name}`)
}

const remove = (id) => {
  students.value = students.value.filter(s => s.id !== id)
  message.success('Đã xóa học viên')
}

onMounted(() => {
  students.value = [
    { id: 1, name: 'Nguyen Van A', email: 'a@gmail.com' },
    { id: 2, name: 'Tran Van B', email: 'b@gmail.com' },
    { id: 3, name: 'Le Van C', email: 'c@gmail.com' }
  ]
})
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
