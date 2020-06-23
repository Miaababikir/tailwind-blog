<template>
    <div>
        <div class="min-h-screen flex items-center">
            <div class="bg-white w-full max-w-lg rounded-lg shadow overflow-hidden mx-auto">
                <div class="py-4 px-6">
                    <div class="text-center font-bold text-gray-700 text-3xl">Brand</div>
                    <div class="mt-1 text-center font-bold text-gray-600 text-xl">Welcome Back</div>
                    <div class="mt-1 text-center text-gray-600">Login or Register</div>
                    <form method="POST" @submit.prevent="login">
                        <div class="mt-4 w-full">
                            <input type="email" name="email" placeholder="Email address"
                                   class="w-full mt-2 py-3 px-4 bg-gray-100 text-gray-700 border border-gray-300 rounded  block appearance-none placeholder-gray-500 focus:outline-none focus:bg-white" v-model="form.email"
                                   required/>
                            <span class="text-red-500 text-xs mt-4" v-if="$page.errors.email">{{ $page.errors.email[0] }}</span>
                        </div>
                        <div class="mt-4 w-full">
                            <input type="password" name="password" placeholder="Password"
                                   class="w-full mt-2 py-3 px-4 bg-gray-100 text-gray-700 border border-gray-300 rounded  block appearance-none placeholder-gray-500 focus:outline-none focus:bg-white" v-model="form.password"
                                   required/>
                            <p class="text-red-500 text-xs mt-4" v-if="$page.errors.password">{{ $page.errors.password[0] }}</p>
                        </div>
                        <div class="flex justify-between items-center mt-6">
                            <a href="#" class="text-gray-600 text-sm hover:text-gray-500">Forget password?</a>
                            <button type="submit"
                                    class="py-2 px-4 bg-gray-700 text-white rounded hover:bg-gray-600 focus:outline-none">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="flex items-center justify-center py-4 bg-gray-100 text-center">
                    <h1 class="text-gray-600 text-sm">Don't have an account</h1>
                    <inertia-link :href="route('register')" class="text-blue-600 font-bold mx-2 text-sm hover:text-blue-500">Register
                        now</inertia-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from "../../Shared/Layout";

    export default {
        layout: Layout,
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            login() {
                this.$inertia.post(route('login'), this.form);
            }
        }
    }
</script>
