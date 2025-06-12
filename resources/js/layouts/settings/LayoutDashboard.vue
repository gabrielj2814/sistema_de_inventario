<script setup >
// import Loader from '@/components/loader.vue';
import NavbarDashboard from '@/components/NavbarDashboard.vue';
import { inject } from 'vue';

const app_url= inject("app_url")
// console.log("url => ",app_url)


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
        <div class="section-content p-4">
            <slot name="SectionContent">
                <div>
                    <div class=" container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-auto text-center">
                                <img class=" d-block mb-4" :src="app_url.url+'/storage/monita_china_en_contruccion.jpg'" alt="en contrucción">
                                <h2 class="">En contrucción Papu, regrese mas tarde</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </slot>
        </div>
    </main>

</template>
