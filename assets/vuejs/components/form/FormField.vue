<script lang="ts">
import { PropType } from 'vue';
import { ref } from 'vue';
import { defineComponent } from 'vue';

export default defineComponent({
    name: "FormField",
    props: {
        value: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            required: true
        },
        invalidMessage: {
            type: String,
            required: true
        },
        required: {
            type: Boolean,
            required: true
        },
        textarea: {
            type: Boolean,
            required: false
        }
    },
    setup(props) {
        return {
            props
        };
    },
    methods: {
        updateFieldEmit(event: Event) {
            this.$emit("update-field", event, this.props.name);
        }
    }
})
</script>

<template>
    <div class="field">
        <div v-if="!props.textarea" class="form-floating">
            <input class="form-control" :type="props.type" :id="props.label" :name="props.name" :value="value"
                :placeholder="props.placeholder" :required="required" @input="updateFieldEmit($event)">
            <label class="form-label" :for="props.label">{{ props.label }}</label>
            <div class="invalid-feedback">
                {{ props.invalidMessage }}
            </div>
        </div>
        <div v-else class="form-floating">
            <textarea class="form-control" :name="props.name" :value="value" :id="props.label + ' floatingTextarea'" @input="updateFieldEmit($event)"
                :placeholder="props.placeholder"  :required="required" style="height: 100px">{{ value }}</textarea>
            <label class="form-label" :for="props.label">{{ props.label }}</label>
            <div class="invalid-feedback">
                {{ props.invalidMessage }}e
            </div>
        </div>
    </div>  
</template>

<style>
    .field {
        .form-floating {
            margin: 20px 0;
        }

        textarea {
            max-height: 300px;
        }
    }
</style>