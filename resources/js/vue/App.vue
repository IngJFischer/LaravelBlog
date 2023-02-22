<template>
    <div>
        <header>
            <div class="flex flex-row-reverse gap-3 bg-gray-100">
                <o-button rounded variant="danger" @click="logout">Log Out</o-button>
                <o-button rounded variant='primary' tag="router-link" :to="{name: 'login'}">Login</o-button>
            </div>
        </header>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isLoggedIn: false,
            user: "",
            token: "",
        }
    },
    created() { 
        //console.log(window.SanctumToken)
        if (this.$cookies.isKey('auth')) {
            this.isLoggedIn = true
            this.$axios.post('/api/user/checktoken', {
                token: this.$cookies.get('auth').token})
            //console.log(this.$axios.post('/api/user/checktoken'))
        } 
    },

    methods: {

        logout() {
            this.$axios.post('/api/user/logout').then(() => {
                this.$cookies.remove('auth')
                window.location.href = '/vue/login'
            })
        },

        setCookieAuth(data) {
            this.$cookies.set("auth", data)
        },
    }
}
</script>