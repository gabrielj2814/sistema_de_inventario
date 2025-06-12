<script setup lang="js">

let props = defineProps(["paginate","paginar"]);



</script>

<style>

</style>

<template>

    <nav v-if="props.paginate.total>0" aria-label="Page navigation example">
        <ul class="pagination">
            <li  v-if="props.paginate.current_page>1" class="page-item">
                <a class="page-link" @click="props.paginar(props.paginate.current_page - 1)" href="#">Anteriro</a>
            </li>
            <li v-if="props.paginate.current_page<props.paginate.last_page" class="page-item">
                <a class="page-link" @click="props.paginar(props.paginate.current_page + 1)" href="#">Siguiente</a>
            </li>
        </ul>
    </nav>


</template>
