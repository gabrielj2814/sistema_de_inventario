<script setup lang="ts">
import NavbarDashboard from '@/components/NavbarDashboard.vue';

const props= defineProps([
    "user"
])

console.log("user => ",props.user)

</script>

<style scoped>

    .contenedor-main {
        background-color: #f8f9fa;
        height: 100vh;
        padding-top: 60px;
    }
</style>

<template>
    <!-- <div>hola</div> -->
    <main class="contenedor-main">
        <NavbarDashboard />
        <div class="section-content">
            <slot name="SectionContent">
                uwu
            </slot>
        </div>
    </main>

</template>
