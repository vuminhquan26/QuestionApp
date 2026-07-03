<template>
  <div class="container">
    <a-card title="Chỉnh sửa câu hỏi">
      <!-- Loading -->
      <div v-if="loading" class="loading">Đang tải dữ liệu...</div>

      <!-- Form -->
      <QuestionForm v-else action="edit" :data="question" />
    </a-card>
  </div>
</template>

<script setup >
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { questionService } from '@/services/question_service'
import QuestionForm from '@/components/forms/QuestionForm.vue'
const route = useRoute()

const question = ref(null)
const loading = ref(true)

onMounted(async () => {
  try {
    const id = route.params.id

    const res = await questionService.getDetail(id)

    question.value = res.data || res
  } catch (err) {
    console.error('Lỗi load detail:', err)
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
.container {
  padding: 20px;
}

.loading {
  text-align: center;
  padding: 20px;
  font-size: 16px;
}
</style>
