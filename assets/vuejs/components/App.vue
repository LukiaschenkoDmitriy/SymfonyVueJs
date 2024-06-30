<script lang="ts">
import { defineComponent } from 'vue';
import ContactForm from './form/ContactForm.vue';

export default defineComponent({
    components: {
        ContactForm
    },
    mounted() {
        const root = document.getElementById("vuejs-root");
        const attribute = root?.getAttribute("data-form-action");
        this.action = attribute ?? "";
    },
    data() {
        return {
            action: ""
        }
    }
})
</script>

<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="container-wrapper row w-100 d-flex justify-content-center">
            <div class="container-inner col-12 col-md-6">
                <ContactForm :action="action"/>
            </div>
        </div>
    </div>
</template>

<style>
    .container > .container-wrapper > .container-inner{
        background: rgba(255,255,255, .9);
        border-radius: 5px;
    }
</style>