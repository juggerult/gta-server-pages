import Home from "../pages/Home.vue";
import Donate from "../pages/Donate.vue";
import News from "../pages/News.vue";
import Forum from "../pages/Forum.vue";

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
];

export default routes;
