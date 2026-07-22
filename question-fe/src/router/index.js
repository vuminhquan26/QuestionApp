import { createRouter, createWebHistory } from 'vue-router'

import { getToken } from '../services/storage'
import AdminLayout from '@/layouts/AdminLayout.vue'
import UserLayout from '@/layouts/UserLayout.vue'
import AuthLayout from '@/layouts/AuthLayout.vue'

// Admin Views
import Dashboard from '../views/admin/question/dashboard/Dashboard.vue'
import QuestionList from '../views/admin/question/QuestionList.vue'
import QuestionCreate from '../views/admin/question/QuestionCreate.vue'
import QuestionEdit from '../views/admin/question/QuestionEdit.vue'
import QuestionDetail from '../views/admin/question/QuestionDetail.vue'

// Student Views
import HomePage from '../views/student/home/HomePage.vue'
import CouseList from '../views/student/course/CourseListPage.vue'
import CourseDetail from '../views/student/course/CourseDetailPage.vue'
import LearningPage from '../views/student/learning/LearningPage.vue'
import LessonDetailPage from '../views/student/learning/LessonDetail.vue'
import QuizPage from '../views/student/learning/QuizPage.vue'
import ResultPage from '../views/student/learning/ResultPage.vue'
import CartPage from '../views/student/payment/CartPage.vue'
import CheckoutPage from '../views/student/payment/CheckoutPage.vue'
import OrderHistoryPage from '../views/student/payment/OrderHistory.vue'
import PaymentResult from '../views/student/payment/PaymentResult.vue'
import ProfilePage from '../views/student/profile/ProfilePage.vue'
import ChangePassword from '../views/student/profile/ChangePassword.vue'
import MyCourse from '../views/student/profile/MyCourses.vue'
import Setting from '../views/student/profile/Settings.vue'
import StudentClassList from '../views/student/class/StudentClassList.vue'
import ClassList from '../views/student/class/ClassList.vue'

import TeacherLayout from '@/layouts/TeacherLayout.vue'

// Teacher Views
import TeacherDashboard from '@/views/teacher/dashboard/Dashboard.vue'
import CourseList from '@/views/teacher/course/CourseList.vue'
import CourseCreate from '@/views/teacher/course/CourseCreate.vue'
import StudentList from '@/views/teacher/student/StudentList.vue'
import TeacherClassList from '@/views/teacher/class/TeacherClassList.vue'
import TeacherClassCreate from '@/views/teacher/class/TeacherClassCreate.vue'
import TeacherClassDetail from '@/views/teacher/class/TeacherClassDetail.vue'
import TeacherClassSession from '@/views/teacher/class/TeacherClassSession.vue'
// Auth Views
import LoginPage from '../views/auth/LoginPage.vue'
import RegisterPage from '../views/auth/RegisterPage.vue'
import Register from '../views/auth/Register.vue'
import ForgotPassword from '../views/auth/ForgotPassword.vue'
import RegisterStudent from '../views/auth/RegisterStudent.vue'
import RegisterTeacher from '../views/auth/RegisterTeacher.vue'
import SocialCallback from '../views/auth/SocialCallback.vue'
import SelectRole from '../views/auth/SelectRole.vue'
const DefaultRoute = [
  {
    path: '/',
    redirect: '/auth/login',
  },
]

const SocialRoutes = [
  {
    path: '/social-callback',
    name: 'SocialCallback',
    component: SocialCallback,
  },
  {
    path: '/select-role',
    name: 'SelectRole',
    component: SelectRole,
  },
]

const AdminRoutes = [
  {
    path: '/admin',
    component: AdminLayout,
    meta: { role: 'admin' },
    children: [
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
const TeacherRoutes = [
  {
    path: '/teacher',
    component: TeacherLayout,
    meta: { role: 'teacher' },
    children: [
      {
        path: '',
        redirect: '/teacher/dashboard',
      },

      // ===== DASHBOARD =====
      {
        path: 'dashboard',
        name: 'teacher.dashboard',
        component: TeacherDashboard,
      },

      // ===== COURSE =====
      {
        path: 'courses',
        name: 'teacher.course.list',
        component: CourseList,
      },
      {
        path: 'courses/create',
        name: 'teacher.course.create',
        component: CourseCreate,
      },

      // ===== STUDENT =====
      {
        path: 'students',
        name: 'teacher.student.list',
        component: StudentList,
      },

      {
        path: 'classes',
        component: () => import('@/views/teacher/class/TeacherClassList.vue'),
      },
      {
        path: 'classes/create',
        component: () => import('@/views/teacher/class/TeacherClassCreate.vue'),
      },
      {
        path: 'classes/:id/sessions',
        component: () => import('@/views/teacher/class/TeacherClassSession.vue'),
      },
      {
        path: 'classes/:id',
        component: () => import('@/views/teacher/class/TeacherClassDetail.vue'),
      },
    ],
  },
]
const StudentRoute = [
  {
    path: '/student',
    component: UserLayout,
    meta: { role: 'student' },
    children: [
      { path: '/', redirect: '/user' },
      { path: '', name: 'home', component: HomePage },
      { path: 'courses', name: 'course-list', component: CouseList },
      { path: 'courses/:id', name: 'course-detail', component: CourseDetail },
      { path: 'learning/:courseId', name: 'learning', component: LearningPage },
      { path: 'lesson/:lessonId', name: 'lesson-detail', component: LessonDetailPage },
      { path: 'quiz/:lessonId', name: 'quiz', component: QuizPage },
      { path: 'result', name: 'result', component: ResultPage },
      { path: 'cart', name: 'cart', component: CartPage },
      { path: 'checkout', name: 'checkout', component: CheckoutPage },
      { path: 'orders', name: 'orders', component: OrderHistoryPage },
      { path: 'payment-result', name: 'payment-result', component: PaymentResult },
      { path: 'profile', name: 'profile', component: ProfilePage },
      { path: 'change-password', name: 'change-password', component: ChangePassword },
      { path: 'my-courses', name: 'my-courses', component: MyCourse },
      { path: 'settings', name: 'settings', component: Setting },
      // { path: 'learning-history', name: 'learning-history', component: LearningHistory },
      { path: 'class', name: 'class', component: StudentClassList },
      { path: 'classlist', name: 'classlist', component: ClassList },
    ],
  },
]
const AuthRoutes = [
  {
    path: '/auth',
    component: AuthLayout,
    children: [
      {
        path: 'login',
        name: 'login',
        component: LoginPage,
      },
      {
        path: 'register',
        name: 'register',
        component: Register,
      },
      {
        path: 'register-student',
        name: 'register-student',
        component: RegisterStudent,
      },
      {
        path: 'register-teacher',
        name: 'register-teacher',
        component: RegisterTeacher,
      },
    ],
  },
]

const routes = [
  ...SocialRoutes,
  ...DefaultRoute,
  ...AuthRoutes,
  ...AdminRoutes,
  ...TeacherRoutes,
  ...StudentRoute,
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// kiểm tra trước khi vào route
router.beforeEach((to, from) => {
  const token = getToken() // lấy token

  if (to.meta.requiresAuth && !token) {
    return '/auth/login' // chưa login → về login
  }

  return true
})

export default router
