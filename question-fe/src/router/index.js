import { createRouter, createWebHistory } from 'vue-router'

import AppLayout from '@/layouts/AppLayout.vue'

import Dashboard from '../views/dashboard/Dashboard.vue'
import QuestionList from '../views/question/QuestionList.vue'
import QuestionCreate from '../views/question/QuestionCreate.vue'
import QuestionEdit from '../views/question/QuestionEdit.vue'
import QuestionDetail from '../views/question/QuestionDetail.vue'

const routes = [
  {
    path: '/',
    component: AppLayout,
    children: [
      { path: '', redirect: '/list' },
      { path: 'list', component: QuestionList },
      { path: 'dashboard', component: Dashboard },
      { path: 'create', component: QuestionCreate },
      {
        path: 'edit/:id',
        component: QuestionEdit,
        name: 'question.edit',
      },
      {
        path: 'detail/:id',
        component: QuestionDetail,
        name: 'question.detail',
      },
    ],
  },
]

export default createRouter({
  history: createWebHistory(),
  routes,
})
