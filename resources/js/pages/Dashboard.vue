<script setup lang="ts">
import NavbarDashboard from '@/components/NavbarDashboard.vue';

const props= defineProps([
    "rutas",
    "app_url",
])

localStorage.setItem("app_url",props.app_url)
console.log(props.rutas)

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
        <NavbarDashboard :rutas="props.rutas" />
        <div class="section-content">
            <slot name="SectionContent">
                <div>
                    <div class=" container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-auto text-center">
                                <img class=" d-block mb-4" :src="props.app_url+'/storage/monita_china_en_contruccion.jpg'" alt="en contrucción">
                                <h2 class="">En contrucción Papus</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </slot>
        </div>
    </main>

</template>
