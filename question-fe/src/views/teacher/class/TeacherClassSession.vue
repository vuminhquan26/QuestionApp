<template>
  <div>
    <h2>Buổi học</h2>

    <a-button type="primary" @click="showForm = true">
      Thêm buổi
    </a-button>

    <a-list :data-source="sessions" bordered>
      <template #renderItem="{ item }">
        <a-list-item>
          Buổi {{ item.session }} - {{ item.name }} ({{ item.topic }})
        </a-list-item>
      </template>
    </a-list>

    <!-- FORM -->
    <a-modal v-model:open="showForm" title="Thêm buổi" @ok="createSession">
      <a-input v-model:value="form.name" placeholder="Tên buổi" />
      <a-input v-model:value="form.session" placeholder="Session" />
      <a-input v-model:value="form.topic" placeholder="Topic" />
    </a-modal>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

const sessions = ref([])
const showForm = ref(false)

const form = reactive({
  name: '',
  description: '',
  session: '',
  topic: ''
})

const fetchSessions = async () => {
  const res = await fetch(`/api/teacher/classes/${route.params.id}/sessions`)
  const data = await res.json()
  sessions.value = data.data
}

const createSession = async () => {
  await fetch(`/api/teacher/classes/${route.params.id}/sessions`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(form)
  })

  showForm.value = false
  fetchSessions()
}

onMounted(fetchSessions)
</script>
