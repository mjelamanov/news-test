import Vue from 'vue';
import VueRouter from 'vue-router'
import Home from './components/Home';
import News from './components/News';
import NewsDetail from './components/NewsDetail';

Vue.use(VueRouter);

new Vue({
    el: '#app',
    router: new VueRouter({
      routes: [
        { path: '/', component: Home },
        { path: '/news', component: News },
        { path: '/news/:id', component: NewsDetail },
      ],
    }),
});
