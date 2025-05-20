<script setup>

const props = defineProps([
    "idModal",
    "clases",
])

</script>
<style></style>
<template>
    <div class="modal fade" :id="props.idModal" tabindex="-1" :aria-labelledby="props.idModal+'Label'" aria-hidden="true">
        <div :class="'modal-dialog '+props.clases">
            <div class="modal-content">
                <div class="modal-header">
                    <slot name="header"></slot>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot name="body">
                        <p>sin contenido</p>
                    </slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
