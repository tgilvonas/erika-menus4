<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref, onMounted} from "vue";
import axios from "axios";

let ingredients = ref([])
let searchText = ref('')
let loading = ref(false)

onMounted(() => {
    getIngredientsList()
})

function getIngredientsList() {
    loading.value = true;
    axios.get(route('ingredients.json_list'), {
        params: {
            order_by_field: 'title',
            order_by_direction: 'asc',
            page: 1,
            search_text: searchText.value,
            paginate_by: 10
        }
    }).then(function(response){
        loading.value = false;
        ingredients.value = response.data.data;
    })
}
</script>

<template>
    <Head :title="$page.props.translations.ingredients" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $page.props.translations.ingredients }}</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p class="mb-3">{{ $page.props.translations.ingredients_list_description }}</p>
                <div class="flex items-center space-x-2 pb-3">
                    <label for="search" class="">
                        {{ $page.props.translations.ingredient }}:
                    </label>
                    <input
                        id="search"
                        type="text"
                        :placeholder="$page.props.translations.enter_text_for_search"
                        v-model="searchText"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        @keyup="getIngredientsList"
                    />
                </div>
                <table class="table-auto border-collapse w-full" v-if="ingredients.length">
                    <thead>
                        <tr>
                            <th class="border p-1">{{ $page.props.translations.title }}</th>
                            <th class="border p-1">{{ $page.props.translations.proteins }}</th>
                            <th class="border p-1">{{ $page.props.translations.fat }}</th>
                            <th class="border p-1">{{ $page.props.translations.carbohydrates }}</th>
                            <th class="border p-1">{{ $page.props.translations.kilocalories }}</th>
                            <th class="border p-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ingredient in ingredients">
                            <td class="border p-1">{{ ingredient.title }}</td>
                            <td class="border p-1 text-right">{{ ingredient.proteins.toFixed(3) }}</td>
                            <td class="border p-1 text-right">{{ ingredient.fat.toFixed(3) }}</td>
                            <td class="border p-1 text-right">{{ ingredient.carbohydrates.toFixed(3) }}</td>
                            <td class="border p-1 text-right">{{ ingredient.calories.toFixed(3) }}</td>
                            <td class="border p-1">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else>
                    {{ $page.props.translations.no_records }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
