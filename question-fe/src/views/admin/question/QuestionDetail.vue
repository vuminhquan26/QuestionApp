<template>
  <div class="container" v-if="question">
    <a-card class="question-card" title="📘 Chi tiết câu hỏi" bordered>
      <!-- TITLE -->
      <div class="section">
        <h2 class="title">{{ question.title }}</h2>
      </div>

      <!-- CONTENT -->
      <a-card class="sub-card" size="small">
        <p class="label">🧠 Nội dung câu hỏi</p>
        <p class="content">
          {{ question.question_data?.question_content }}
        </p>
      </a-card>

      <!-- INFO GRID -->
      <div class="grid">
        <div><b>📌 Loại câu hỏi:</b> {{ question.question_type_code }}</div>
        <div><b>🧾 Loại đáp án:</b> {{ question.answer_type_code }}</div>
        <div><b>🎯 Độ khó:</b> {{ question.difficulty }}</div>
        <div><b>⭐ Điểm:</b> {{ question.score }}</div>
      </div>

      <!-- ANSWERS -->
      <a-card class="sub-card" size="small">
        <p class="label">📌 Danh sách đáp án</p>

        <div class="answers">
          <div v-for="ans in question.answer_data?.answer_contents || []" :key="ans.answer_id" class="answer-item"
            :class="{ correct: isCorrect(ans.answer_id) }">
            <span class="key">{{ ans.answer_id }}</span>
            <span class="value">{{ ans.answer_content }}</span>

            <span v-if="isCorrect(ans.answer_id)" class="badge"> ✔ Đúng </span>
          </div>
        </div>
      </a-card>

      <!-- CORRECT ANSWER -->
      <div class="footer">
        <a-tag color="green">
          Đáp án đúng:
          {{ question.answer_data?.correct_answer?.[0]?.answer_id }}
        </a-tag>
      </div>
    </a-card>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'


const route = useRoute()

const question = ref(null)
const loading = ref(true)

const isCorrect = (id) => {
  const correctList = question.value?.answer_data?.correct_answer || []
  return correctList.some((c) => c.answer_id === id)
}

onMounted(async () => {
  try {
    const id = String(route.params.id)

    const res = await questionService.getDetail(id)

    question.value = res?.data ?? res
  } catch (err) {
    console.error('Load detail error:', err)
  } finally {
    loading.value = false
  }
})
</script>
<style scoped>
.container {
  padding: 20px;
}

.question-card {
  border-radius: 12px;
}

.title {
  margin: 0;
  font-size: 22px;
  font-weight: 600;
}

.section {
  margin-bottom: 16px;
}

.sub-card {
  margin-bottom: 12px;
  border-radius: 10px;
}

.label {
  font-weight: 600;
  margin-bottom: 6px;
}

.content {
  font-size: 15px;
  color: #333;
}

.grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  margin: 12px 0;
  font-size: 14px;
}

.answers {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.answer-item {
  display: flex;
  align-items: center;
  gap: 10px;

  padding: 10px 12px;
  border-radius: 8px;
  border: 1px solid #eee;

  transition: 0.2s;
}

.answer-item:hover {
  background: #fafafa;
}

.answer-item.correct {
  border: 1px solid #52c41a;
  background: #f6ffed;
}

.key {
  font-weight: bold;
  width: 25px;
}

.value {
  flex: 1;
}

.badge {
  color: #52c41a;
  font-weight: 600;
}

.footer {
  margin-top: 10px;
}
</style>
