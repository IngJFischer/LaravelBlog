<template>
    <div>
        <nav class="bg-white border-b border-gray-100">
            <header class="px-4 sm:px-6 lg:px-8">
                <div class="flex">
                    <div class="flex items-center">
                        <svg 
                            width="50px"
                            height="35px"
                            viewBox="-4 1 82 70"
                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="vue" stroke="none" fill="none" transform="translate(-3.000000, 2.000000)">
                                <path d="M15,0 L31,0 C31,0 33.7431643,4.8767365 35.1147464,7.31510474 L40,16 L50,0 L65,0 L40,42 L15,0 Z" stroke="#34475F" fill="#34475F" stroke-width=".5" id="inner">
                                </path>
                                <path d="M0,0 L40,68 L80,0 L65,0 C65,0 50.2018448,24.8609007 42.8027673,37.291351 C41.8685115,38.8609007 40,42 40,42 L15,0 L0,0 Z" stroke="#2FB982" fill="#2FB982" stroke-width="1" id="outer">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="w-full flex py-4 px-4 sm:px-6 justify-between items-center">
                        <div class="flex h-7">
                            <router-link class="
                            inline-flex
                            uppercase
                            border-b-2
                            text-sm
                            leading-5
                            mx-3
                            px-1
                            py-1
                            text-gray-600 text-center
                            font-bold
                            hover:text-gray-900 hover:border-gray-700 hover:-translate-y-1
                            duration-150
                            transition-all"
                            v-if="!$root.isLoggedIn" :to="{name: 'login'}">
                                Log In
                            </router-link>
    
                            <router-link class="
                                inline-flex
                                uppercase
                                border-b-2
                                text-sm
                                leading-5
                                mx-3
                                px-1
                                py-1
                                text-gray-600 text-center
                                font-bold
                                hover:text-gray-900 hover:border-gray-700 hover:-translate-y-1
                                duration-150
                                transition-all"
                                v-if="$root.isLoggedIn" :to="{name: 'list'}">
                                Posts
                            </router-link>
                        </div>
                        
                        <div class="flex items-center">
                            <o-button v-if="$root.isLoggedIn" rounded variant="danger" @click="logout">Log Out</o-button>     
                            <div class="flex flex-col items-center" v-if="$root.isLoggedIn">
                                <div class="rounded-full w-9 h-9 bg-blue-300 text-center p-1 font-bold">
                                    {{ $root.user.name.substr(0, 1).toUpperCase() }}
                                </div>
                                <p class="mx-3">{{ $root.user.name }}</p>
                        </div>
                    </div>
                    </div>
                </div>
            </header> 
        </nav>

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
            this.user = this.$cookies.get('auth').user
            this.$axios.post('/api/user/checktoken', {
                token: this.$cookies.get('auth').token
            })
                .then(() => { })
                .catch(() => {
                    this.$cookies.remove('auth')
                    window.location.href = '/vue/login'
                })
            //console.log(this.$axios.post('/api/user/checktoken'))
        } 
    },

    methods: {

        logout() {
            console.log(this.token)
            this.$axios.post('/api/user/logout', {
                token: this.$cookies.get('auth').token
            }).then(() => {
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