import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import './assets/main.css'
import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/reset.css'

const token = localStorage.getItem('token')

createApp(App).use(router).use(Antd).mount('#app')
