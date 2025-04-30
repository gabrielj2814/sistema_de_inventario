<script  setup lang="js">
import { computed, reactive } from 'vue';
import axios from 'axios';


const props = defineProps([
    "rutas",
])



const state = reactive({
    email:"",
    password:"",
    emailError:false,
    passwordError:false,
})

// const errorField= computed((field) => {
//     return state[`${field}Error`]
// })

function login(){
    let alerta=document.getElementById("contenedorAlerta")
    alerta.innerHTML=""
    state.emailError=false
    state.passwordError=false

    let email= state.email
    let password= state.password
    // console.log("email => ",email)
    // console.log("password => ",password)

    if(email.trim()==""){
        alerta.innerHTML= `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error:</strong> El email no puede estar vacio.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
        state.emailError=true
        return
    }

    if(password.trim()==""){
        alerta.innerHTML= `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error:</strong> La clave no puede estar vacio.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
        state.passwordError=true
        return
    }

    const DATA={
        email,
        password
    }

    axios.post("/auth/login",DATA)
    .then(res => {
        // console.log("success => ",res)
        alerta.innerHTML= `
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${res.data.message}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
        location.href=props.rutas["dashboard"]

    })
    .catch(error => {
        // console.error("error => ",error)
        alerta.innerHTML= `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error ${error.status}:</strong> ${error.response.data.message}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
    })



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

    .error-field{
        border: 1px solid red;
    }

</style>

<template>

    <main class="contenedor-main pt-5" data-bs-theme="dark">
        <div class=" container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-6 col-md-6 col-lg-6 col-xl-3">

                    <div class="contendor-formulario-login px-5 pt-4 pb-4">
                        <h3 class=" text-white text-center mb-4">Login App</h3>
                        <div id="contenedorAlerta"></div>
                        <div class="row justify-content-center">
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label for="email" class="form-label text-white" >Email</label>
                                    <input type="text" id="email" class="form-control" placeholder="Email" autocomplete="false" v-model="state.email" :class="{ 'error-field':state.emailError }">
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label for="password" class="form-label text-white">Password</label>
                                    <input type="password" id="password" class="form-control" placeholder="Password" v-model="state.password" :class="{ 'error-field':state.passwordError }">
                                </div>
                            </div>

                            <div class="col-auto">
                                <button class="btn btn-success" @click="login">Login</button>
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
