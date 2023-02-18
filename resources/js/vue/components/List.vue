<template>
    <div>
        <h1>Listado de Posts</h1>

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
        </o-table>

        <br>

        <o-pagination
         :total= "posts.total"
        @change="updatePage"
         v-model:current="currentPage"
         :range-before="1"
         :range-after="1"
         order="centered"
         size=""
         :simple="false"
         :rounded="true"
         :per-page="posts.per_page"
        >
        </o-pagination>



    </div>
</template>

<script>
import { defineComponent, registerRuntimeCompiler } from 'vue'

export default defineComponent({

    data() {
        return {
            posts: [],
            loading: true,
            currentPage:1
        }
    },

    methods: {
        updatePage() {
            setTimeout(this.listPage, 100)
        },

        listPage() {
            //console.log("click"+this.currentPage)
            this.loading = true
            this.$axios.get('/api/post?page=' + this.currentPage).then((res) => {
                this.posts = res.data
                //console.log(this.posts)    
                this.loading = false
            })
        }

    },
    
    async mounted() {
        this.listPage()
    }
})
</script>