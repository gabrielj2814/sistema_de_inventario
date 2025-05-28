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
                </slot>
            </thead>
            <tbody>
                <slot name="body">

                </slot>
            </tbody>
            <tfoot>
                <slot name="foot"></slot>
            </tfoot>
        </table>
    </div>
</template>
