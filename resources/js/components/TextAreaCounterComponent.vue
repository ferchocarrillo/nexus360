<template>
    <div>
        <textarea :name="textareaName" :id="textareaId" :class="classtextarea" :placeholder="placeholder" v-model="text"
            rows="10" @input="$emit('input',text)"></textarea>
        <slot></slot>
        <span :class="classcounter">{{ totalCharacters }} / {{ maxLength }}</span>
    </div>
</template>
<script>
export default {
    props: {
        max: String,
        name: String,
        id: { type: String, required: false, default: '' },
        classtextarea: String,
        classcounter: String,
        placeholder: { type: String, required: false },
        value: { type: String, required: false, default: '' },
    },
    data() {
        return {
            text: this.value || '',
            maxLength: this.max,
            textareaName: this.name,
            textareaId: this.id || '',
        }
    },
    computed: {
        totalCharacters() {
            return this.text.length
        }
    },
    watch: {
        text() {
            this.text = this.text.substring(0, this.maxLength)
        }
    }
}
</script>