<template>
  <form @submit.prevent="submit" class="task-form">
    <div class="form-group">
      <input
        v-model="form.title"
        placeholder="Title"
        class="input-field"
      />
      <span v-if="form.errors.title" class="error-message">
        {{ form.errors.title }}
      </span>
    </div>

    <div class="form-group">
      <textarea
        v-model="form.description"
        placeholder="Description"
        class="input-field"
      ></textarea>
      <span v-if="form.errors.description" class="error-message">
        {{ form.errors.description }}
      </span>
    </div>

    <div class="form-group">
      <input type="date" v-model="form.due_date" class="input-field" />
      <span v-if="form.errors.due_date" class="error-message">
        {{ form.errors.due_date }}
      </span>
    </div>

    <div class="form-group-row">
      <select v-model="form.priority" class="input-field">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
      </select>
      <span v-if="form.errors.priority" class="error-message">
        {{ form.errors.priority }}
      </span>

      <button type="submit" class="submit-btn">Create Task</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
  title: '',
  description: '',
  due_date: '',
  priority: 'medium',
});

const submit = () => {
  form.post('/tasks', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      console.log(errors);
    },
  });
};
</script>

<style scoped>
.task-form {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  max-width: 100%;
  margin: auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  align-items: flex-start;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-group-row {
  display: flex;
  gap: 15px;
  align-items: flex-end;
}

.input-field {
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
  outline: none;
}

.input-field:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

textarea {
  resize: vertical;
  height: 120px;
}

.submit-btn {
  padding: 12px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.submit-btn:hover {
  background-color: #0056b3;
}

.error-message {
  color: red;
  font-size: 12px;
  margin-top: 5px;
}
</style>
