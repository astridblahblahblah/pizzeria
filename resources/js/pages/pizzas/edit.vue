<template>
    <div>
        <h1 class="text-3xl font-bold mb-6">Edit Pizza</h1>

        <div v-if="message"
             class="bg-green-500 text-white px-4 py-2 rounded shadow mb-4 transition-opacity duration-500"
             :class="{ 'opacity-0': !message }">
            {{ message }}
        </div>

        <div v-if="pizza && pizza.status !== 'Done'">
            <form @submit.prevent="updatePizza"
                  class="card bg-base-100 shadow-xl p-8 mb-6 max-w-2xl mx-auto">

                <!-- Pizza Name -->
                <div class="mb-4">
                    <h2 class="text-2xl font-bold mb-2">{{ pizza.name }}</h2>
                </div>

                <!-- Status Select -->
                <div class="form-control mb-4">
                    <label class="label px-2" for="status">
                        <span class="label-text">Status</span>
                    </label>
                    <select v-model="form.status"
                        id="status"
                        class="select select-bordered"
                        required>
                        <option v-for="status in statuses" :key="status" :value="status">
                            {{ status }}
                        </option>
                    </select>
                    <span v-if="errors.status" class="text-red-500 text-sm mt-1">
                        {{ errors.status }}
                    </span>
                </div>

                <!-- Submit Button -->
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>

        <div v-else>
            <h1 class="text-3xl font-bold mb-6">Pizza is done!</h1>
            <router-link to="/pizzas" class="btn btn-primary">
                Update Other Pizzas
            </router-link>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const pizza = ref(null)
const statuses = ref([])
const form = reactive({ status: '' })
const errors = ref({})
const message = ref('')

// Fetch pizza + allowed transitions
onMounted(async () => {
    fetchPizza()
})

async function fetchPizza() {
    const id = route.params.id

    try {
        const res = await fetch(`/api/pizzas/${id}`)
        const json = await res.json()
        pizza.value = json.data

        // Assume backend returns something like `status_transitions: ["Cooking", "Done"]`
        statuses.value = pizza.value.status_transitions || []
        form.status = pizza.value.status
    } catch (e) {
        console.error('Failed to fetch pizza', e)
    }
}

// Update pizza
async function updatePizza() {
    try {
        const res = await fetch(`/api/pizzas/${pizza.value.id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(form),
        })

        if (!res.ok) {
            const errData = await res.json()
            errors.value = errData.errors || {}
            return
        }

        if (form.status === 'Done') {
            await router.push('/pizzas')
        } else {
            const res = await fetch(`/api/pizzas/${pizza.value.id}`)
            const json = await res.json()
            pizza.value = json.data

            // Assume backend returns something like `status_transitions: ["Cooking", "Done"]`
            statuses.value = pizza.value.status_transitions || []
            form.status = pizza.value.status

            message.value = 'Pizza updated successfully.'
            setTimeout(() => {
                message.value = ''
            }, 2000)
        }
    } catch (e) {
        console.error('Failed to update pizza', e)
    }
}
</script>
