<template>
  <div class="home">
    <!-- HERO -->
    <section class="hero">
      <div class="hero-content">
        <h1>Học lập trình online</h1>
        <p>Hơn 100+ khóa học chất lượng</p>
      </div>
    </section>

    <!-- FEATURED -->
    <section>
      <h2>Khóa học nổi bật</h2>
      <a-row :gutter="16">
        <a-col v-for="i in 4" :key="i" :span="6">
          <a-card hoverable>
            <template #cover>
              <img src="@/assets/laravel-featured.png" />
            </template>
            <a-card-meta title="Laravel API">
              <template #description>
                Backend - 150k
              </template>
            </a-card-meta>
          </a-card>
        </a-col>
      </a-row>
    </section>

    <!-- CATEGORY -->
    <section>
      <h2>Danh mục</h2>
      <a-tag color="blue">Frontend</a-tag>
      <a-tag color="green">Backend</a-tag>
      <a-tag color="orange">Mobile</a-tag>
    </section>

    <!-- COURSE LIST -->
    <section>
      <h2>Tất cả khóa học</h2>
      <a-row :gutter="16">
        <a-col v-for="i in 8" :key="i" :span="6">
          <a-card hoverable>
            <template #cover>
              <img src="@/assets/laravel-featured.png" />
            </template>
            <a-card-meta title="Laravel API">
              <template #description>
                Backend - 150k
              </template>
            </a-card-meta>
          </a-card>
        </a-col>
      </a-row>
    </section>
  </div>
</template>
<style scoped>
.home {
  display: flex;
  flex-direction: column;
  gap: 40px;
}

.hero {
  padding: 60px 20px;
  background: #f0f2f5;
  border-radius: 8px;
  text-align: center;
}

.home {
  display: flex;
  flex-direction: column;
  gap: 40px;
}

/* HERO IMAGE */
.hero {
  height: 300px;
  background-image: url('@/assets/banner.png');
  background-size: cover;
  background-position: center;
  position: relative;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* overlay làm chữ dễ đọc */
.hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  border-radius: 8px;
}

/* text nằm trên ảnh */
.hero-content {
  position: relative;
  color: #fff;
  text-align: center;}</style>
