<template>
  <div class="container">
    <h2>Create Question</h2>
    <AppLayout />
    <QuestionForm :action="action" :question="question" />
  </div>
</template>

<script setup>
import QuestionForm from '@/components/forms/QuestionForm.vue'
import { ref } from 'vue'

const action = ref('create')
const question = ref({ id: 1, title: 'abc' })
</script>
