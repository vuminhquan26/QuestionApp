<template>
  <div class="cart">

```
<!-- TITLE -->
<h1>Giỏ hàng</h1>

<!-- EMPTY -->
<a-empty v-if="cart.length === 0" description="Giỏ hàng trống" />

<!-- CONTENT -->
<a-row v-else :gutter="24">

  <!-- LEFT: LIST -->
  <a-col :xs="24" :md="16">
    <a-card
      v-for="item in cart"
      :key="item.id"
      class="cart-item"
    >
      <a-row align="middle">

        <!-- IMAGE -->
        <a-col :span="6">
          <img :src="item.image" class="thumb" />
        </a-col>

        <!-- INFO -->
        <a-col :span="12">
          <h3>{{ item.title }}</h3>
          <p>{{ item.author }}</p>
        </a-col>

        <!-- PRICE -->
        <a-col :span="4">
          <strong>{{ item.price }}đ</strong>
        </a-col>

        <!-- REMOVE -->
        <a-col :span="2">
          <a-button type="link" danger @click="removeItem(item.id)">
            Xóa
          </a-button>
        </a-col>

      </a-row>
    </a-card>
  </a-col>

  <!-- RIGHT: SUMMARY -->
  <a-col :xs="24" :md="8">
    <a-card>
      <h3>Tổng thanh toán</h3>

      <p>Tổng khóa học: {{ cart.length }}</p>
      <p class="total">{{ totalPrice }}đ</p>

      <a-button type="primary" block size="large" @click="checkout">
        Thanh toán
      </a-button>
    </a-card>
  </a-col>

</a-row>
```

  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// fake data
const cart = ref([
  {
    id: 1,
    title: 'Vue 3 từ cơ bản đến nâng cao',
    author: 'Nguyễn Văn A',
    image: 'https://via.placeholder.com/120x80',
    price: 199000
  },
  {
    id: 2,
    title: 'Laravel API chuyên sâu',
    author: 'Trần Văn B',
    image: 'https://via.placeholder.com/120x80',
    price: 299000
  }
])

// total
const totalPrice = computed(() =>
  cart.value.reduce((sum, item) => sum + item.price, 0)
)

// remove item
const removeItem = (id) => {
  cart.value = cart.value.filter(item => item.id !== id)
}

// checkout
const checkout = () => {
  router.push('/user/checkout')
}
</script>

<style scoped>
.cart {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.cart-item {
  margin-bottom: 16px;
}

.thumb {
  width: 100%;
  border-radius: 6px;
}

.total {
  font-size: 20px;
  font-weight: bold;
  margin: 12px 0;
}
</style>
