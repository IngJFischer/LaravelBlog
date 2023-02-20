import { createApp } from "vue"

//Tailwind
import "../../css/vue.css"

//Oruga
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'
import '@oruga-ui/oruga-next/dist/oruga-full-vars.css'

//Material design
import "@mdi/font/css/materialdesignicons.min.css"

//Axios
import axios from 'axios'


import App from "./App.vue"

import routes from './router'

const app = createApp(App)
app.use(Oruga)
app.use(routes)

app.config.globalProperties.$axios = axios
window.axios = axios

app.mount("#app")