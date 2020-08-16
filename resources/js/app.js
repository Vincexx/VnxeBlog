/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
Vue.use(Vuetify);

import Dashboard from './components/admin/Dashboard.vue'
import Posts from './components/admin/Posts.vue'
import Categories from './components/admin/Categories.vue'
import Users from './components/admin/Users.vue'
import Account from './components/admin/Account.vue'
import Profile from './components/admin/Profile.vue'

const router = new VueRouter ({
    mode : 'history',
    routes : [

        {
            path : '/admin/dashboard',
            component : Dashboard,
            name : 'dashboard'
        },

        {
            path: '/admin/posts',
            component: Posts,
            name: 'posts'
        },
        {
            path: '/admin/categories',
            component: Categories,
            name: 'categories'
        },
        {
            path: '/admin/users',
            component: Users,
            name: 'users'
        },
        {
            path: '/admin/account',
            component: Account,
            name: 'account'
        },
        {
            path: '/admin/profile',
            component: Profile,
            name: 'profile'
        },
    ]

})

Vue.component('admin-navigation', require('./components/admin/Navigation.vue').default);


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router
});
