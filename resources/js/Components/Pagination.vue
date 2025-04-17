<template>
  <div class="pagination-container">
    <button 
      v-for="(link, index) in links" 
      :key="index" 
      :disabled="!link.url" 
      @click="goToPage(link.url)"
      v-html="formatLabel(link.label)"
      class="pagination-button"
      :class="{ 'active': link.active }"
    ></button>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { useTaskStore } from '@/Stores/taskStore';

const props = defineProps({
  links: Array
});

const store = useTaskStore();

const goToPage = (url) => {
  const cleanUrl = new URL(url);
  const page = cleanUrl.searchParams.get('page') || 1;

  const currentStatus = store.filters.status || '';

  store.fetchTasks({
    status: currentStatus,
    page: page
  });
};

const formatLabel = (label) => {
  return label.replace('&laquo;', '«').replace('&raquo;', '»');
};
</script>

<style scoped>
.pagination-container {
  margin-top: 20px;
  text-align: center;
}

.pagination-button {
  background-color: #007bff;
  color: white;
  padding: 8px 12px;
  margin: 0 4px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  min-width: 36px;
  transition: background-color 0.3s;
}

.pagination-button:hover:not(:disabled) {
  background-color: #0056b3;
}

.pagination-button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.pagination-button.active {
  background-color: #28a745;
}
</style>
