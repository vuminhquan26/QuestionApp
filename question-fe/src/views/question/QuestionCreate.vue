<template>
  <div class="container">
    <h2>Create Question</h2>
    <AppLayout />
    <QuestionForm :action="action" :question="question" />
  </div>
</template>

<script setup>
import QuestionForm from '@/components/forms/QuestionForm.vue'

const action = 'create'
const question = null
</script>
