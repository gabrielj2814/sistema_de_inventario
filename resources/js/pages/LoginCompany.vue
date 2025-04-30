<script  setup lang="js">

const props = defineProps([
    "dataCompany",
    "rutas",
])


function irHaDashboard(){
    // location.href="/dashboard"
    location.href=props.rutas.dashboard
}


</script>

<style>
    /* #111110 */
    /* #3b3a37 */
    .contenedor-main {
        background-color: #111110;
        height: 100vh;
        padding-top: 60px;
    }

    .contendor-formulario-login{
        /* background-color: #111110; */
        border: 1px solid #3b3a37;
        border-radius: 10px;
    }

</style>

<template>

    <main class="contenedor-main pt-5" data-bs-theme="dark">
        <div class=" container-fluid">
            <div class="row justify-content-center">
                <div class="col-3">

                    <div class="contendor-formulario-login px-5 pt-4 pb-4">
                        <h3 class=" text-white text-center mb-4">Login {{ dataCompany.name }} {{ rutas.dashboard }}</h3>
                        <div class="row justify-content-center">
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Email" autocomplete="true">
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password">
                                </div>
                            </div>

                            <div class="col-auto">
                                <button class="btn btn-success" @click="irHaDashboard">Login</button>
                            </div>
                        </div>

                        <div class=" row justify-content-end">
                            <div class=" col-auto">
                                <a class=" link-primary" href="#">Forgot your mail?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


</template>
