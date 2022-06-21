import Vue from "vue";
import VueRouter  from "vue-router";
import Homepage from './pages/Homepage'
import Register from './pages/Register'
import Login from './pages/Login'
import CreatePost from './pages/CreatePost'
import SinglePost from './pages/SinglePost'
import EditPost  from './pages/EditPost'
import store from './store'

Vue.use(VueRouter);

const routes = [
    {
      path: '/',
      name: 'Homepage',
      component: Homepage,
      meta: {
        auth: false
      }
    },

    {
      path: '/Register',
      name: 'Register',
      component: Register,
      meta: {
        auth: false
      }
    },
    {
      path: '/Login',
      name: 'Login',
      component: Login,
      meta: {
        auth: false
      }
    },

    {
      path: '/create-post',
      name: 'CreatePost',
      component: CreatePost,
        beforeEnter: (to, from, next) => {
            (store.state.isLoggedIn) ? next() : next('/');
        },
    },

    {
      path: '/single-post/:id',
      name: 'SinglePost',
      component: SinglePost,
      props: true,
      meta: {
        auth: false
      }
    },

    {
      path: '/edit-post/:id',
      name: 'EditPost',
      component: EditPost,
      props: true,
        beforeEnter: (to, from, next) => {
            (store.state.isLoggedIn) ? next() : next('/');
        },
    },

  ]


const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {

    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        next({ name: 'Login' })
        return
    }

    next()
})

export default router
