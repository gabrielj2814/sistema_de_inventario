<script setup lang="js">
// components
import Modal from '@/components/Modal.vue';
import Table from '@/components/Table.vue';
import TarjetaVistaMovil from '@/components/TarjetaVistaMovil.vue';
import LayoutDashboard from '@/layouts/settings/LayoutDashboard.vue';
import axios from 'axios';

// imports
import { provide, reactive } from 'vue';

document.title = 'Modulo | Personal';

const props = defineProps(['rutas', 'app_url']);

const registros = new reactive({
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
});

const rutas = new reactive(props.rutas);
const app_url = new reactive({ url: props.app_url });

const idModalFormulario = 'modaFormularioPersonal';

provide('rutas', rutas);
provide('app_url', app_url);

const modoModal = (id) => {
    // console.log('id => ', id);
    limpiarFormulario();

    if (!id) {
        state.modoFormularioModal = true;
    } else {
        state.modoFormularioModal = false;
    }
};

const cargarData = () => {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    const DATA = { ...camposFormulario };
    DATA['_token'] = token.content;
    console.log('data a enviar => ', DATA);
    enviarDatos(DATA);
};

function enviarDatos(data) {
    axios
        .post('/app/admin/user', data)
        .then((res) => {
            console.log('respuesta => ', res.data);
        })
        .catch((error) => {
            let { errors } = error.response.data.data;
            cargarErroresFormulario(errors);
            console.error('error => ', errors);
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
    mensajesFormulario.name = errores.name.join(', ');
    mensajesFormulario.last_name = errores.last_name.join(', ');
    mensajesFormulario.email = errores.email.join(', ');
}

// const toastElement = ref(null);
// let toast = null;

// onMounted(() => {
//     if (toastElement.value) {
//         toast = new Toast(toastElement.value, {
//           autohide: true,
//           delay: 5000
//         }
//     )
//     }
// })

// const showToast = () => {
//     console.log(toast)
//     if (toast) {
//         toast.show()
//     }
// }
</script>

<style></style>

<template>
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
                            :data-bs-target="'#' + idModalFormulario"
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
                            :data-bs-target="'#' + idModalFormulario"
                            @click="modoModal(null)"
                        >
                            Nuevo Registro
                        </button>
                    </div>
                </div>
                <div class="mb-2 border"></div>
                <!-- tabla -->
                <!-- mostar datos en desktop -->
                <Table class-table="table-dark caption-top" class-contenedor-tabla="d-none d-lg-block">
                    <template #head>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </template>
                    <template #body>
                        <tr v-if="registros.data.length > 0" v-for="registro in registros.data" :key="registro.id">
                            <td>test</td>
                            <td>test@gmail.com</td>
                            <td>
                                <div class="row justify-content-end m-0">
                                    <div class="col-auto">
                                        <button
                                            class="btn btn-warning"
                                            @click="modoModal(1)"
                                            data-bs-toggle="modal"
                                            :data-bs-target="'#' + idModalFormulario"
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
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#idModalVerDatos">
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
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idModalEliminar">
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
                            <td colspan="3" class="text-center">Sin Registros</td>
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
                                <div class="card-text">Nombre: roote</div>
                                <div class="card-text">Apellido: roote</div>
                                <div class="card-text mb-2">Email: roote@gmail.com</div>
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <button
                                            class="btn btn-warning"
                                            @click="modoModal(1)"
                                            data-bs-toggle="modal"
                                            :data-bs-target="'#' + idModalFormulario"
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
                                        <button class="btn btn-info">
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
                                        <button class="btn btn-danger">
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

                <!-- modal -->
            </div>
            <Modal :id-modal="idModalFormulario" clases="modal-lg">
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
                            <div class="col-12"><span style="font-weight: bold">Nombre:</span> X</div>
                            <div class="col-12"><span style="font-weight: bold">Apellido:</span> X</div>
                            <div class="col-12"><span style="font-weight: bold">Email:</span> X</div>
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h3>Esta seguro que desea eliminar el registro</h3>
                            </div>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <button class="btn btn-warning">Si</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                </template>
            </Modal>
            <!--
            <button type="button" class="btn btn-primary" id="liveToastBtn" @click="showToast">Show live toast</button>

                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div i  d="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" ref="toastElement">
                    <div class="toast-header">
                    <img src="" class="rounded me-2" alt="">
                    <strong class="me-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                    Hello, world! This is a toast message.
                    </div>
                </div>
            </div>
            -->
            <!-- notificaciones desktop -->
            <!-- <div aria-live="polite" aria-atomic="true" class="position-relative">
                <div class="toast-container end-0 top-0 p-3">
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src class="me-2 rounded" alt />
                            <strong class="me-auto">Bootstrap</strong>
                            <small class="text-body-secondary">just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">See? Just like this.</div>
                    </div>

                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src class="me-2 rounded" alt />
                            <strong class="me-auto">Bootstrap</strong>
                            <small class="text-body-secondary">2 seconds ago</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">Heads up, toasts will stack automatically</div>
                    </div>
                </div>
            </div> -->
        </template>
    </LayoutDashboard>
</template>
