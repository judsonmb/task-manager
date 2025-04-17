import { defineStore } from 'pinia';
import { ref, reactive } from 'vue';
import axios from 'axios';

export const useTaskStore = defineStore('task', () => {
  const tasks = ref({ data: [], links: {} });
  const filters = reactive({
    status: '',
    page: 1,
  });

  const fetchTasks = (newFilters = {}) => {
    if (newFilters.status !== undefined) filters.status = newFilters.status;
    if (newFilters.page !== undefined) filters.page = newFilters.page;

    axios.get('/tasks', { params: { status: filters.status, page: filters.page } })
      .then(response => {
        tasks.value = {
          data: response.data.tasks,
          links: response.data.links,
        };
      })
      .catch(error => {
        console.error('Failed to fetch tasks:', error);
      });
  };

  return { tasks, filters, fetchTasks };
});
