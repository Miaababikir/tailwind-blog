<template>
    <div>
        <div class="min-h-screen flex items-center">
            <div class="bg-white w-full max-w-lg rounded-lg shadow overflow-hidden mx-auto">
                <div class="py-4 px-6">
                    <div class="text-center font-bold text-gray-700 text-3xl">Brand</div>
                    <div class="mt-1 text-center font-bold text-gray-600 text-xl">Welcome back</div>
                    <div class="mt-1 text-center text-gray-600">Create new account</div>
                    <form @submit.prevent="register" method="POST">
                        <div class="mt-4 w-full">
                            <input type="text" name="name" placeholder="Your name"
                                   class="w-full mt-2 py-3 px-4 bg-gray-100 text-gray-700 border border-gray-300 rounded  block appearance-none placeholder-gray-500 focus:outline-none focus:bg-white" v-model="form.name"
                                   required/>
                            <span class="text-red-500 text-xs mt-4" v-if="$page.errors.name">{{ $page.errors.name[0] }}</span>
                        </div>
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
                        <div class="mt-4 w-full">
                            <input type="password" name="password_confirmation" placeholder="Password confirmation"
                                   class="w-full mt-2 py-3 px-4 bg-gray-100 text-gray-700 border border-gray-300 rounded  block appearance-none placeholder-gray-500 focus:outline-none focus:bg-white" v-model="form.password_confirmation"
                                   required/>
                            <p class="text-red-500 text-xs mt-4" v-if="$page.errors.password_confirmation">{{ $page.errors.password_confirmation[0] }}</p>
                        </div>
                        <div class="flex justify-between items-center mt-6">
                            <a href="#" class="text-gray-600 text-sm hover:text-gray-500">Forget password?</a>
                            <button type="submit"
                                    class="py-2 px-4 bg-gray-700 text-white rounded hover:bg-gray-600 focus:outline-none">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
                <div class="flex items-center justify-center py-4 bg-gray-100 text-center">
                    <h1 class="text-gray-600 text-sm">Already have account?</h1>
                    <a href="/login" class="text-blue-600 font-bold mx-2 text-sm hover:text-blue-500">Login</a>
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
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                }
            }
        },
        methods: {
            register() {
                this.$inertia.post(route('register'), this.form);
            }
        }
    }
</script>
