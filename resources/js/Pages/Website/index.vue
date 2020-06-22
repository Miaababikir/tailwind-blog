<template>
    <div>
        <div class="flex justify-between container mx-auto">
            <div class="w-full lg:w-8/12">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
                    <post-filter></post-filter>
                </div>
                <div class="mt-6">
                    <post></post>
                </div>
                <div class="mt-8">
                    <pagination></pagination>
                </div>
            </div>
            <div class="-mx-8 w-4/12 hidden lg:block">
                <div class="mt-10 px-8">
                    <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
                    <categories></categories>
                </div>
                <div class="mt-10 px-8">
                    <h1 class="mb-4 text-xl font-bold text-gray-700">Recent Post</h1>
                    <recent-post></recent-post>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from "../../Shared/Layout";
    import PostFilter from "../../components/PostFilter";
    import Post from "../../components/Post";
    import Pagination from "../../components/UI/Pagination";
    import Categories from "../../components/Categories";
    import RecentPost from "../../components/RecentPost"

    export default {
        components: {Layout, PostFilter, Post, Pagination, Categories, RecentPost},
        layout: Layout,
    }
</script>
