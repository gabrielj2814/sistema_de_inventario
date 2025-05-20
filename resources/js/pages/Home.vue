<script setup>
import LayoutDashboard from '@/layouts/settings/LayoutDashboard.vue';
import { provide, reactive } from 'vue';
document.title = 'Home';

const props = defineProps(['rutas', 'app_url']);

console.log("url antes => ",props.app_url)
const rutas=new reactive(props.rutas)
const app_url=new reactive({url: props.app_url})

provide("rutas",rutas)
provide("app_url",app_url)

</script>
<style></style>
<template>
    <LayoutDashboard>
        <!-- <template #SectionContent>
        </template> -->
    </LayoutDashboard>
</template>
