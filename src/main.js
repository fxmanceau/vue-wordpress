import Vue from 'vue'
import './assets/style/reset.scss'
import './assets/style/base.scss'

import HomeParallax from './components/home-parallax/Home-Parallax.vue'
import HomeArticles from './components/home-articles/Home-Articles.vue'

Vue.component('home-parallax', HomeParallax)
Vue.component('home-articles', HomeArticles)

const app = new Vue({
    el: '#app'
})