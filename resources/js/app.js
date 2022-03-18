require('./bootstrap');

import {createApp} from 'vue'

import App from './vue/app'
import Login from './vue/login'

createApp({
    components: { App }
}).mount('#app')

createApp({
    components: { Login }
}).mount('#login')