<script lang="ts">
import { defineComponent } from 'vue';
import ContactForm from './form/ContactForm.vue';
import { ContactFormInputData } from './form/interfaces';
import ContactSuccess from './form/ContactSuccess.vue';
import { Transition } from 'vue';

export default defineComponent({
    components: {
        ContactForm,
        ContactSuccess
    },
    mounted() {
        const root = document.getElementById("vuejs-root");
        const attribute = root?.getAttribute("data-form-action");
        this.action = attribute ?? "";
    },
    data() {
        return {
            action: "",
            apiJsonResultForm: [[]],
            apiJsonErrorForm: {},
            resultIsSuccess: false
        }
    },
    methods: {
        async apiFormContactHandler(data: ContactFormInputData) {
            const protocol = window.location.protocol;
            const host = window.location.host;
            const fullUrl = `${protocol}//${host}`;

            const requestInit: RequestInit = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data),
            };

            const response = await fetch(fullUrl + "/vuejs", requestInit);
            const json = await response.json();
            if (!response.ok) {
                this.apiJsonErrorForm = json.error;
                this.resultIsSuccess = false;
            } else {
                this.apiJsonResultForm.push(JSON.parse(json));
                this.resultIsSuccess = true;
                this.apiJsonErrorForm = [];
            }
        }
    }
})
</script>

<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="container-wrapper row w-100 d-flex justify-content-center">
            <Transition name="bounce">
                <div class="container-inner col-12 col-md-12" v-if="!resultIsSuccess">
                    <ContactForm :form-error="apiJsonErrorForm" :action="action"
                        @api-callback="apiFormContactHandler" />
                </div>
            </Transition>
            <Transition name="bounce">
                <div class="container-inner col-12 col-md-12" v-if="resultIsSuccess">
                    <ContactSuccess :results="apiJsonResultForm" />
                </div>
            </Transition>
        </div>
    </div>
</template>

<style>
    .container > .container-wrapper > .container-inner{
        background: rgba(255,255,255, .9);
        border-radius: 5px;
    }

    .bounce-enter-active {
        animation: bounce-in 0.5s;
    }
    .bounce-leave-active {
        animation: bounce-in 0.5s reverse;
    }
    @keyframes bounce-in {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.25);
        }
        100% {
            transform: scale(1);
        }
    }
</style>