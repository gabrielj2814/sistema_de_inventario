<script setup lang="js">
import Dashboard from '@/pages/Dashboard.vue';

const props= defineProps([
    "rutas",
    "app_url",
])

localStorage.setItem("app_url",props.app_url)

// console.table(props.rutas)

</script>

<style>

</style>

<template>

    <Dashboard :rutas="props.rutas" :app_url="props.app_url" >
            <template #SectionContent>
                <!-- modulo de personal administrativo -->
            </template>
    </Dashboard>

</template>
