import { createRouter, createWebHistory } from "vue-router";
import routes from "./routs.js";

const router = createRouter({
    history: createWebHistory(),
    routes
});


export default router;
