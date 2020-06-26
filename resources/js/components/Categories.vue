<template>
    <base-panel>
        <ul class="">
            <li class="my-1" v-for="category in categories" :key="category.id">
                <a class="text-gray-700 font-bold mx-1 hover:text-indigo-500" :href="route('categories.posts.index', category.id)">{{ category.name }}</a>
            </li>
        </ul>
    </base-panel>
</template>

<script>
    export default {
        props: ['categories'],
    }
</script>
