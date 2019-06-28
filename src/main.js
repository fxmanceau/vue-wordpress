import Vue from 'vue'
import './assets/style/reset.scss'
import './assets/style/base.scss'

import HomeParallax from './components/home-parallax/Home-Parallax.vue'
import HomeArticles from './components/home-articles/Home-Articles.vue'
import ArticlePage from './components/article/Article.vue'
import SearchPage from './components/search/Search.vue'
import Cursor from './components/cursor/Cursor.vue'
import DataVisualizer from './components/data-visualizer/Data-Visualizer.vue'

Vue.component('home-parallax', HomeParallax)
Vue.component('home-articles', HomeArticles)
Vue.component('article-page', ArticlePage)
Vue.component('search-articles', SearchPage)
Vue.component('custom-cursor', Cursor)
Vue.component('data-visualizer', DataVisualizer)

const app = new Vue({
    el: '#app'
})