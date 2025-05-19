<script setup lang="js">
import Dashboard from '@/pages/Dashboard.vue';
import { reactive } from 'vue';

document.title = 'Modulo | Personal';

const props = defineProps(['rutas', 'app_url']);

localStorage.setItem('app_url', props.app_url);

const state = new reactive({
    modoFormularioModal: false,
});

const camposFormulario = new reactive(
    {
        id:"",
        name:"",
        last_name:"",
        email:"",
    }
);

console.log('estado formulario => ', state);

const modoModal = (id) => {
    console.log('id => ', id);

    if (!id) {
        state.modoFormularioModal = true;
    } else {
        state.modoFormularioModal = false;
    }
    console.log('estado formulario => ', state);
};


const cargarData = () => {
    console.log("data formulario => ",camposFormulario)
}

</script>

<style></style>

<template>
    <Dashboard :rutas="props.rutas" :app_url="props.app_url">
        <template #SectionContent>
            <!-- modulo de personal administrativo -->
            <div class="rounded-2 p-3 shadow">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-auto">
                        <h1>Modulo de Personal Administrativo</h1>
                    </div>
                    <div class="col-12 col-lg-auto">
                        <button class="btn btn-primary d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="modoModal(null)">
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
                        <button class="btn btn-primary w-100 d-block d-lg-none mb-2">Nuevo Registro</button>
                    </div>
                </div>
                <div class="border"></div>
                <!-- tabla -->
                 <!-- mostar datos en desktop -->
                <div class="table-responsive d-none d-lg-block">
                    <table class="table-dark table-striped table caption-top">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                                data-bs-target="#exampleModal"
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
                        </tbody>
                        <caption class="cal">
                            Personal
                        </caption>
                    </table>
                </div>
                <!-- mostrar datos en movil -->
                <!-- modal -->
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Formulario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                        </div>
                        <div class="modal-footer">
                            <button v-if="state.modoFormularioModal" type="button" class="btn btn-primary" @click="cargarData">Registrar</button>
                            <button v-else class="btn btn-warning" @click="cargarData">Actualizar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Dashboard>
</template>
