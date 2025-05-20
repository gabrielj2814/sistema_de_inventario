<script setup>
const props = defineProps(['classTable','classContenedorTabla']);
</script>
<style></style>
<template>
    <div :class="'table-responsive '+props.classContenedorTabla">
        <table :class="'table-striped table-hover table ' + props.classTable">
            <caption class="cal">
                <slot name="caption">Caption</slot>
            </caption>
            <thead>
                <slot name="head">
                    <tr>
                        <th>Registro</th>
                    </tr>
                </slot>
            </thead>
            <tbody>
                <slot name="body">
                    <tr>
                        <th>Sin Registros</th>
                    </tr>
                </slot>
            </tbody>
            <tfoot>
                <slot name="foot"></slot>
            </tfoot>
        </table>
    </div>
</template>
