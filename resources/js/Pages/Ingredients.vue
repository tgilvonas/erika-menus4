<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="$page.props.translations.ingredients" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>Here should be interface of ingredients</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
