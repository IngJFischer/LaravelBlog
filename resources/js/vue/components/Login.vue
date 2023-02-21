<template>
    <div class="grid grid-cols-3"> 
        <div></div>
        <div class="box-border h-50 w-50 p-4 border-2 rounded-lg m-8">
            <h1>Iniciar Sesión</h1>
            <form @submit.prevent="submit">
                <o-field :variant="errors.login ? 'danger' : 'primary'" label="User Name">
                    <o-input v-model="form.email"></o-input>
                </o-field>
        
                <o-field :variant="errors.login ? 'danger' : 'primary'" :message="errors.login" label="Password">
                    <o-input v-model="form.password" type="password"></o-input>
                </o-field>
    
                <div class="flex flex-row-reverse gap-2">
                    <o-button rounded variant="primary" native-type="submit" >Log-In</o-button>
                </div>
            </form>
        </div>
        <div></div>
    </div>
</template>

<script>
export default {

    methods: {
        cleanErrors() {
            this.errors.login = ""
        },

        submit() {
            //console.log("submit");
            this.cleanErrors()

            this.$axios.post('/api/user/login', this.form)
                .then(res => {
                    console.log(res.data)
                    this.$oruga.notification.open({
                        message: 'Logged-In',
                        position: 'bottom-right',
                        variant: 'primary',
                        duration: 2000,
                        closable: true,
                    })
                })
                .catch(error => {
                    console.log(error)
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
        }
    }
}

</script>