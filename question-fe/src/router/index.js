import { createRouter, createWebHistory } from 'vue-router'

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
import LearningHistory from '../views/student/profile/LearningHistory.vue'

import TeacherLayout from '@/layouts/TeacherLayout.vue'

// Teacher Views
import TeacherDashboard from '@/views/teacher/dashboard/Dashboard.vue'
import CourseList from '@/views/teacher/course/CourseList.vue'
import CourseCreate from '@/views/teacher/course/CourseCreate.vue'
import StudentList from '@/views/teacher/student/StudentList.vue'

// Auth Views
import LoginPage from '../views/auth/LoginPage.vue'
import RegisterPage from '../views/auth/RegisterPage.vue'
import Register from '../views/auth/Register.vue'
import ForgotPassword from '../views/auth/ForgotPassword.vue'
import RegisterStudent from '../views/auth/RegisterStudent.vue'
import RegisterTeacher from '../views/auth/RegisterTeacher.vue'

const DefaultRoute = [
  {
    path: '/',
    redirect: '/auth/login',
  },
]

const AdminRoutes = [
  {
    path: '/admin',
    component: AdminLayout,
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
    ],
  },
]
const StudentRoute = [
  {
    path: '/student',
    component: UserLayout,
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
      { path: 'learning-history', name: 'learning-history', component: LearningHistory },
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
        component: RegisterStudent
      },
      {
        path: 'register-teacher',
        name: 'register-teacher',
        component: RegisterTeacher
      }
    ],
  },
]

export default createRouter({
  history: createWebHistory(),
  routes: [...DefaultRoute, ...AdminRoutes, ...StudentRoute, ...AuthRoutes,...TeacherRoutes],
})
