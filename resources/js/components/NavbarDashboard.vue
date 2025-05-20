<script setup lang="js">
import axios from 'axios';
import { inject } from 'vue';

// const props= defineProps([
//     "rutas",
// ])

const rutas= inject("rutas")


function logout(){

    axios.get(`/${rutas["web.logout"].uri}`)
    .then(res => {
        console.log("data res =>",res)
        if(res.status==200){
            location.href=`/${rutas["view.auth.login.admin"].uri}`
        }
    })
    .catch(error => {
        console.error("data error =>",error)
    })


}
</script>


<template>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- <form class="d-flex mt-3" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-success" type="submit">Search</button>
                        </form> -->
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" :href="'/'+rutas['dashboard'].uri">Home</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Usuarios</a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Usuarios
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" :href="'/'+rutas['view.personal.admin.index'].uri" >Personal</a></li>
                                    <li><a class="dropdown-item" href="#">Clientes</a></li>
                                    <li><a class="dropdown-item" href="#">Solicitudes</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Configuración
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Roles</a></li>
                                    <!-- <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#" @click="logout">Salir</a>
                            </li>
                        </ul>

                    </div>
                </div>
                <a class="navbar-brand" href="#">Inventory App</a>
            </div>

        </nav>


</template>
