

import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

Vue.use(VueRouter)

const DashboardLayout = Vue.component('dashboard-layout', require('./components/Layout/dashboardLayout.vue'))
const HomeLayout = Vue.component('home-layout', require('./components/Layout/homeLayout.vue'))
const LoginLayout = Vue.component('login-layout', require('./components/Layout/loginLayout.vue'))
const SuksesLayout = Vue.component('SuksesLayout', require('./components/Layout/suksesLayout.vue'))

const Logout = Vue.component('logout', require('./components/LogoutComponent.vue'))


const Landing = Vue.component('Landing', require('./components/home/Landing.vue'))
const List = Vue.component('List', require('./components/home/List.vue'))
const DetailList = Vue.component('DetailList', require('./components/home/DetailList.vue'))
const Subkategori = Vue.component('Subkategori', require('./components/home/Subkategori.vue'))

const DashboardContent = Vue.component('DashboardContent', require('./components/dashboard/DashboardComponent.vue'))
const PostBarang = Vue.component('PostBarang', require('./components/dashboard/PostBarangComponent.vue'))
const UserList = Vue.component('UserList', require('./components/dashboard/UserListComponent.vue'))

const userDashboard = Vue.component('UserDashboard', require('./components/Layout/userDashboardLayout.vue'))
const Profile = Vue.component('Profile', require('./components/home/Profile.vue'))
const Bag = Vue.component('Bag', require('./components/home/BagComponent.vue'))

const Transaksi = Vue.component('Transaksi', require('./components/Layout/TransaksiLayout.vue'))


const routes = [
    {
        name: 'LoginLayout',
        path: '/login',
        component: LoginLayout,
      },
    {
        name: 'SuksesLayout',
        path: '/sukses',
        component: SuksesLayout,
      },
    {
        name: 'Logout',
        path: '/logout',
        component: Logout,
      },
    {
        name: 'Transaksi',
        path: '/transaksi',
        component: Transaksi,
      },
    {
        // name: 'HomeLayout',
        path: '/',
        component: HomeLayout,
        children:[
            {
                name: 'Landing',
                path: '/',
                component: Landing    
            },
            {
                path: '/',
                component: userDashboard,
                children:[
                    {
                        name: 'Profile',
                        path: '/profile',
                        component: Profile
                    },
                    {
                        name: 'Bag',
                        path: '/bag',
                        component: Bag
                    },
                    
                ]    
            },
            {
                name: 'List',
                path: '/list/:kategori/:subkategori',
                component: List    
            },
            {
                name: 'DetailList',
                path: '/detaillist/:subkategori/:slug',
                component: DetailList    
            },
            
            {
                name: 'Subkategori',
                path: '/subkategori/:kategori',
                component: Subkategori    
            }
        ]
      },
      {
        // name: 'DashboardLayout',
        path: '/dashboard/',
        component: DashboardLayout,
        meta: { requiresAuth: true },
        children:[
            {
                name: 'DashboardContent',
                path: '/',
                component: DashboardContent
              },
            {
                name: 'PostBarang',
                path: '/PostBarang',
                component: PostBarang
              },
            {
                name: 'UserList',
                path: '/UserList',
                component: UserList
              },
        ]
      }
];
const router = new VueRouter({mode: 'history', routes: routes});
router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'Landing' })
        return
    }

    if(to.path === '/dashboard' && !store.state.isLoggedIn) {
        next({ name: 'Landing' })
        return
    }

    next()
})
export default router