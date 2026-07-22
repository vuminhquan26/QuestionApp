<template>
  <div class="register-wrapper">
    <a-row justify="center" align="middle" style="height: 100%">
      <a-col :xs="22" :sm="18" :md="12" :lg="8">

        <a-card class="register-card" bordered>

          <!-- HEADER -->
          <div class="header">
            <img class="avatar" src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" />
            <h2>Student Register</h2>
            <p>Tạo tài khoản học viên</p>
          </div>

          <!-- FORM -->
          <a-form layout="vertical" :model="form" @finish="submitForm">

            <a-form-item label="Full Name" name="name" :rules="[{ required: true, message: 'Nhập tên' }]">
              <a-input v-model:value="form.name" placeholder="Nguyễn Văn A" />
            </a-form-item>

            <a-form-item label="Email" name="email"
              :rules="[{ required: true, message: 'Nhập email' }, { type: 'email' }]">
              <a-input v-model:value="form.email" placeholder="example@gmail.com" />
            </a-form-item>

            <a-form-item label="Password" name="password" :rules="[{ required: true }]">
              <a-input-password v-model:value="form.password" placeholder="••••••••" />
            </a-form-item>

            <a-form-item label="School">
              <a-input v-model:value="form.school_name" placeholder="Tên trường" />
            </a-form-item>

            <a-form-item label="City">
              <a-input v-model:value="form.city" placeholder="TP.HCM" />
            </a-form-item>

            <a-form-item label="Area">
              <a-input v-model:value="form.area" placeholder="Quận 1" />
            </a-form-item>

            <a-button type="primary" html-type="submit" block size="large">
              Đăng ký Student
            </a-button>

          </a-form>

          <!-- FOOTER -->
          <div class="footer">
            Đã có tài khoản?
            <a @click="goLogin">Đăng nhập</a>
          </div>

        </a-card>

      </a-col>
    </a-row>
  </div>
</template>
<script setup>
import { ref } from 'vue'
import { message } from 'ant-design-vue'
import { useRouter } from 'vue-router'


const router = useRouter()

const form = ref({
  name: '',
  email: '',
  password: '',
  school_name: '',
  city: '',
  area: ''
})

const submitForm = async () => {
  const payload = {
    ...form.value,
    role: 'Student'
  }

  const res = await register(payload)

  if (res?.status) {
    message.success('Đăng ký thành công')
    router.push('/auth/login')
  } else {
    message.error(res?.message || 'Lỗi đăng ký')
  }
}

const goLogin = () => {
  router.push('/auth/login')
}
</script>

<style scoped>
.register-wrapper {
  height: 100vh;
  background: linear-gradient(135deg, #e6f0ff, #ffffff);
}

.register-card {
  border-radius: 16px;
  padding: 10px;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.header {
  text-align: center;
  margin-bottom: 20px;
}

.header h2 {
  margin-top: 10px;
  font-weight: 600;
}

.header p {
  color: #888;
}

.avatar {
  width: 70px;
}

.footer {
  margin-top: 20px;
  text-align: center;
  color: #666;
}

.footer a {
  color: #1677ff;
  cursor: pointer;
  margin-left: 5px;
}
</style>
