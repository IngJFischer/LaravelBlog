<template>
    <div class="container mx-auto">
        <div class="mt-6 mb-2 px-6 py-4 bg-white shadow-md rounded-md">
            <o-modal v-model:active="confirmDeleteActive">
                <div class="p-5">
                    <p>¿Desea eliminar el registro seleccionado?</p>
                    <br>
                    <div class="flex flex-row-reverse gap-2">
                        <o-button rounded variant="danger" @click="deletePost(); confirmDeleteActive = false">Confirmar</o-button>
                        <o-button rounded @click="deletePostRow = ''; confirmDeleteActive = false ">Cancelar</o-button>
                    </div>
                </div>
            </o-modal>
    
            <h1>Listado de Posts</h1>
            
            <div class="mb-5"></div>
    
            <o-button rounded icon-left="plus" tag="router-link" :to="({name: 'save'})">
                Crear
            </o-button>
    
            <div class="mb-5"></div>
    
            <o-table 
             :data="posts.current_page && posts.data.length == 0 ? [] : posts.data"
             :loading="loading"
             :striped="true">
                <o-table-column field="id" label="Id" numeric v-slot="p">
                    {{ p.row.id }}
                </o-table-column>
                <o-table-column field="title" label="Título"  v-slot="p">
                    {{ p.row.title }}
                </o-table-column>
                <o-table-column field="posted" label="Poseteado"  v-slot="p">
                    {{ p.row.posted }}
                </o-table-column>
                <o-table-column field="created_at" label="Fecha"  v-slot="p">
                    {{ p.row.created_at }}
                </o-table-column>
                <o-table-column field="category.title" label="Categoría"  v-slot="p">
                    {{ p.row.category.title }}
                </o-table-column>
                <o-table-column ficlass="ml-5" field="slug" label="Acciones"  v-slot="p">
                    
                    <o-button 
                      rounded 
                      size="small"
                      variant="primary"
                      icon-left="pencil"
                      tag="router-link"
                       :to="{name:'save', params:{'slug': p.row.slug}}">
                        Editar
                    </o-button>
    
                    <o-button 
                      rounded
                      size="small"
                      variant="danger"
                      icon-left="delete"
                      @click="deletePostRow = p; confirmDeleteActive = true">
                        Eliminar</o-button>
                </o-table-column>
            </o-table>
    
            <br>
    
            <o-pagination
             :total= "posts.total"
             @change="updatePage"
             v-model:current="currentPage"
             :range-before="1"
             :range-after="1"
             order="centered"
             size="small"
             :simple="false"
             :rounded="true"
             :per-page="posts.per_page"
            >
            </o-pagination>
        </div>


    </div>
</template>

<script>
import { defineComponent, registerRuntimeCompiler } from 'vue'

export default defineComponent({

    data() {
        return {
            posts: [],
            loading: true,
            currentPage: 1,
            confirmDeleteActive: false,
            deletePostRow:"",
        };
    },

    /*created() {
        if (!this.$root.isLoggedIn) {
            window.location.href='/vue/login'
        }
    },*/

    methods: {

        updatePage() {
            setTimeout(this.listPage, 100)
        },

        listPage() {
            const config = {
                headers: {Authorization: 'Bearer ' + this.$cookies.get('auth').token}
            }
            //console.log(config)
            this.loading = true
            this.$axios.get('/api/post?page=' + this.currentPage, config).then((res) => {
                this.posts = res.data
                //console.log(this.posts)    
                this.loading = false
            })
        },
        
        deletePost() {
            
            this.posts.data.splice(this.deletePostRow.index, 1)

            this.$axios.delete('/api/post/' + this.deletePostRow.row.id)
            this.$oruga.notification.open({
                message: 'Registro Eliminado',
                position: 'bottom-right',
                variant: 'danger',
                duration: 4000,
                closable: true,
            })
        },
    },
    
    async mounted() {
        //console.log(this.$cookies.get('auth'))
        this.listPage()
    }
})
</script>