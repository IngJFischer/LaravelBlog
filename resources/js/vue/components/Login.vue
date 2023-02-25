<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <div class="
        w-full
        sm:max-w-md
        mt-6
        px-6
        py-6
        bg-white
        shadow-md
        overflow-hidden
        sm:rounded-md"> 
            <h1 class="mt-3 mb-6 text-center text-3xl tracking-tight fornt-bold text-gray-900">Iniciar Sesión</h1>
            <form @submit.prevent="submit">
                <o-field :variant="errors.login ? 'danger' : 'primary'" label="User Name">
                    <o-input v-model="form.email"></o-input>
                </o-field>
            
                <o-field :variant="errors.login ? 'danger' : 'primary'" :message="errors.login" label="Password">
                    <o-input v-model="form.password" type="password"></o-input>
                </o-field>
        
                <o-button class="float-right" rounded :variant="login_enable ? 'primary' : 'disabled'" native-type="submit" >Log-In</o-button>
            </form>
        </div>
    </div>
</template>

<script>
export default {

    created() {
        if (this.$root.isLoggedIn) {
            this.login_enable = false
            this.$router.push({name: "list"})
        }
    },

    methods: {
        cleanErrors() {
            this.errors.login = ""
        },

        submit() {
            //console.log("submit");
            this.cleanErrors()

            this.$axios.post('/api/user/login', this.form)
                .then(res => {
                    //console.log(res.data)
                    this.login_enable = false

                    this.$oruga.notification.open({
                        message: 'Logged-In',
                        position: 'bottom-right',
                        variant: 'primary',
                        duration: 1000,
                        closable: true,
                    })

                    this.$root.setCookieAuth(res.data)

                    setTimeout(() => (window.location.href = '/vue'), 1500)
                })
                .catch(error => {
                    //console.log(error)
                    if (error.response.data) {
                        this.errors.login = error.response.data
                    }
                })
        }

    },

    data() {
        return {
            form: {
                email: "",
                password: "",
            },

            errors: {
                login: "",
            },

            login_enable: true
        }
    }
}

</script>