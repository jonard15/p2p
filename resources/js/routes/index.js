import Home from '../pages/Home.vue'
//Admin
import Dashboard from '../pages/Admin/Dashboard.vue'
import AdminLogin from '../pages/Admin/Auth/Login.vue'
import Register from '../pages/Admin/Auth/Register.vue'
import User from '../pages/Admin/Settings/Users.vue'
import Role from '../pages/Admin/Settings/Roles.vue'
import Permission from '../pages/Admin/Settings/Permission.vue'
import Menu from '../pages/Admin/Settings/Menus.vue'
import Subscriber from '../pages/Admin/Client/Subscriber.vue'
import Plan from '../pages/Admin/Client/Plan.vue'
import Subscription from '../pages/Admin/Client/Subscription.vue'

//Subscriber
import SubcriberLogin from '../pages/Subscriber/Auth/SubscriberLogin.vue'

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            admin:false,
            name: 'home',
            component: Home,
            meta: { guest: true }
        },
        //Admin
        {
            path: '/admin/login',
            admin:true,
            name: 'login',
            component: AdminLogin,
            meta: { guest: true }
        },
        {
            path: '/admin/register',
            admin:true,
            name: 'register',
            component: Register,
            meta: { guest: true }
        },
        {
            path: '/admin/dashboard',
            admin:true,
            name: 'dashboard',
            component: Dashboard,
            meta: { requiresAuth: true }
        },
        {
            path: '/admin/users',
            admin:true,
            name: 'users',
            component: User,
            meta: { requiresAuth: true }
        },
        {
            path: '/admin/roles',
            admin:true,
            name: 'roles',
            component: Role,
            meta: { requiresAuth: true }
        },
        {
            path: '/admin/permissions',
            admin:true,
            name: 'permissions',
            component: Permission,
            meta: { requiresAuth: true }
        },
        {
            path: '/admin/menus',
            admin:true,
            name: 'menus',
            component: Menu,
            meta: { requiresAuth: true }
        },
        {
            path: '/admin/subscriber',
            admin:true,
            name: 'subscriber',
            component: Subscriber,
            meta: { requiresAuth: true }
        },
        {
            path: '/admin/plan',
            admin:true,
            name: 'plan',
            component: Plan,
            meta: { requiresAuth: true }
        },
        {
            path: '/admin/subscription',
            admin:true,
            name: 'subscription',
            component: Subscription,
            meta: { requiresAuth: true }
        },

        //SUBSCRIBER
        {
            path: '/subscriber/login',
            admin:false,
            name: 'subcriberlogin',
            component: SubcriberLogin,
            meta: { guest: true }
        },
    ]
}
