<script setup>
import { onMounted, ref } from 'vue'

defineProps(['modelValue'])

defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus()
  }
})
</script>

<template>
  <input
    ref="input"
    class="focus:ring-indigo-200 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-opacity-50"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
