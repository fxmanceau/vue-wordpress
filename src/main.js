import Vue from 'vue'
import './assets/style/reset.scss'
import './assets/style/base.scss'

import HomeParallax from './components/home-parallax/Home-Parallax.vue'
import HomeArticles from './components/home-articles/Home-Articles.vue'
import ArticlePage from './components/article/Article.vue'
import Cursor from './components/cursor/Cursor.vue'

Vue.component('home-parallax', HomeParallax)
Vue.component('home-articles', HomeArticles)
Vue.component('article-page', ArticlePage)
Vue.component('custom-cursor', Cursor)

const app = new Vue({
    el: '#app'
})