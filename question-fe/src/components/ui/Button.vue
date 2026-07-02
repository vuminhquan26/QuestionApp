<template>
  <a-button :type="type" :size="size" :danger="danger">
    <slot />
  </a-button>
</template>

<script setup>
const props = withDefaults(
  defineProps<{
    type?: 'default' | 'primary' | 'dashed' | 'link' | 'text'
    size?: 'small' | 'middle' | 'large'
    danger?: boolean
  }>(),
  {
    type: 'default',
    size: 'middle',
    danger: false,
  },
)
</script>
