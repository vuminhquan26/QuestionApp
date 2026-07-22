<template>
  <div class="register-wrapper">
    <a-row justify="center" align="middle" style="height: 100%">
      <a-col :xs="22" :sm="18" :md="12" :lg="8">

        <a-card class="register-card" bordered>

          <!-- HEADER -->
          <div class="header">
            <img class="avatar" src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" />
            <h2>Teacher Register</h2>
            <p>Tạo tài khoản giảng viên</p>
          </div>

          <!-- FORM -->
          <a-form layout="vertical" :model="form" @finish="submitForm">

            <a-form-item label="Full Name" name="name" :rules="[{ required: true, message: 'Nhập tên' }]">
              <a-input v-model:value="form.name" placeholder="Nguyễn Văn B" />
            </a-form-item>

            <a-form-item label="Email" name="email"
              :rules="[{ required: true, message: 'Nhập email' }, { type: 'email' }]">
              <a-input v-model:value="form.email" placeholder="teacher@gmail.com" />
            </a-form-item>

            <a-form-item label="Password" name="password" :rules="[{ required: true }]">
              <a-input-password v-model:value="form.password" placeholder="••••••••" />
            </a-form-item>

            <a-form-item label="Phone">
              <a-input v-model:value="form.phone" placeholder="0123456789" />
            </a-form-item>

            <a-form-item label="Gender">
              <a-select v-model:value="form.gender" placeholder="Chọn giới tính">
                <a-select-option value="male">Male</a-select-option>
                <a-select-option value="female">Female</a-select-option>
              </a-select>
            </a-form-item>

            <a-form-item label="Birth Date">
              <a-date-picker v-model:value="form.birth_date" style="width: 100%" />
            </a-form-item>

            <a-button type="primary" html-type="submit" block size="large" class="btn-teacher">
              Đăng ký Teacher
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
import dayjs from 'dayjs'

const router = useRouter()

const form = ref({
  name: '',
  email: '',
  password: '',
  phone: '',
  gender: '',
  birth_date: null
})

const loading = ref(false)

const submitForm = async () => {
  loading.value = true

  const payload = {
    ...form.value,
    role: 'Teacher',
    birth_date: form.value.birth_date
      ? Number(dayjs(form.value.birth_date).format('YYYYMMDD'))
      : null
  }

  const res = await register(payload)

  loading.value = false

  if (res?.status) {
    message.success('Đăng ký Teacher thành công')

    // reset form
    form.value = {
      name: '',
      email: '',
      password: '',
      phone: '',
      gender: '',
      birth_date: null
    }

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
  background: linear-gradient(135deg, #e6fff3, #ffffff);
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
  color: #52c41a;
  cursor: pointer;
  margin-left: 5px;
}

.btn-teacher {
  background-color: #52c41a;
  border-color: #52c41a;
}

.btn-teacher:hover {
  background-color: #73d13d;
  border-color: #73d13d;
}
</style>
