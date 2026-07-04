<template>
  <div class="course-list">

<!-- TITLE -->
<h1>Danh sách khóa học</h1>

<!-- FILTER -->
<div class="filter">
  <a-input-search
    placeholder="Tìm khóa học..."
    style="width: 300px"
  />

  <a-select placeholder="Chọn level" style="width: 150px">
    <a-select-option value="all">Tất cả</a-select-option>
    <a-select-option value="beginner">Beginner</a-select-option>
    <a-select-option value="intermediate">Intermediate</a-select-option>
    <a-select-option value="advanced">Advanced</a-select-option>
  </a-select>
</div>

<!-- COURSE GRID -->
<a-row :gutter="[16,16]">
  <a-col v-for="i in 8" :key="i" :xs="24" :sm="12" :md="8" :lg="6">
    <a-card hoverable class="course-card">
      <template #cover>
        <img src="@/assets/vue.png" />
      </template>

      <a-card-meta title="Vue 3 từ cơ bản đến nâng cao">
        <template #description>
          <p>Level: Beginner</p>
          <p>Giá: 199k</p>
        </template>
      </a-card-meta>
    </a-card>
  </a-col>
</a-row>

<!-- PAGINATION -->
<div class="pagination">
  <a-pagination :total="50" :pageSize="8" />
</div>

  </div>
</template>

<script setup>
</script>

<style scoped>
.course-list {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.filter {
  display: flex;
  gap: 16px;
}

.course-card {
  border-radius: 8px;
}

.pagination {
  text-align: center;
}
</style>
