<script setup lang="js">

const props = defineProps({
    visible:{type:Boolean, require:true},
    formulario:{type:Object, require:true}
})

const emit= defineEmits(["save"])




</script>
<template>
    <div class="contendor-formulario px-5 pt-4 pb-4" v-if="props.visible==true">
        <h1 class=" text-white text-center mb-4">Create Account</h1>
        <div id="contenedorAlertaFormularioUser"></div>
        <div class="text-white h3">Data Basic</div>
        <div class="row justify-content-center">
            <div class="col-12 mb-4">
                <div class="form-group">
                    <label for="name" class="form-label text-white" >Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Name" autocomplete="off" v-model="formulario.name" >
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="form-group">
                    <label for="last_name" class="form-label text-white">Last Name</label>
                    <input type="text" id="last_name" class="form-control" placeholder="Last Name" autocomplete="off" v-model="formulario.last_name">
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="form-group">
                    <label for="email" class="form-label text-white">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Email" autocomplete="off" v-model="formulario.email">
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="form-group">
                    <label for="password" class="form-label text-white">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Password" autocomplete="off" v-model="formulario.password">
                </div>
            </div>


        </div>
        <div class=" row justify-content-end">
            <div class="col-2">
                <button class="btn btn-primary w-full" @click="emit('save')">next</button>
            </div>
        </div>
    </div>

</template>
