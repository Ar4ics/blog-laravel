import Vue from 'vue';
import VueRouter from 'vue-router'
import axios from 'axios'

import Posts from './components/Posts.vue'
import Post from './components/Post.vue'
import Tags from './components/Tags.vue'
import User from './components/User.vue'

import App from './components/App.vue'

import Signin from './components/Signin.vue'
import Register from './components/Register.vue'

import CreatePost from './components/CreatePost.vue'



Vue.use(VueRouter)

axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token');


Vue.prototype.$http = axios

const routes = [
  { path: '/posts', component: Posts, name: "home" },
  { path: '/posts/create', component: CreatePost, name: "create_post" },
  { path: '/posts/:slug?', component: Post, name: "post" },
  { path: '/tags', component: Tags },
  { path: '/tags/:name?', component: Posts, name: "tag" },
  { path: '/register', component: Register },
  { path: '/login', component: Signin, name: "login" },
  { path: '/users/:name?/posts', component: Posts, name: "user_posts" },
  { path: '/users/:name?', component: User, name: "user" },
  { path: '*', redirect: '/posts' }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  mode: 'history',
  routes // short for routes: routes
})


new Vue({

  data: {
    user: {

    },
    authenticated: false
  },
  router,
  render: h => h(App)
}).$mount('#root')