<template>
    <div>
        <base-nav></base-nav>

        <div class="px-6 py-8">
            <slot></slot>
        </div>

        <base-footer></base-footer>

        <flash v-if="$page.flash" :type="$page.flash.type" :popstate="$page.popstate">{{ $page.flash.message}}</flash>
    </div>
</template>

<script>
    import Flash from "../components/UI/Flash";
    import BaseFooter from "../components/UI/BaseFooter";
    export default {
        components: {Flash, BaseFooter},
        methods: {
            logout() {
                axios.post('/logout')
                    .then(() => location.reload());
            }
        }
    }
</script>
