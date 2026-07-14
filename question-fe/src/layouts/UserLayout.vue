<template>
  <a-layout class="layout">
    <a-layout-header>
      <div class="logo" />
      <a-menu mode="horizontal" theme="dark" :selectedKeys="[selectedKey]" @click="handleMenuClick">

        <a-menu-item key="/student">Home</a-menu-item>
        <a-menu-item key="/student/courses">Courses</a-menu-item>
        <a-menu-item key="/student/my-courses">My Courses</a-menu-item>
        <a-menu-item key="/student/cart">Cart</a-menu-item>
        <a-menu-item key="/student/profile">Profile</a-menu-item>
        <a-menu-item key="logout">
          <span @click="logout">Logout</span>
        </a-menu-item>
      </a-menu>

    </a-layout-header>
    <a-layout-content style="padding: 0 50px">

      <div :style="{ background: '#fff', padding: '24px', minHeight: '280px' }"><router-view /></div>
    </a-layout-content>
    <a-layout-footer class="footer">
      <a-row :gutter="16">
        <a-col :span="8">
          <h3>E-Learning</h3>
          <p>Nền tảng học lập trình online chất lượng cao.</p>
          <iframe width="80%" height="150" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3124.478288225113!2d105.87838451791902!3d20.989516742664566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aea74a0c0e4f%3A0x9b3699c84b07ad99!2zVHLGsOG7nW5nIFRIQ1MgVsSpbmggSMawbmc!5e1!3m2!1svi!2s!4v1783172691007!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </a-col>
        <!-- LINK -->
        <a-col :span="8">
          <h4>Liên kết</h4>
          <ul>
            <li>Môn Học</li>
            <li>Đề Thi</li>
            <li>Giới Thiệu</li>
          </ul>
        </a-col>
        <a-col :span="8">
          <h4>Liên hệ</h4>
          <p>Email: support@elearning.com</p>
          <p>Hotline: 0123 456 789</p>
        </a-col>
      </a-row>
      <a-divider />
      <div class="copyright">
        © 2026 E-Learning. All rights reserved.
      </div>
    </a-layout-footer>
  </a-layout>
</template>
<script setup>
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const selectedKey = ref(route.path);

const handleMenuClick = (e) => {
  if(e.key === 'logout') return

  router.push(e.key)
}

const logout = () => {
  localStorage.removeItem('token')
  localStorage.removeItem('role')
  router.push('/auth/login')
}
</script>
<style scoped>
.site-layout-content {
  min-height: 280px;
  padding: 24px;
  background: #fff;
}

#components-layout-demo-top .logo {
  float: left;
  width: 120px;
  height: 31px;
  margin: 16px 24px 16px 0;
  background: rgba(255, 255, 255, 0.3);
}

.ant-row-rtl #components-layout-demo-top .logo {
  float: right;
  margin: 16px 0 16px 24px;
}

[data-theme='dark'] .site-layout-content {
  background: #141414;
}

.footer {
  background: #001529;
  color: #fff;
  padding: 40px 50px;
}

.footer h3,
.footer h4 {
  color: #fff;
}

.footer ul {
  list-style: none;
  padding: 0;
}

.footer li {
  margin-bottom: 8px;
  cursor: pointer;
}

.footer li:hover {
  color: #1890ff;
}

.copyright {
  text-align: center;
  margin-top: 20px;
}

.layout {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

/* CONTENT GIÃN RA */
.ant-layout-content {
  flex: 1;
}

/* FOOTER */
.footer {
  background: #001529;
  color: #fff;
  padding: 40px;
}

</style>
