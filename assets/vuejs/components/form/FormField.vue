<script lang="ts">
import { PropType } from 'vue';
import { ref } from 'vue';
import { defineComponent } from 'vue';

export default defineComponent({
    name: "FormField",
    props: {
        modelValue: {
            type: String as PropType<string>,
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
    setup(props, { emit }) {
        const localValue = ref(props.modelValue);

        const updateValue = (event: Event) => {
            const newValue = (event.target as HTMLInputElement).value;
            localValue.value = newValue;
            emit('update:modelValue', newValue);
        };

        return {
            props,
            localValue,
            updateValue
        };
    }
})
</script>

<template>
    <div class="field">
        <div v-if="!props.textarea" class="form-floating">
            <input class="form-control" :type="props.type" :id="props.label" :name="props.name" :value="localValue"
                :placeholder="props.placeholder" :required="required" @input="updateValue($event)">
            <label class="form-label" :for="props.label">{{ props.label }}</label>
            <div class="invalid-feedback">
                {{ props.invalidMessage }}
            </div>
        </div>
        <div v-else class="form-floating">
            <textarea class="form-control" :name="props.name" :id="props.label + ' floatingTextarea'" @input="updateValue($event)"
                :placeholder="props.placeholder"  :required="required" style="height: 100px">{{ localValue }}</textarea>
            <label class="form-label" :for="props.label">{{ props.label }}</label>
            <div class="invalid-feedback">
                {{ props.invalidMessage }}
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