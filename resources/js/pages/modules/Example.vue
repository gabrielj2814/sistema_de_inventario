<script setup lang="ts">
import Dashboard from '../Dashboard.vue';

defineProps({
    // Define any props you want to pass to the component
    title: Object
});


</script>

<style scoped>


</style>

<template>


    <Dashboard >
        <template #SectionContent>
            <div class=" container-fluid ">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <h1>buenas hola uwu {{ title }}</h1>
                        <h1>hola</h1>
                    </div>
                </div>
            </div>
        </template>
    </Dashboard>

</template>
