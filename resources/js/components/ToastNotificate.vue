<script setup lang="js">

const props=  defineProps(["list","eliminarToast"])

const formatoNotificacion={
    id:"",
    titulo:"",
    body:"",
    tiempo:null,
}

// const toastTrigger = document.getElementById('liveToastBtn')
    // const toastLiveExample = document.getElementById('liveToast')

    // if (toastTrigger) {
    // const toastBootstrap = Toast.getOrCreateInstance(toastLiveExample)
    //     toastTrigger.addEventListener('click', () => {
    //        toastBootstrap.show()
    //     })
    // }


</script>


<style></style>

<template>
    <div class="toast-container position-fixed end-0 top-0 p-3">
        <div v-for="notificacion in props.list" :id="'notificacion_'+notificacion.id" :key="notificacion.id" data-id-notificacion="" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="" class="me-2 rounded" alt="" />
                <strong class="me-auto">{{ notificacion.titulo }}</strong>
                <small>{{ notificacion.tiempo }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" @click="eliminarToast(notificacion.id)"></button>
            </div>
            <div class="toast-body">{{ notificacion.body }}</div>
        </div>
    </div>
    <!--
            <button type="button" class="btn btn-primary" id="liveToastBtn" @click="showToast">Show live toast</button>

            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
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
                <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
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
            </div> -->
</template>
