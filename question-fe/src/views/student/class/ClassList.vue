<template>
  <div class="p-4">
    <a-card title="Tất cả lớp">

      <!-- SEARCH -->
      <div class="mb-4 flex gap-2">
        <a-input
          v-model:value="keyword"
          placeholder="Tìm kiếm lớp..."
          allow-clear
          @pressEnter="onSearch"
        />
        <a-button type="primary" @click="onSearch">
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
          <!-- Mã lớp -->
          <template v-if="column.key === 'class_code'">
            {{ record.class_code }}
          </template>

          <!-- Tên lớp -->
          <template v-if="column.key === 'name'">
            {{ record.name }}
          </template>

          <!-- Giáo viên -->
          <template v-if="column.key === 'teacher'">
            {{ record.owner_user_id }}
          </template>

          <!-- Số học sinh -->
          <template v-if="column.key === 'students'">
            {{ record.total_students || 0 }}
          </template>

          <!-- Action -->
          <template v-if="column.key === 'action'">
            <a-button type="primary" @click="joinClass(record.class_code)">
              Tham gia
            </a-button>
          </template>

        </template>
      </a-table>

    </a-card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

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
    title: 'Mã Lớp',
    key: 'class_code'
  },
  {
    title: 'Tên lớp',
    key: 'name'
  },
  {
    title: 'Giáo viên',
    key: 'teacher'
  },
  {
    title: 'Số học sinh',
    key: 'students'
  },
  {
    title: 'Hành động',
    key: 'action'
  }
]

/**
 * Gọi API lấy toàn bộ class
 */
const fetchClasses = async () => {
  loading.value = true
  try {
    const token = localStorage.getItem('token')

  const res = await fetch(
    `http://127.0.0.1:8000/api/student/classes/all?page=${pagination.value.current}&keyword=${keyword.value}`,
    {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json'
      }
    }
  )

    if (!res.ok) {
      const text = await res.text()
      console.error('API ERROR:', text)
      return
    }

    const data = await res.json()

    classes.value = data.data
    pagination.value.total = data.total

  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}
const joinClass = async (code) => {
  try {
    const token = localStorage.getItem('token')

    const res = await fetch(
      `http://127.0.0.1:8000/api/student/classes/join`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`
        },
        body: JSON.stringify({
          code: code
        })
      }
    )

    if (!res.ok) {
      const text = await res.text()
      console.error('JOIN ERROR:', text)
      alert('Tham gia thất bại')
      return
    }

    const data = await res.json()

    alert('Tham gia thành công ')

    // reload lại list nếu cần
    fetchClasses()

  } catch (err) {
    console.error(err)
  }
}
/**
 * Search
 */
const onSearch = () => {
  pagination.value.current = 1
  fetchClasses()
}

/**
 * Pagination change
 */
const handleTableChange = (pager) => {
  pagination.value.current = pager.current
  fetchClasses()
}

/**
 * Navigate detail
 */
const goDetail = (id) => {
  router.push(`/student/classes/${id}`)
}

onMounted(() => {
  fetchClasses()
})
</script>
