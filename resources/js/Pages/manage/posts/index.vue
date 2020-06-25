<template>
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row md:justify-between items-center">
            <h2 class="text-2xl font-semibold">Manage Posts</h2>
            <inertia-link :href="route('manage.posts.create')" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-medium rounded">
                Add Post
            </inertia-link>
        </div>

        <div class="mt-4">
            <div class="flex flex-col">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                    <div
                        class="bg-white align-middle inline-block min-w-full shadow overflow-hidden sm:rounded border-b border-gray-200">
                        <table class="min-w-full">
                            <thead class="text-gray-700">
                            <tr>
                                <th class="px-6 py-4 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-semibold uppercase tracking-wider"
                                    style="text-align: start">
                                    Title
                                </th>
                                <th class="px-6 py-4 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-semibold uppercase tracking-wider"
                                    style="text-align: start">
                                    Category
                                </th>
                                <th class="px-6 py-4 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-semibold uppercase tracking-wider"
                                    style="text-align: start">
                                    Created at
                                </th>
                                <th class="px-6 py-4 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-700">
                            <tr v-for="post in posts">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ post.title }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ post.category.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ post.created_at }}
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                    <inertia-link :href="route('manage.posts.edit', post.id)" class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </inertia-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from "../../../Shared/Layout";

    export default {
        layout: Layout,
        props: ['posts'],
    }
</script>
