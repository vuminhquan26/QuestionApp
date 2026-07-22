<template>
  <div class="p-4">
    <a-card title="Danh sách lớp">

      <!-- SEARCH -->
      <div class="mb-4 flex gap-2">
        <a-input
          v-model:value="keyword"
          placeholder="Tìm kiếm lớp..."
          allow-clear
          @pressEnter="fetchClasses"
        />
        <a-button type="primary" @click="fetchClasses">
          Tìm kiếm
        </a-button>
      </div>

      <!-- TABLE -->
      <a-table
        :columns="columns"
        :data-source="classes"
        :loading="loading"
        row-key="id"
        :pagination="pagination"
        @change="handleTableChange"
      >
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'name'">
            {{ record.class.name }}
          </template>

          <template v-if="column.key === 'teacher'">
            {{ record.class.owner_user_id }}
          </template>

          <template v-if="column.key === 'action'">
            <a-button type="link" @click="goDetail(record.class.id)">
              Xem
            </a-button>
          </template>
        </template>
      </a-table>

    </a-card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const classes = ref([])
const loading = ref(false)
const keyword = ref('')
const pagination = ref({
  current: 1,
  pageSize: 10,
  total: 0
})

const columns = [
  {
    title: 'Tên lớp',
    key: 'name'
  },
  {
    title: 'Giáo viên',
    key: 'teacher'
  },
  {
    title: 'Hành động',
    key: 'action'
  }
]

const fetchClasses = async () => {
  loading.value = true
  try {
    const token = localStorage.getItem('token')

    const res = await fetch(
      `http://127.0.0.1:8000/api/student/classes?page=${pagination.value.current}&keyword=${keyword.value}`,
      {
        headers: {
          Authorization: `Bearer ${token}`
        }
      }
    )

    const data = await res.json()

    classes.value = data.data
    pagination.value.total = data.total
  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}

const handleTableChange = (pager) => {
  pagination.value.current = pager.current
  fetchClasses()
}

const goDetail = (id) => {
  window.location.href = `http://127.0.0.1:8000/student/classes/${id}`
}

onMounted(() => {
  fetchClasses()
})
</script>
