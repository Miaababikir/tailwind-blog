<template>
    <div class="block">
        <span class="text-gray-700"
              v-if="label"
              v-text="label"
        ></span>
        <ckeditor
            :editor="editor"
            :value="value"
            @input="$emit('input', $event)"
            :required="required"
        ></ckeditor>
        <span class="text-red-500 text-xs mt-4" v-if="error">{{ error[0] }}</span>
    </div>
</template>

<script>
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: "TextEditor",
        components: {
            ckeditor: CKEditor.component
        },
        props: {
            value: '',
            label: String,
            required: String,
            error: null,
        },
        data() {
            return {
                editor: ClassicEditor,
            }
        },
    }
</script>

<style>
    .ck .ck-content {
        height: 400px;
    }

</style>
