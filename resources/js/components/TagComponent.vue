<template>
    <div>
        <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="id" :options="tags" :multiple="true" :taggable="true" @tag="addTag"></multiselect>

        <input type="hidden" name="tags[]" v-for="tag in value" :value="tag.name">
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        components: {
            Multiselect
        },

        props: {
            value: Array,
            tags: Array
        },

        methods: {
            addTag (newTag) {
                const tag = {
                    name: newTag,
                    id: Math.floor((Math.random() * 10000000))
                }
                this.value.push(tag)
                this.tags.push(tag)
            }
        }
    }
</script>
