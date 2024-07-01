<script lang="ts">

import { defineComponent } from 'vue';
import FormField from './FormField.vue';
import { ContactFormInputData } from './interfaces';
import { Transition } from 'vue';

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
        },
        updateField(event: Event, fieldName: string) {
            const newValue = (event.target as HTMLInputElement).value;
            switch (fieldName) {
                case "form_username":
                    this.username = newValue;
                    break;
                case "form_lastname":
                    this.lastname = newValue;
                    break;
                case "form_email":
                    this.email = newValue;
                    break;
                case "form_message":
                    this.message = newValue;
                    break;
                default:
                    break;
            }
        }
    }
})

</script>

<template>
    <form @submit.prevent="updateData" :action="props.action" class="form contact-form was-validated" method="POST">
        <h3 class="title">{{ title }}</h3>
            <Transition name="bounce2">
                <div class="form-error" v-if="props.formError != undefined">
                        <ul>
                            <li v-for="(text, name) in props.formError">
                                {{ text }}
                            </li>
                        </ul>
                </div>
            </Transition>
        <div class="fields">
            <FormField invalid-message="Wpisz swoje imię" :value="username" label="Imię" type="text"
                name="form_username" placeholder="" :required="true" @update-field="updateField"/>
            <FormField invalid-message="Wpisz swoje nazwisko" :value="lastname" @update-field="updateField" label="Nazwisko" type="text"
                name="form_lastname" placeholder="" :required="true" />
            <FormField invalid-message="Wpisz swój email" :value="email" @update-field="updateField" label="Email" type="email" name="form_email"
                placeholder="" :required="true" />
            <FormField invalid-message="Wpisz wiadomość" :value="message" label="Wiadomość" type="text"
                name="form_message" placeholder="" :required="true" @update-field="updateField" :textarea="true" />
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

    .bounce2-enter-active {
        animation: bounce2-in 0.5s;
    }
    .bounce2-leave-active {
        animation: bounce2-in 0.5s reverse;
    }

    @keyframes bounce2-in {
        0% {
            opacity: 0% !important;
            transform: scale(0);
        }
        50% {
            opacity: 50% !important;
            transform: scale(1.25);
        }
        100% {
            opacity: 100% !important;
            transform: scale(1);
        }
    }
</style>