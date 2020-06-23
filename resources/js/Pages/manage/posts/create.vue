<template>
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row md:justify-between items-center">
            <h2 class="text-2xl font-semibold">Create Post</h2>
            <inertia-link href="#" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-medium rounded">
                All Posts
            </inertia-link>
        </div>

        <base-panel class="mt-5">

            <form>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-4 items-center">
                    <div>
                        <base-input label="title" required/>
                    </div>
                    <div>
                        <base-input label="Publish at" type="date" required/>
                    </div>
                    <div>
                        <span class="text-gray-700">Category</span>
                        <base-select label="name" :options="categories" :reduce="category => category.id" multiple>
                            <template #search="{attributes, events}">
                                <input
                                    class="vs__search"
                                    v-bind="attributes"
                                    v-on="events"
                                />
                            </template>
                        </base-select>
                    </div>
                    <div class="col-span-3">
                        <span class="text-gray-700">Content</span>
                        <text-editor></text-editor>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <base-button primary>Save</base-button>
                </div>
            </form>
        </base-panel>
    </div>
</template>

<script>
    import Layout from "../../../Shared/Layout";
    import TextEditor from "../../../components/UI/TextEditor";


    export default {
        layout: Layout,
        components: { TextEditor },
        props: ['categories'],
    }
</script>
