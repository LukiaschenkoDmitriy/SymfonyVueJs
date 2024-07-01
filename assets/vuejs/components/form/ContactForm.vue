<script lang="ts">

import { defineComponent } from 'vue';
import FormField from './FormField.vue';
import { ContactFormInputData } from './interfaces';

export default defineComponent({
    name: "ContactForm",
    props: {
        action: {
            type: String,
            required: true
        },
        formError: {
            type: Object,
            required: false
        }
    },
    setup(props) {
        return {
            props
        }
    },
    components: {
        FormField
    },
    data() {
        return {
            title: "Formularz kontaktowy",
            username: "",
            lastname: "",
            email: "",
            message: "",
        }
    },
    methods: {
        updateData() {
            var data: ContactFormInputData = {
                form_username: this.username,
                form_lastname: this.lastname,
                form_email: this.email,
                form_message: this.message
            };

            this.$emit("api-callback", data);
        }
    }
})

</script>

<template>
    <form @submit.prevent="updateData" :action="props.action" class="form contact-form was-validated" method="POST">
        <h3 class="title">{{ title }}</h3>
        <div class="form-error" v-if="props.formError != undefined">
            <ul>
                <li v-for="(text, name) in props.formError">
                    {{ text }}
                </li>
            </ul>
        </div>
        <div class="fields">
            <FormField invalid-message="Wpisz swoje imię" v-model="username" label="Imię" type="text"
                name="form_username" placeholder="" :required="true" />
            <FormField invalid-message="Wpisz swoje nazwisko" v-model="lastname" label="Nazwisko" type="text"
                name="form_lastname" placeholder="" :required="true" />
            <FormField invalid-message="Wpisz swój e-mail" v-model="email" label="E-mail" type="email" name="form_email"
                placeholder="" :required="true" />
            <FormField invalid-message="Wpisz wiadomość" v-model="message" label="Wiadomość" type="text"
                name="form_message" placeholder="" :required="true" :textarea="true" />
            <div class="form-check field my-4">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    Zgoda na warunki i postanowienia
                </label>
                <div class="invalid-feedback">
                    Musisz wyrazić zgodę przed wysłaniem zgłoszenia.
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Wysłać</button>
    </form>
</template>

<style>
    .contact-form {
        padding: 20px;
        margin: 20px;
        border-radius: 20px;

        .title {
            text-transform: uppercase;
            margin: 20px 0px;
            font-weight: bold;
        }

        .btn {
            width: 100%;
        }
    }
</style>