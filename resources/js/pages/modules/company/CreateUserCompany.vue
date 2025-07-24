<script  setup lang="js">
import { reactive } from 'vue';
import FormCompany from './FormCompany.vue';
import FormUser from './FormUser.vue';


const props = defineProps([
    "rutas",
])

const formularioUser= reactive({
    visible:true,
    formulario:{
        name:"",
        last_name:"",
        email:"",
        password:"",
    }
})

const formularioCompany= reactive({
    visible:false,
    formulario:{
        name:"",
        phone:"",
        email:"",
    }
})


function irHaDashboard(){
    // location.href="/dashboard"
    location.href=props.rutas.dashboard
}


function continuarConRegistroCompany(){
    formularioUser.visible=false
    formularioCompany.visible=true

}

function regresarHaFormularioUsuario(){
    formularioUser.visible=true
    formularioCompany.visible=false

}

function save(){
    alert("hola")
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

    .contendor-formulario{
        /* background-color: #111110; */
        border: 1px solid #3b3a37;
        border-radius: 10px;
    }

</style>

<template>

    <main class="contenedor-main pt-5" data-bs-theme="dark">
        <div class=" container-fluid">
            <div class="row justify-content-center">
                <div class="col-5">

                        <FormUser :formulario="formularioUser.formulario" :visible="formularioUser.visible" @save="continuarConRegistroCompany"/>
                        <FormCompany :formulario="formularioCompany.formulario" :visible="formularioCompany.visible" @previous="regresarHaFormularioUsuario" @save="save"/>

                </div>
            </div>
        </div>
    </main>


</template>
