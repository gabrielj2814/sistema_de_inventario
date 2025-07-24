<script setup lang="js">

const props = defineProps({
    visible:{type:Boolean, require:true},
    formulario:{type:Object, require:true}
})

const emit=defineEmits(["previous","save"])

</script>
<template>
    <div class="contendor-formulario px-5 pt-4 pb-4" v-if="props.visible==true">
        <h1 class=" text-white text-center mb-4">Create Account</h1>
        <div id="contenedorAlertaFormularioCompany"></div>
        <div class="text-white h3">Data Company</div>
        <div class=" row">
            <div class="col-12 mb-4">
                <div class="form-group">
                    <label for="name_company" class="form-label text-white" >Name</label>
                    <input type="text" id="name_company" class="form-control" placeholder="Name" autocomplete="off" v-model="formulario.name" >
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="form-group">
                    <label for="phone" class="form-label text-white">Phone</label>
                    <input type="text" id="phone" class="form-control" placeholder="Last Name" autocomplete="off" v-model="formulario.phone">
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="form-group">
                    <label for="email_company" class="form-label text-white">Email</label>
                    <input type="email" id="email_company" class="form-control" placeholder="Email" autocomplete="off" v-model="formulario.email">
                </div>
            </div>
        </div>
        <div class=" row justify-content-between">
            <div class="col-2">
                <button class="btn btn-danger w-full" @click="emit('previous')">Previous</button>
            </div>
            <div class="col-2">
                <button class="btn btn-primary w-full" @click="emit('save')">Create</button>
            </div>
        </div>
    </div>
</template>
