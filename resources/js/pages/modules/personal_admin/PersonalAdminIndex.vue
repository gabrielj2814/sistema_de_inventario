<script setup lang="js">
// components
import Modal from '@/components/Modal.vue';
import Table from '@/components/Table.vue';
import LayoutDashboard from '@/layouts/settings/LayoutDashboard.vue';
// imports
import { provide, reactive } from 'vue';

document.title = 'Modulo | Personal';

const props = defineProps(['rutas', 'app_url']);

// localStorage.setItem('app_url', props.app_url);

const idModalFormulario = 'modaFormularioPersonal';

const camposFormulario = new reactive({
    id: '',
    name: '',
    last_name: '',
    email: '',
});

const rutas=new reactive(props.rutas)
const app_url=new reactive(props.app_url)

provide("rutas",rutas)
provide("app_url",app_url)


const state = new reactive({
    modoFormularioModal: false,
});


const modoModal = (id) => {
    console.log('id => ', id);

    if (!id) {
        state.modoFormularioModal = true;
    } else {
        state.modoFormularioModal = false;
    }
};

const cargarData = () => {
    console.log('data formulario => ', camposFormulario);
};

</script>

<style></style>

<template>
    <LayoutDashboard>
        <template #SectionContent>
            <!-- modulo de personal administrativo -->
            <div class="rounded-2 p-3 shadow">
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
                        <button class="btn btn-primary d-block d-lg-none mb-2 w-100">Nuevo Registro</button>
                    </div>
                </div>
                <div class="border"></div>
                <!-- tabla -->
                <!-- mostar datos en desktop -->
                <Table class-table="table-dark caption-top" class-contenedor-tabla="d-none d-lg-block">
                    <template #head>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </template>
                    <template #body>
                        <tr>
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
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-pencil"
                                            >
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
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
                            </td>
                        </tr>
                    </template>
                    <template #caption> Rigistro del modulo Personal </template>
                </Table>
                <!-- mostrar datos en movil -->
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
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Nombre</span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Nombre"
                                            aria-label="Nombre"
                                            aria-describedby="basic-addon1"
                                            :model="camposFormulario.name"
                                        />
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Apellido</span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Apellido"
                                            aria-label="Apellido"
                                            aria-describedby="basic-addon1"
                                            :model="camposFormulario.last_name"
                                        />
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Correo</span>
                                        <input
                                            type="email"
                                            class="form-control"
                                            placeholder="Correo"
                                            aria-label="Correo"
                                            aria-describedby="basic-addon1"
                                            :model="camposFormulario.email"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <button v-if="state.modoFormularioModal" type="button" class="btn btn-primary" @click="cargarData">Registrar</button>
                    <button v-else class="btn btn-warning" @click="cargarData">Actualizar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </template>
            </Modal>
        </template>
    </LayoutDashboard>
</template>
