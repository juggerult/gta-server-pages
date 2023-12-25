import Home from "../pages/Home.vue";
import Donate from "../pages/Donate.vue";
import News from "../pages/News.vue";
import Forum from "../pages/Forum.vue";
import Registration from "../pages/Register.vue";
import Login from "../pages/Login.vue"
import Private from "../pages/Private.vue";

const routes = [
    {
        path: '/',
        component: Home
    },

    {
        path: '/donate',
        component: Donate
    },

    {
        path: '/news',
        component: News
    },

    {
        path: '/forum-nameRP',
        component: Forum
    },

    {
        path: '/registration',
        component: Registration
    },

    {
        path: '/login',
        component: Login
    },

    {
        path: '/private',
        component: Private,
    },
];

export default routes;
