<template>
    <div class="container mx-auto">
        <div class="mt-6 mb-2 px-6 py-4 bg-white shadow-md rounded-md">
            <h1 v-if="postdata">Actualizar Post <span class="font-bold">{{ postdata.title }}</span></h1>
            <h1 v-else>Crear Post</h1>
        
    
            <form @submit.prevent="submit">
                <div class="my-5 grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <o-field label="Titulo" :variant="errorform.title ? 'danger' : 'primary'" :message="errorform.title">
                        <o-input v-model="form.title" value=""></o-input>
                    </o-field>
                    </div>
                    <o-field label="Descripción" :variant="errorform.description ? 'danger' : 'primary'" :message="errorform.description">
                        <o-input v-model="form.description" type="textarea" value=""></o-input>
                    </o-field>
                    <o-field label="Contenido" :variant="errorform.content ? 'danger' : 'primary'" :message="errorform.content">
                        <o-input v-model="form.content" type="textarea" value=""></o-input>
                    </o-field>
                    <o-field label="Categoría" :variant="errorform.category_id ? 'danger' : 'primary'" :message="errorform.category_id">
                        <o-select v-model="form.category_id" placeholder="Seleccione una categoría">
                            <option v-for="c in categories" v-bind:key="c.id" :value="c.id">
                                {{ c.title }}
                            </option>
                        </o-select>
                    </o-field>
                    <o-field label="Posteado" :variant="errorform.posted ? 'danger' : 'primary'" :message="errorform.posted">
                        <o-select v-model="form.posted" placeholder="Seleccione un Estado">
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </o-select>
                    </o-field>
    
                    <div v-if="postdata" class="flex gap-4">
                        <o-field :variant="fileError ? 'danger' : 'primary'" :message="fileError">
                            <o-upload v-model="file">
                                <o-button rounded tag="a" variant="primary">
                                    <o-icon icon="tray-arrow-up"></o-icon>
                                    <span> Click para cargar</span>
                                </o-button>
                            </o-upload>
                        </o-field>
                        <o-button rounded icon-left="tray-arrow-up" @click="upload">
                            Subir
                        </o-button>
                    </div>
    
                </div>

                <div class="flex flex-col items-end">
                    <o-button rounded variant="primary" icon-left="content-save" native-type="submit">Guardar</o-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    
    data() {
        return {
            categories: [],

            form: {
                title: "",
                description: "",
                content: "",
                category_id: "",
                posted: "",
            },

            errorform: {
                title: "",
                description: "",
                content: "",
                category_id: "",
                posted: "",
            },

            fileError: "",

            postdata: "", 

            file: null,
        }
    },
    
    async mounted() {

        if (this.$route.params.slug) {
            await this.getPost()
            //console.log(this.postdata)
            this.initPost()
        }

        this.getCategory()
    },

    /*created() {
        if (!this.$root.isLoggedIn) {
            window.location.href='/vue/login'
        }
    },*/
    
    methods: {
        getCategory() {
            const config = {
                headers: {Authorization: 'Bearer ' + this.$cookies.get('auth').token}
            }

            this.$axios.get('/api/category/all', config).then(res => {
                this.categories = res.data
                //console.log(res.data)
            })
        },

        upload() {
            //return console.log(this.file)

            const config = {
                headers: {Authorization: 'Bearer ' + this.$cookies.get('auth').token}
            }

            const formData = new FormData()
            formData.append("image", this.file)

            this.$axios.post('/api/post/upload/' + this.postdata.id, formData, {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            }, config)
                .then(res =>
                    //console.log(res)
                    this.fileError = ""
                )
                .catch(error => 
                    //console.log(error.response.data.message)
                    this.fileError = error.response.data.message
                ) 
        },

        async getPost() {
            const config = {
                headers: {Authorization: 'Bearer ' + this.$cookies.get('auth').token}
            }

            this.postdata = await this.$axios.get('/api/post/slug/' + this.$route.params.slug, config)
            this.postdata = this.postdata.data
        },

        initPost() {
            this.form.title = this.postdata.title
            this.form.description = this.postdata.description
            this.form.content = this.postdata.content
            this.form.category_id = this.postdata.category_id
            this.form.posted = this.postdata.posted
        },

        clearErrorForm() {
            this.errorform.title = ""
            this.errorform.description = ""
            this.errorform.content = ""
            this.errorform.category_id = ""
            this.errorform.posted = ""
        },

        submit() {

            this.clearErrorForm()
            //console.log(this.form);

            const config = {
                headers: {Authorization: 'Bearer ' + this.$cookies.get('auth').token}
            }

            if (this.postdata == "") {
                return this.$axios.post('/api/post', this.form, config)
                    .then(res => {
                        this.$oruga.notification.open({
                            message: 'Registro Creado',
                            position: 'bottom-right',
                            variant: 'primary',
                            duration: 4000,
                            closable: true,
                        })
                    })
                    .catch(error => {
                    //console.log(error.response.data)
                    if (error.response.data.title)
                        this.errorform.title = error.response.data.title[0]
                    if (error.response.data.description)
                        this.errorform.description = error.response.data.description[0]
                    if (error.response.data.content)
                        this.errorform.content = error.response.data.content[0]
                    if (error.response.data.category_id)
                        this.errorform.category_id = error.response.data.category_id[0]
                    if (error.response.data.posted)
                        this.errorform.posted = error.response.data.posted[0]
                })
            }
            this.$axios.patch('/api/post/' + this.postdata.id, this.form)
                .then(res => {
                    this.$oruga.notification.open({
                        message: 'Registro Actualizado',
                        position: 'bottom-right',
                        variant: 'primary',
                        duration: 4000,
                        closable: true,
                    })
                })
                .catch(error => {
                    //console.log(error.response.data)
                    if (error.response.data.title)
                        this.errorform.title = error.response.data.title[0]
                    if (error.response.data.description)
                        this.errorform.description = error.response.data.description[0]
                    if (error.response.data.content)
                        this.errorform.content = error.response.data.content[0]
                    if (error.response.data.category_id)
                        this.errorform.category_id = error.response.data.category_id[0]
                    if (error.response.data.posted)
                        this.errorform.posted = error.response.data.posted[0]
                })
            }
        }
    }
</script>