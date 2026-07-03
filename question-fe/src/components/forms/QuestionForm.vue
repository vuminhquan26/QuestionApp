<template>
  <a-form layout="vertical" :model="form" @finish="submitForm">
    <!-- TITLE -->
    <a-form-item
      label="Tiêu đề"
      name="title"
      :rules="[{ required: true, message: 'Nhập tiêu đề' }]"
    >
      <a-input v-model:value="form.title" />
    </a-form-item>

    <!-- QUESTION -->
    <a-form-item
      label="Nội dung câu hỏi"
      name="question_content"
      :rules="[{ required: true, message: 'Nhập câu hỏi' }]"
    >
      <a-textarea v-model:value="form.question_content" :rows="3" />
    </a-form-item>

    <!-- SUBJECT -->
    <a-form-item
      label="Môn học"
      name="subject_id"
      :rules="[{ required: true, message: 'Chọn môn' }]"
    >
      <a-select v-model:value="form.subject_id">
        <a-select-option v-for="s in subject" :key="s.id" :value="s.id">
          {{ s.name }}
        </a-select-option>
      </a-select>
    </a-form-item>

    <!-- QUESTION TYPE -->
    <a-form-item
      label="Loại câu hỏi"
      name="question_type_code"
      :rules="[{ required: true, message: 'Chọn loại câu hỏi' }]"
    >
      <a-select v-model:value="form.question_type_code">
        <a-select-option v-for="t in question_type" :key="t.code" :value="t.code">
          {{ t.description }}
        </a-select-option>
      </a-select>
    </a-form-item>

    <!-- ANSWER TYPE -->
    <a-form-item
      label="Loại đáp án"
      name="answer_type_code"
      :rules="[{ required: true, message: 'Chọn loại đáp án' }]"
    >
      <a-select v-model:value="form.answer_type_code">
        <a-select-option v-for="t in answer_type" :key="t.code" :value="t.code">
          {{ t.description }}
        </a-select-option>
      </a-select>
    </a-form-item>

    <!-- DIFFICULTY -->
    <a-form-item label="Độ khó" name="difficulty">
      <a-select v-model:value="form.difficulty">
        <a-select-option value="easy">Easy</a-select-option>
        <a-select-option value="medium">Medium</a-select-option>
        <a-select-option value="hard">Hard</a-select-option>
      </a-select>
    </a-form-item>

    <!-- SCORE -->
    <a-form-item label="Điểm" name="score">
      <a-input-number v-model:value="form.score" :min="1" />
    </a-form-item>

    <!-- ANSWERS -->
    <a-form-item label="Đáp án" required>
      <a-radio-group v-model:value="form.correct">
        <div v-for="key in ['A', 'B', 'C', 'D']" :key="key" class="answer-row">
          <span>{{ key }}.</span>
          <a-input v-model:value="form.answers[key]" />
          <a-radio :value="key" />
        </div>
      </a-radio-group>
    </a-form-item>

    <!-- SUBMIT -->
    <a-form-item>
      <a-button type="primary" html-type="submit"> Lưu </a-button>
    </a-form-item>
  </a-form>
</template>
<script setup>
import { ref, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { message } from 'ant-design-vue'
import { questionService } from '@/services/question_service'

const route = useRoute()
const router = useRouter()

const props = defineProps({
  action: String,
  data: Object,
})

const form = ref({
  title: '',
  question_content: '',
  subject_id: '',
  question_type_code: '',
  answer_type_code: '',
  difficulty: 'easy',
  score: 1,
  status: 1,
  version: 1,
  answers: {
    A: '',
    B: '',
    C: '',
    D: '',
  },
  correct: 'A',
})

// ===== OPTIONS =====
const subject = ref([])
const question_type = ref([])
const answer_type = ref([])

onMounted(async () => {
  // SUBJECT
  const resSubject = await fetch('http://127.0.0.1:8000/api/subject')
  const dataSubject = await resSubject.json()
  subject.value = dataSubject.data

  // QUESTION TYPE
  const resQuestionType = await fetch('http://127.0.0.1:8000/api/questiontype')
  const dataQuestionType = await resQuestionType.json()
  question_type.value = dataQuestionType.data

  // ANSWER TYPE
  const resAnswerType = await fetch('http://127.0.0.1:8000/api/answertype')
  const dataAnswerType = await resAnswerType.json()
  answer_type.value = dataAnswerType.data
})

// FILL DATA
watch(
  () => props.data,
  (val) => {
    if (!val) return

    form.value.title = val.title || ''
    form.value.question_content = val.question_data?.question_content || ''

    form.value.subject_id = val.subject_id || ''
    form.value.question_type_code = val.question_type_code || ''
    form.value.answer_type_code = val.answer_type_code || ''
    form.value.difficulty = val.difficulty || 'easy'
    form.value.score = Number(val.score) || 1

    const answers = val.answer_data?.answer_contents || []

    form.value.answers = { A: '', B: '', C: '', D: '' }

    answers.forEach((item: any, index: number) => {
      const key = ['A', 'B', 'C', 'D'][index]
      if (key) form.value.answers[key] = item.answer_content
    })

    if (val.answer_data?.correct_answer?.length) {
      const correct = val.answer_data.correct_answer[0]

      const index = answers.findIndex((a: any) => a.answer_id === correct.answer_id)

      if (index !== -1) {
        form.value.correct = ['A', 'B', 'C', 'D'][index]
      }
    }
  },
  { immediate: true },
)

// ===== SUBMIT =====
const submitForm = async () => {
  const payload = {
    title: form.value.title,
    question_type_code: form.value.question_type_code,
    answer_type_code: form.value.answer_type_code,
    subject_id: form.value.subject_id,
    difficulty: form.value.difficulty,
    score: form.value.score,
    status: form.value.status,
    version: form.value.version,

    question_data: {
      question_content: form.value.question_content,
    },

    answer_data: {
      answer_contents: ['A', 'B', 'C', 'D'].map((k) => ({
        answer_id: k,
        answer_content: form.value.answers[k],
      })),
      correct_answer: [
        {
          answer_id: form.value.correct,
          answer_content: form.value.answers[form.value.correct],
        },
      ],
      shuffle: true,
    },
  }

  let res

  if (props.action === 'edit') {
    res = await questionService.update(route.params.id as string, payload)
  } else {
    res = await questionService.create(payload)
  }

  if (res && (res.id || res.success || res.data)) {
    message.success('Lưu thành công')
    router.push('/list')
  } else {
    message.error('Lưu thất bại')
  }
}
</script>

<style scoped>
.answer-row {
  display: flex;
  gap: 10px;
  margin-bottom: 8px;
  align-items: center;
}
.answer-row span {
  width: 20px;
}
</style>
