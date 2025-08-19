<template>
    <div class="bg-base-200 text-base-content">
        <h1 class="text-3xl font-bold mb-6">Pizzas</h1>

        <div v-if="loading">Loading pizzas...</div>

        <div v-else class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="pizza in pizzas" :key="pizza.id">
                    <td>{{ pizza.name }}</td>
                    <td>{{ pizza.status }}</td>
                    <td v-if="pizza.status !== 'Done'">
                        <a :href="`/pizzas/${pizza.id}/edit`" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const pizzas = ref([])
const loading = ref(true)

onMounted(async () => {
    try {
        const res = await fetch('/api/pizzas')
        const json = await res.json()
        pizzas.value = json.data
    } catch (e) {
        console.error('Failed to fetch pizzas', e)
    } finally {
        loading.value = false
    }
})
</script>
