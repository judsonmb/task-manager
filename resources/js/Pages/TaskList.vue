<template>
  <div class="task-list-container">
    <h1 class="task-manager-title">TASK MANAGER</h1>
    <FormTask />
    <br>
    <div class="filter-container">
      <select id="status" v-model="filters.status" @change="applyFilters" class="status-select">
        <option value="">Filter by status</option>
        <option value="pending">Pending</option>
        <option value="in_progress">In Progress</option>
        <option value="completed">Completed</option>
      </select>
    </div>

    <div v-if="tasks.data && tasks.data.length > 0" class="task-list">
      <Pagination :links="tasks.links" />

      <ul>
        <li v-for="task in tasks.data" :key="task.id" class="task-item">
          <div class="task-title">{{ task.title }}</div>
          <div class="task-description">{{ task.description }}</div>
          <div class="task-status">Status: <strong>{{ task.status }}</strong></div>
          <div class="task-status">Priority: <strong>{{ task.priority }}</strong></div>
          <div class="task-status">Due date: <strong>{{ task.due_date }}</strong></div>
        </li>
      </ul>
    </div>
    <div v-else class="no-tasks">No tasks available</div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useTaskStore } from '../Stores/taskStore';
import FormTask from '@/Components/FormTask.vue';
import Pagination from '@/Components/Pagination.vue';

const store = useTaskStore();
const filters = computed(() => store.filters);

const tasks = computed(() => store.tasks.data);

const applyFilters = () => {
  store.fetchTasks(filters.value);
};

onMounted(() => {
  store.fetchTasks(filters.value);
});
</script>

<style scoped>
.task-list-container {
  padding: 20px;
  font-family: Arial, sans-serif;
  max-width: 1000px;
  margin: auto;
  background-color: #f9f9f9;
  border-radius: 8px;
}

.task-manager-title {
  text-align: center;
  font-size: 36px;
  font-weight: bold;
  color: #333;
  margin-bottom: 20px;
}

.filter-container {
  margin-bottom: 20px;
  display: flex;
  justify-content: center;
}

.status-select {
  padding: 8px;
  font-size: 16px;
  width: 200px;
}

.task-list {
  margin-top: 20px;
}

.task-item {
  background: #f9f9f9;
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.task-description {
  white-space: normal;
  word-wrap: break-word;
  overflow-wrap: break-word;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  height: 60px;
  line-height: 20px;
}

.task-item:hover {
  background-color: #f1f1f1;
}

.task-title {
  font-size: 18px;
  font-weight: bold;
}

.task-status {
  margin-top: 5px;
  color: #666;
}

.no-tasks {
  color: #888;
  text-align: center;
  font-size: 18px;
  padding: 20px;
}

.pagination button {
  background-color: #007bff;
  color: white;
  padding: 10px 15px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  margin-right: 5px;
}

.pagination button:disabled {
  background-color: #ccc;
}
</style>
