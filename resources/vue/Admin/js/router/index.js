import Vue from "vue";
import Router from "vue-router";

// Containers

// Views
import Manage from "./manage";
import Pages from "./pages";

Vue.use(Router);

export default new Router({
    mode: "history", // Demo is living in GitHub.io, so required!
    base: "admin",
    linkActiveClass: "open active",
    scrollBehavior: () => ({ y: 0 }),
    routes: [
        {
            path: "/",
            redirect: "/dashboard",
            name: "Home"
        },
        {
            path: "/logout",
            name: "Logout",
            beforeEnter: function(to, from, next) {
                localStorage.clear();
                window.location.href = "/login";
            }
        },
        Manage,
        Pages
    ]
});
