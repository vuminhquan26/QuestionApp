<template>
  <!-- Khung bảng -->
  <a-table
    :columns="columns"
    :data-source="questions"
    :pagination="pagination"
    @change="handleTableChange"
  >
    <template #bodyCell="{ column, record }">
      <template v-if="column.key === 'operation'">
        <a-button type="primary" @click="goDetail(record.id)">Xem</a-button>
        <a-button class="btn-warning" @click="goEdit(record.id)">Edit</a-button>
        <a-button type="primary" danger @click="handleDelete(record.id)">Xoá</a-button>
      </template>
    </template>
  </a-table>
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { questionService } from '@/services/question_service'

const router = useRouter()

const goDetail = (id: string) => {
  router.push(`/detail/${id}`)
}

const goEdit = (id: string) => {
  router.push(`/edit/${id}`)
}

const handleDelete = async (id: string) => {
  if (!confirm('Xoá thật không?')) return

  await questionService.remove(id)
  fetchQuestions()
}

const questions = ref<any[]>([])

const pagination = ref({
  current: 1,
  pageSize: 10,
  total: 0,
})

const columns = ref([
  {
    title: 'ID',
    dataIndex: 'id',
    key: 'id',
  },
  {
    title: 'Title',
    dataIndex: 'title',
    key: 'title',
  },
  {
    title: 'Question Type',
    dataIndex: 'question_type_code',
    key: 'question_type',
    width: 150,
  },
  {
    title: 'Answer Type',
    dataIndex: 'answer_type_code',
    key: 'answer_type',
    width: 150,
  },
  {
    title: 'Difficulty',
    dataIndex: 'difficulty',
    key: 'difficulty',
    width: 100,
  },
  {
    title: 'Score',
    dataIndex: 'score',
    key: 'score',
    width: 80,
  },
  {
    title: 'Created By',
    dataIndex: 'created_by',
    key: 'created_by',
    width: 150,
  },
  {
    title: 'Created At',
    dataIndex: 'created_at',
    key: 'created_at',
    customRender: ({ text }) => formatDate(text),
    width: 150,
  },
  {
    title: 'Action',
    key: 'operation',
  },
])

// FETCH DATA
const fetchQuestions = async (page = 1) => {
  try {
    const data = await questionService.getList(page)

    questions.value = data.data || []

    pagination.value.current = data.current_page
    pagination.value.total = data.total
    pagination.value.pageSize = data.per_page
  } catch (err) {
    console.log(err)
  }
}
// CHANGE PAGE
const handleTableChange = (pag: any) => {
  fetchQuestions(pag.current)
}
const formatDate = (dateStr: string) => {
  const date = new Date(dateStr)

  return date.toLocaleString('vi-VN', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
  })
}

// INIT
onMounted(() => {
  fetchQuestions(1)
})
</script>
<style scoped>
#components-table-demo-summary tfoot th,
#components-table-demo-summary tfoot td {
  background: #fafafa;
}
[data-theme='dark'] #components-table-demo-summary tfoot th,
[data-theme='dark'] #components-table-demo-summary tfoot td {
  background: #1d1d1d;
}

.btn-warning {
  background-color: #faad14;
  border-color: #faad14;
  color: #fff;
}

.btn-warning:hover {
  background-color: #d48806;
  border-color: #d48806;
}
.action-wrapper {
  display: flex;
  justify-content: center;
  gap: 8px;
}
</style>
