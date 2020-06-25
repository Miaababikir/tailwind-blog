<template>

    <div class="bg-white overflow-hidden shadow-md rounded-lg">
        <img class="w-full h-96 object-cover" v-if="post.image" :src="post.image" alt="Article">

        <div class="p-6">
            <div>
                <span class="text-blue-600 text-xs font-medium uppercase">{{ post.category.name }}</span>
                <a :href="route('posts.show', post.id)" class="block text-gray-800 font-semibold text-2xl mt-2 hover:text-gray-600 hover:underline">{{ post.title }}</a>
                <p class="text-sm text-gray-600 mt-2">{{ post.description }}</p>
            </div>

            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img class="h-10 h-10 object-cover rounded-full"
                             src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=48&q=60"
                             alt="Avatar">
                        <a href="#" class="mx-2 text-gray-700 font-semibold">{{ post.publisher.name }}</a>
                    </div>
                    <span class="mx-1 text-gray-600 text-xs">{{ post.created_at }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post']
    }
</script>
