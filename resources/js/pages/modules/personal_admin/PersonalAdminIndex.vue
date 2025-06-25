<script setup lang="js">
// components
import Loader from '@/components/Loader.vue';
import Modal from '@/components/Modal.vue';
import PaginationControls from '@/components/PaginationControls.vue';
import Table from '@/components/Table.vue';
import TarjetaVistaMovil from '@/components/TarjetaVistaMovil.vue';
import ToastNotificate from '@/components/ToastNotificate.vue';
import LayoutDashboard from '@/layouts/settings/LayoutDashboard.vue';

// imports
import axios from 'axios';
import {v4 as uuidv4} from "uuid"
import { provide, reactive, onMounted } from 'vue';


const props = defineProps(['rutas', 'app_url']);

const registros = new reactive({
    paginate:{},
    data: [],
});

const camposFormulario = new reactive({
    id: '',
    name: '',
    last_name: '',
    email: '',
});

const mensajesFormulario = new reactive({
    name: '',
    last_name: '',
    email: '',
});


const state = new reactive({
    modoFormularioModal: false,
    loaderApp: false,
    list:[],
});

const rutas = new reactive(props.rutas);
const app_url = new reactive({ url: props.app_url });

provide('rutas', rutas);
provide('app_url', app_url);

const modoModal = (id) => {
    // console.log('id => ', id);
    limpiarFormulario();

    if (!id) {
        state.modoFormularioModal = true;
    } else {
        state.modoFormularioModal = false;
        let usuario=registros.data.find(reg => reg.id===id)
        if(usuario){
            camposFormulario.id=id
            camposFormulario.name=usuario.name
            camposFormulario.last_name=usuario.last_name
            camposFormulario.email=usuario.email
        }

    }
};

function verDetalleUsuarioModal(id){
    let usuario=registros.data.find(reg => reg.id===id)
    console.log(usuario)
    if(usuario){
        document.getElementById("ver_name").textContent=usuario.name
        document.getElementById("ver_last_name").textContent=usuario.last_name
        document.getElementById("ver_email").textContent=usuario.email
        document.getElementById("ver_rol").textContent=usuario.roles.map(rol => rol.name),join(", ")
    }
}

const cargarData = () => {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    const DATA = { ...camposFormulario };
    DATA['_token'] = token.content;
    // console.log('data a enviar => ', DATA);
    if(DATA.id==""){
        crear(DATA);
    }else{
        editar(DATA);
    }
};

function crear(data) {
    state.loaderApp=true
    axios
    .post('/app/admin/user', data)
    .then((res) => {
        // console.log('respuesta => ', res.data);
        state.loaderApp=false
        ejecutarModal("#modaFormularioPersonal")
        crearToast("Registro","Registro completado.")
        consultarUsuario()
    })
    .catch((error) => {
        let { errors } = error.response.data.data;
        crearToast("Error","Error al registrar por favor contactar con soporte.")
        cargarErroresFormulario(errors);
        console.error('error => ', errors);
        state.loaderApp=false
    });
}


function editar(data) {
    state.loaderApp=true
    axios
    .put(`/app/admin/user/${data.id}`, data)
    .then((res) => {
        // console.log('respuesta => ', res.data);
        state.loaderApp=false
        ejecutarModal("#modaFormularioPersonal")
        consultarUsuario()
        crearToast("Actualización","El registro fue actualizado exitosamente.")
    })
    .catch((error) => {
        let { errors } = error.response.data.data;
        cargarErroresFormulario(errors);
        console.error('error => ', errors);
        state.loaderApp=false
        crearToast("Error","El registro no se puedo actualizar.")
    });
}

function limpiarFormulario() {
    // modal
    state.modoFormularioModal = false;
    // input
    camposFormulario.id = '';
    camposFormulario.name = '';
    camposFormulario.last_name = '';
    camposFormulario.email = '';
    // mensaje
    mensajesFormulario.name = '';
    mensajesFormulario.last_name = '';
    mensajesFormulario.email = '';
}

function cargarErroresFormulario(errores) {

    mensajesFormulario.name = (errores.name)?errores.name.join(', '):"";
    mensajesFormulario.last_name = (errores.last_name)?errores.last_name.join(', '):"";
    mensajesFormulario.email = (errores.email)?errores.email.join(', '):"";
}

function consultarUsuario(page=1){
    state.loaderApp=true
    let token = document.head.querySelector('meta[name="csrf-token"]').content;
    let rol=document.getElementById("filtro_rol").value
    let search=document.getElementById("search").value
    let data={
        _token:token,
        rol,
        search
    }
    axios.post(`/app/admin/user/filtrar?page=${page}`,data)
    .then(res => {
        // console.log("res servidor => ",res)
        registros.paginate={...res.data.data}
        registros.data=[...res.data.data.data]
        state.loaderApp=false

    })
    .catch(error => {
        state.loaderApp=false
        console.error("error servidor => ",error)
    })

    // this.$swal('Hello Vue world!!!');
}

function ejecutarModal(idModal){
    let botonModal=document.createElement("button")
    botonModal.setAttribute("data-bs-toggle","modal")
    botonModal.setAttribute("data-bs-target",idModal)
    botonModal.click()
    document.body.appendChild(botonModal); // Lo agregamos aunque no sea visible
    botonModal.click();
    setTimeout(() => botonModal.remove(), 0);
}

function cargarIdEliminarRegistro(id){
    document.getElementById("idEliminar").value=id
}

function eliminar(){
    state.loaderApp=true
    let  id=document.getElementById("idEliminar").value
    axios.delete(`/app/admin/user/${id}`)
    .then(res => {
        // console.log("res servidor => ",res)
        state.loaderApp=false
        ejecutarModal("#idModalEliminar")
        consultarUsuario()
        crearToast("Eliminar","Eliminación completada.")
    })
    .catch(error => {
        state.loaderApp=false
        console.error("error servidor => ",error)
        crearToast("Error","error al eliminar.")
    })
}

onMounted(() => {
    document.title = 'Modulo | Personal';
    consultarUsuario()
})

function eliminarToast(id){
    setTimeout(()=>{
        console.log("Toast eliminado")
        let list=[...state.list]
        list=list.filter(ls => ls.id!=id)
        state.list=list
    },3000)
}

function crearToast(titulo="",body="",tiempo=""){
    let toastNotificacion={
        id:uuidv4(),
        titulo,
        body,
        tiempo,
    }
    state.list.push(toastNotificacion)
}

</script>

<style></style>

<template>
    <Loader :statu="state.loaderApp"/>
    <ToastNotificate :list="state.list" :eliminar-toast="eliminarToast"/>
    <LayoutDashboard>
        <template #SectionContent>



            <!-- modulo de personal administrativo -->
            <div class="rounded-2 p-3 pb-5 shadow">
                <div class="row justify-content-between">
                    <div class="col-md-auto col-12">
                        <h1>Modulo de Personal Administrativo</h1>
                    </div>
                    <div class="col-lg-auto col-12">
                        <button
                            class="btn btn-primary d-none d-lg-block"
                            data-bs-toggle="modal"
                            :data-bs-target="'#modaFormularioPersonal'"
                            @click="modoModal(null)"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="30"
                                height="30"
                                fill="currentColor"
                                class="bi bi-plus-lg"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"
                                />
                            </svg>
                        </button>
                        <button
                            class="btn btn-primary d-block d-lg-none mb-2 w-100"
                            data-bs-toggle="modal"
                            :data-bs-target="'#modaFormularioPersonal'"
                            @click="modoModal(null)"
                        >
                            Nuevo Registro
                        </button>
                    </div>
                </div>
                <div class="mb-2 border"></div>
                <!-- filtros -->
                <div class="row mb-">
                    <div class="mb-2 mb-lg-0 col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group" @change="consultarUsuario()">
                            <select name="filtro_rol" id="filtro_rol" class="form-select">
                                <option value="null">Seleccione un rol</option>
                                <option value="Web-Master">Master</option>
                                <option value="Web-Super-Admin">Super-Admin</option>
                                <option value="Web-Team-default-Member">Team default Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 mb-lg-0 col-12 col-sm-9 col-md-4 col-lg-4">
                        <div class="form-group">
                            <input type="text" id="search" name="search" class="form-control" placeholder="buscar por nombre o correo">
                        </div>
                    </div>
                    <div class="mb-2 mb-lg-0 col-12 col-sm-3 col-md-2 col-lg-1">
                        <button class="btn btn-primary w-100" @click="consultarUsuario()">Buscar</button>
                    </div>
                </div>
                <!-- tabla -->
                <!-- mostar datos en desktop -->
                <Table class-table="table-dark caption-top" class-contenedor-tabla="d-none d-lg-block">
                    <template #head>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </template>
                    <template #body>
                        <tr v-if="registros.data.length > 0" v-for="registro in registros.data" :key="registro.id">
                            <td>{{registro.name}} {{registro.last_name}}</td>
                            <td>{{registro.email}}</td>
                            <td>{{registro.roles.map(rol => rol.name).join(", ")}}</td>
                            <td>
                                <div class="row justify-content-end m-0">
                                    <div class="col-auto">
                                        <button
                                            class="btn btn-warning"
                                            @click="modoModal(registro.id)"
                                            data-bs-toggle="modal"
                                            :data-bs-target="'#modaFormularioPersonal'"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="currentColor"
                                                class="bi bi-pencil-square"
                                                viewBox="0 0 16 16"
                                            >
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                                                />
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#idModalVerDatos" @click="verDetalleUsuarioModal(registro.id)">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye"
                                            >
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idModalEliminar" @click="cargarIdEliminarRegistro(registro.id)">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash"
                                            >
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="registros.data.length == 0">
                            <td colspan="4" class="text-center">Sin Registros</td>
                        </tr>
                    </template>
                    <template #caption> Rigistro del modulo Personal </template>
                </Table>
                <!-- mostrar datos en movil -->
                <div class="row d-flex d-lg-none">
                    <div class="col-12">
                        <h3>Registros</h3>
                    </div>
                    <div class="col-12 mb-2"v-if="registros.data.length > 0" v-for="registro in registros.data" :key="registro.id">
                        <TarjetaVistaMovil>
                            <template #body>
                                <div class="card-text">Nombre: {{registro.name}} </div>
                                <div class="card-text">Apellido: {{registro.last_name}}</div>
                                <div class="card-text mb-2">Email: {{registro.email}}</div>
                                <div class="card-text mb-2">Rol: {{registro.roles.map(rol => rol.name).join(", ")}}</div>
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <button
                                            class="btn btn-warning"
                                            @click="modoModal(registro.id)"
                                            data-bs-toggle="modal"
                                            :data-bs-target="'#modaFormularioPersonal'"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="currentColor"
                                                class="bi bi-pencil-square d-inline-block"
                                                viewBox="0 0 16 16"
                                            >
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                                                />
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#idModalVerDatos" @click="verDetalleUsuarioModal(registro.id)">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye"
                                            >
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idModalEliminar" @click="cargarIdEliminarRegistro(registro.id)">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash"
                                            >
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </TarjetaVistaMovil>
                    </div>
                </div>

                <PaginationControls :paginate="registros.paginate" :paginar="consultarUsuario"/>

            </div>
            <Modal id-modal="modaFormularioPersonal" clases="modal-lg">
                <template #header>
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Formulario</h1>
                </template>
                <template #body>
                    <div id="formulario">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Nombre</span>
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control"
                                            placeholder="Nombre"
                                            aria-label="Nombre"
                                            aria-describedby="basic-addon1"
                                            v-model="camposFormulario.name"
                                        />
                                    </div>
                                    <div class="text-danger mb-3" id="error_name" name="error_name">{{ mensajesFormulario.name }}</div>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Apellido</span>
                                        <input
                                            type="text"
                                            id="last_name"
                                            name="last_name"
                                            class="form-control"
                                            placeholder="Apellido"
                                            aria-label="Apellido"
                                            aria-describedby="basic-addon1"
                                            v-model="camposFormulario.last_name"
                                        />
                                    </div>
                                    <div class="text-danger mb-3" id="error_last_name" name="error_last_name">{{ mensajesFormulario.last_name }}</div>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Correo</span>
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Correo"
                                            aria-label="Correo"
                                            aria-describedby="basic-addon1"
                                            v-model="camposFormulario.email"
                                            :disabled="state.modoFormularioModal==false"
                                        />
                                    </div>
                                    <div class="text-danger mb-3" id="error_email" name="error_email">{{ mensajesFormulario.email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <button v-if="state.modoFormularioModal" type="button" class="btn btn-primary" @click="cargarData">Registrar</button>
                    <button v-else class="btn btn-warning" @click="cargarData">Actualizar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </template>
            </Modal>
            <Modal id-modal="idModalVerDatos" clases="">
                <template #header>
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ver Datos</h1>
                </template>
                <template #body>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">Nombre: <span style="font-weight: bold" id="ver_name"></span></div>
                            <div class="col-12">Apellido: <span style="font-weight: bold" id="ver_last_name"></span></div>
                            <div class="col-12">Email: <span style="font-weight: bold" id="ver_email"></span></div>
                            <div class="col-12">Rol: <span style="font-weight: bold" id="ver_rol"></span></div>
                        </div>
                    </div>
                </template>
                <!-- <template #footer>
                </template> -->
            </Modal>
            <Modal id-modal="idModalEliminar" clases="">
                <template #header>
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                </template>
                <template #body>
                    <input type="hidden" name="idEliminar" id="idEliminar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h3>Esta seguro que desea eliminar el registro</h3>
                            </div>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <button class="btn btn-warning" @click="eliminar()">Si</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                </template>
            </Modal>
        </template>
    </LayoutDashboard>
</template>
