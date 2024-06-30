<script lang="ts">
import { defineComponent } from 'vue';
import FormField from './FormField.vue';

interface FormInterfaceFields {
    title: string
}

export default defineComponent({
    name: "ContactForm",
    props: {
        action: {
            type: String,
            required: true
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
    data(): FormInterfaceFields {
        return {
            title: "Formularz kontaktowy",
        }
    }
})

</script>

<template>
    <form :action="props.action" class="form contact-form was-validated" method="POST">
        <h3 class="title">{{ title }}</h3>
        <div class="fields">
            <FormField invalid-message="Wpisz swoje imię" label="Imię" value="" type="text" name="form_username"
                placeholder="" :required="true" />
            <FormField invalid-message="Wpisz swoje nazwisko" label="Nazwisko" value="" type="text" name="form_lastname"
                placeholder="" :required="true" />
            <FormField invalid-message="Wpisz swój e-mail" label="E-mail" value="" type="email" name="form_email"
                placeholder="" :required="true" />
            <FormField invalid-message="Wpisz wiadomość" label="Wiadomość" value="" type="text" name="form_message"
                placeholder="" :required="true" :textarea="true" />
            <div class="form-check field">
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