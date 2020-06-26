<template>
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row md:justify-between items-center">
            <h2 class="text-2xl font-semibold">Edit Post</h2>
            <inertia-link :href="route('manage.posts.index')"
                          class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-medium rounded">
                All Posts
            </inertia-link>
        </div>

        <base-panel class="mt-5">

            <form @submit.prevent="submit">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4 items-center">
                    <div>
                        <base-input label="title" name="title" v-model="form.title" :error="$page.errors.title"
                                    required/>
                    </div>
                    <div>
                        <span class="text-gray-700">Category</span>
                        <base-select label="name" :options="categories" :reduce="category => category.id"
                                     v-model="form.category_id">
                            <template #search="{attributes, events}">
                                <input class="vs__search" v-bind="attributes" v-on="events"
                                       :required="!form.category_id"/>
                            </template>
                        </base-select>
                        <span class="text-red-500 text-xs mt-4" v-if="$page.errors.category_id">{{ $page.errors.category_id[0] }}</span>
                    </div>
                    <div>
                        <span class="text-gray-700">Tags</span>
                        <base-select label="name" :options="tags" :reduce="tag => tag.id" v-model="form.tags" multiple>
                            <template #search="{attributes, events}">
                                <input class="vs__search" v-bind="attributes" v-on="events"/>
                            </template>
                        </base-select>
                        <span class="text-red-500 text-xs mt-4"
                              v-if="$page.errors.tags">{{ $page.errors.tags[0] }}</span>
                    </div>
                    <div>
                        <base-input label="Image" name="image" @change="selectFile" type="file"
                                    :error="$page.errors.image"/>
                    </div>
                    <div class="col-span-2">
                        <span class="text-gray-700">Content</span>
                        <text-editor v-model="form.body" :error="$page.errors.body"></text-editor>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <base-button type="submit" primary>Save</base-button>
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
        components: {TextEditor},
        props: ['post', 'categories', 'tags'],
        data() {
            return {
                form: {
                    title: '',
                    category_id: '',
                    tags: [],
                    body: '',
                    image: null
                }
            }
        },
        created() {
            this.form = {
                title: this.post.title,
                body: this.post.body,
                category_id: this.post.category_id,
                tags: this.post.tags.map(tag => tag.id)
            };
        },
        methods: {
            submit() {
                const data = new FormData();
                data.append('title', this.form.title);
                data.append('category_id', this.form.category_id);
                data.append('tags', this.form.tags);
                data.append('body', this.form.body);
                data.append('_method', 'PUT');
                if (this.form.image) {
                    data.append('image', this.form.image)
                }

                this.$inertia.post(this.$route('manage.posts.update', this.post.id), data);
            },
            selectFile(event) {
                this.form.image = event.target.files[0];
            }
        }
    }
</script>
