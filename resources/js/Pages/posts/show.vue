<template>
    <div class="container mx-auto md:w-2/3">
        <div class="bg-white border overflow-hidden rounded">
            <img class="w-full h-96 object-cover" :src="post.image" alt="Article" v-if="post.image">

            <div class="p-6">
                <div>
                    <h2 class="block text-gray-700 font-semibold text-3xl mt-2 leading-none">{{ post.title }}</h2>
                    <p class="text-gray-700 md:mt-0">{{ post.publisher.name }} • {{ post.created_at }}</p>
                </div>
                <div class="mt-5">
                    <div class="ck-content" v-html="post.body"></div>
                </div>
            </div>
        </div>

        <base-panel class="mt-5">
            <h2 class="text-2xl font-semibold">Comments</h2>
            <div v-if="$page.auth.user">
                <form @submit.prevent="submit">
                    <base-textarea placeholder="Add comment" rows="4" v-model="form.body" required />
                    <div class="flex justify-end">
                        <base-button class="mt-3 justify-end" primary>Submit</base-button>
                    </div>
                </form>
            </div>
            <div v-else>
                <p class="text-gray-700 text-center py-6">Please
                    <inertia-link class="text-indigo-500 font-semibold" :href="route('login')">Login</inertia-link>
                    first to start discussion
                </p>
            </div>
            <div class="mt-5 text-gray-700">
                <div class="flex py-4" v-for="comment in post.comments">
                    <img class="w-12 h-12 rounded-full object-cover"
                         src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                         alt="avatar">
                    <div class="ml-4 w-full">
                        <div>
                            <span class="font-semibold">{{ comment.user.name }}</span> <span class="mx-2">•</span> <span
                            class="text-gray-600">{{ comment.created_at }}</span>
                        </div>
                        <div class="py-2">
                            <p>{{ comment.body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </base-panel>

    </div>
</template>

<script>
    import Layout from "../../Shared/Layout";

    export default {
        layout: Layout,
        props: ['post'],
        data() {
            return {
                form: {
                    body: ''
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post(this.$route('posts.comments.store', this.post.id), this.form, {preserveScroll: true})
                    .then(() => this.form.body = '');
            }
        }
    }
</script>
