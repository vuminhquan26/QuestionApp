import { createRouter, createWebHistory } from 'vue-router'

import AdminLayout from '@/layouts/AdminLayout.vue'
import UserLayout from '@/layouts/UserLayout.vue'

// Admin Views
import Dashboard from '../views/admin/question/dashboard/Dashboard.vue'
import QuestionList from '../views/admin/question/QuestionList.vue'
import QuestionCreate from '../views/admin/question/QuestionCreate.vue'
import QuestionEdit from '../views/admin/question/QuestionEdit.vue'
import QuestionDetail from '../views/admin/question/QuestionDetail.vue'

// User Views
import HomePage from '../views/user/home/HomePage.vue'
import CouseList from '../views/user/course/CourseListPage.vue'
import CourseDetail from '../views/user/course/CourseDetailPage.vue'
import LearningPage from '../views/user/learning/LearningPage.vue'
import LessonDetailPage from '../views/user/learning/LessonDetail.vue'
import QuizPage from '../views/user/learning/QuizPage.vue'
import ResultPage from '../views/user/learning/ResultPage.vue'
import CartPage from '../views/user/payment/CartPage.vue'
import CheckoutPage from '../views/user/payment/CheckoutPage.vue'
import OrderHistoryPage from '../views/user/payment/OrderHistory.vue'
import PaymentResult from '../views/user/payment/PaymentResult.vue'
import ProfilePage from '../views/user/profile/ProfilePage.vue'
import ChangePassword from '../views/user/profile/ChangePassword.vue'
import MyCourse from '../views/user/profile/MyCourses.vue'
import Setting from '../views/user/profile/Settings.vue'
import LearningHistory from '../views/user/profile/LearningHistory.vue'

const AdminRoutes = [
  {
    path: '/admin',
    component: AdminLayout,
    children: [
      // redirect mặc định → dashboard
      {
        path: '',
        redirect: '/admin/dashboard',
      },

      // ===== DASHBOARD =====
      {
        path: 'dashboard',
        name: 'admin.dashboard',
        component: Dashboard,
      },

      // ===== QUESTION =====
      {
        path: 'questions',
        name: 'admin.question.list',
        component: QuestionList,
      },
      {
        path: 'questions/create',
        name: 'admin.question.create',
        component: QuestionCreate,
      },
      {
        path: 'questions/edit/:id',
        name: 'admin.question.edit',
        component: QuestionEdit,
      },
      {
        path: 'questions/:id',
        name: 'admin.question.detail',
        component: QuestionDetail,
      },
    ],
  },
]

const UserRoutes = [
  {
    path: '/user',
    component: UserLayout,
    children: [
      // redirect mặc định
      { path: '/', redirect: '/user' },

      // ===== HOME =====
      { path: '', name: 'home', component: HomePage },

      // ===== COURSE =====
      { path: 'courses', name: 'course-list', component: CouseList },
      { path: 'courses/:id', name: 'course-detail', component: CourseDetail },

      // ===== LEARNING =====
      { path: 'learning/:courseId', name: 'learning', component: LearningPage },
      { path: 'lesson/:lessonId', name: 'lesson-detail', component: LessonDetailPage },

      // ===== QUIZ =====
      { path: 'quiz/:lessonId', name: 'quiz', component: QuizPage },
      { path: 'result', name: 'result', component: ResultPage },

      // ===== PAYMENT =====
      { path: 'cart', name: 'cart', component: CartPage },
      { path: 'checkout', name: 'checkout', component: CheckoutPage },
      { path: 'orders', name: 'orders', component: OrderHistoryPage },
      { path: 'payment-result', name: 'payment-result', component: PaymentResult },

      // ===== PROFILE =====
      { path: 'profile', name: 'profile', component: ProfilePage },
      { path: 'change-password', name: 'change-password', component: ChangePassword },
      { path: 'my-courses', name: 'my-courses', component: MyCourse },
      { path: 'settings', name: 'settings', component: Setting },
      { path: 'learning-history', name: 'learning-history', component: LearningHistory },
    ],
  },
]

export default createRouter({
  history: createWebHistory(),
  routes: [...AdminRoutes, ...UserRoutes],
})
