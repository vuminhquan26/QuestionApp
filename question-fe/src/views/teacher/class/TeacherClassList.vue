<template>
  <div>
    <a-row justify="space-between" style="margin-bottom:16px">
      <h2>Lớp học của tôi</h2>
      <a-button type="primary" @click="goCreate">Tạo lớp</a-button>
    </a-row>

    <a-table :columns="columns" :data-source="classes" row-key="id" />

  </div>
</template>

<script setup>
import { ref, onMounted, h } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const classes = ref([])
const loading = ref(false)

const columns = [
  { title: 'Tên lớp', dataIndex: 'name' },
  { title: 'Mã lớp', dataIndex: 'class_code' },
  { title: 'Bắt đầu', dataIndex: 'start_date' },
  {
    title: 'Action',
    key: 'action',
    customRender: ({ record }) => {
      return h(
        'a-button',
        {
          type: 'link',
          onClick: () => goDetail(record.id)
        },
        { default: () => 'Chi tiết' }
      )
    }
  }
]

const fetchData = async () => {
  try {
    loading.value = true

    const token = localStorage.getItem('token')

    const res = await fetch('http://127.0.0.1:8000/api/teacher/classes', {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json'
      }
    })

    const result = await res.json()

    console.log('classes API:', result)
    classes.value = result.data.data

  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}

const goCreate = () => router.push('/teacher/classes/create')
const goDetail = (id) => router.push(`/teacher/classes/${id}`)

onMounted(fetchData)
</script>
