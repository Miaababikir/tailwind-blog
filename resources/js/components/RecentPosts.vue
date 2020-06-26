<template>
    <base-panel>
        <div class="flex my-1" v-for="post in posts" :key="post.id">
            <inertia-link class="text-lg font-semibold text-gray-700 font-medium hover:text-indigo-600" :href="route('posts.show', post.id)">{{ post.title }}</inertia-link>
        </div>
    </base-panel>
</template>

<script>
    export default {
        props: ['posts']
    }
</script>
